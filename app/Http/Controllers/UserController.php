<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodeMail;
use App\Models\PasswordResetToken;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Obtiene el usuario autenticado actual.

        $user_courses = $user->courses->map(function ($course) use ($user) {
            $course->image_url = 'storage/' . $course->image_url; // Ajusta la URL de la imagen para que apunte al almacenamiento público.
            $course->progress = DB::select('CALL get_progress_in_course(?, ?)', [$course->id, $user->id])[0]->progress ?? 0; // Llama al procedimiento almacenado para obtener el progreso del usuario en el curso.
            return $course;
        });

        return view('userpages.userhome', compact('user', 'user_courses')); // http://127.0.0.1:8000/usercourses
    }

    public function show(User $user)
    {
        // El usuario si puede ver a otros usuarios, pero no puede editar su información. Solo el administrador puede editar la información de los usuarios.
        $editable = true;
        if ($user->id !== Auth::id()) {
            //abort(403, 'No tienes permiso para acceder a este recurso.'); 
            $editable = false; // Si el usuario no es el mismo que el autenticado, no se muestra el botón del mecanismo de edición.
        }

        $user_courses = $user->courses->map(function ($course) use ($user) {
            $course->progress = (int) DB::select('CALL get_progress_in_course(?, ?)', [$course->id, $user->id])[0]->progress ?? 0; // Llama al procedimiento almacenado para obtener el progreso del usuario en el curso.
            return $course;
        });

        return view('userpages.user')->with('user', $user)->with('roles', Role::all())->with('editable', $editable)->with('user_courses', $user_courses); // http://
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        unset($data['confirm_password']);

        $path = null;

        try {
            // Guardar archivo en disco y atualizar a ruta relativa en $data.
            if ($request->hasFile('avatar_url') && $request->file('avatar_url')?->isValid()) {
                $image = $request->file('avatar_url');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('UploadFiles', $imageName, 'public');
                $data['avatar_url'] = $path;
            }

            $user = User::create($data);

            event(new Registered($user));

            Auth::login($user);
        } catch (\Throwable $th) {
            // Borrar el archivo en caso de error.
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return back()->withErrors(['error' => 'No se pudo crear el usuario: ' . $th->getMessage()])->withInput();
        }

        return redirect()->route('usernew', ['user' => $user->id])->with('success', 'El usuario se ha creado exitosamente.');
    }

    public function destroy(Request $request)
    {
        try {
            $user = Auth::user();

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            $path = $user->avatar_url;

            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            $user->delete();

            return response()->json(['message' => 'El usuario se ha eliminado exitosamente (Registro cancelado).'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'No se pudo cancelar el registro. Por favor, inténtelo de nuevo: ' . $th->getMessage() . '.'], 500);
        }
    }

    public function requestCode(Request $request)
    {
        try {
            $user = User::where('email', trim($request->input('email')))->first();

            // Respuesta genérica por seguridad.
            if (!$user) {
                $request->session()->forget('password_reset_token_id');

                return response()->json([
                    'message' => 'El correo electrónico no se encuentra registrado.'
                ], 401);
            }

            $token = $user->password_reset_token;

            // Si aún existe uno válido.
            if (
                $token && $token->attempts > 0 && now()->lessThan($token->expires_at)
            ) {
                $request->session()->put('password_reset_token_id', $token->id);

                return response()->json([
                    'message' => 'El código sigue vigente. Espera para resolicitar uno nuevo.',
                    'attempts' => $token->attempts
                ], 200);
            }

            // Si no existe un token válido.
            $code = strtoupper(Str::random(6));
            $code_hash = hash('sha256', $code);
            $newToken = DB::transaction(function () use ($token, $user, $code_hash) {

                // Eliminar token anterior si existe.
                if ($token) {
                    $token->delete();
                }

                // Crear token.
                return PasswordResetToken::create([
                    'user_id' => $user->id,
                    'code_hash' => $code_hash,
                    'expires_at' => now()->addMinutes(5),
                ]);
            });

            // Rehidratamos la instancia del modelo según los datos de la fila.
            $newToken->refresh();

            // Enviar correo FUERA de la transacción.
            Mail::to($user->email)->send(
                new CodeMail(
                    subjectMail: 'Restablecimiento de contraseña CodeAcademyPro',
                    code: $code,
                    greeting: 'Hola estimado usuario de CodeAcademyPro',
                    salutation: 'Saludos, CodeAcademyPro',
                    time: $newToken->expires_at->format('h:i A'),
                    attempts: $newToken->attempts
                )
            );

            $request->session()->put('password_reset_token_id', $newToken->id);

            return response()->json([
                'message' => 'Se ha enviado un código de recuperación.',
                'attempts' => $newToken->attempts
            ], 200);
        } catch (\Throwable $th) {

            report($th); // Registra la excepción en el sistema de logs de Laravel (reporting), útil para monitoreo y depuración sin detener el flujo por sí solo.

            return response()->json([
                'message' => 'Ocurrió un error al procesar la solicitud:' . $th->getMessage()
            ], 500);
        }
    }

    public function validateCode(Request $request)
    {
        try {
            $code_input = strtoupper(trim($request->input('code')));

            $token = PasswordResetToken::where('code_hash', hash('sha256', $code_input))->first();

            // Válidar que el código exista, no este quemado y este vigente.
            if ($token && ($token?->attempts <= 0 || now()->greaterThan($token?->expires_at))) {
                return response()->json([
                    'message' => 'El código no es válido o ya expiró. Solicita uno nuevo',
                    'attempts' => 0
                ], 401);
            }

            // Si el token no es valido, decrementar la cantidad de intentos, del token de la sesión.
            if (!$token) {
                $user_token = PasswordResetToken::find($request->session()->get('password_reset_token_id'));
                $user_token->decrement('attempts');

                return response()->json([
                    'message' => 'El código es incorrecto',
                    'attempts' => $user_token->attempts
                ], 422);
            } else {
                return response()->json([
                    'message' => 'El código es correcto.',
                    'html_replace' => '<form id="reset_password" action="/userpasword/reset" method="post" enctype="application/x-www-form-urlencoded"
                                            class="needs-validation" autocomplete="off" novalidate>
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="' . csrf_token() . '">

                                            <h3 class="text-body-emphasis my-3 fw-boldy" style="font-size: 0.8rem; text-align: justify;">Tu usuario es ' . $token->user->name . ', restablece tu contraseña</h3>

                                            <div class="form-floating my-2">
                                                <input type="text" maxlength="255" required class="form-control" id="password" name="password"
                                                placeholder="" value="" />
                                                <label for="password">Contraseña</label>
                                                <div class="invalid-feedback" id="password_invalid_feedback">
                                                Ingresa una contraseña válida.
                                                </div>
                                                <div class="valid-feedback">
                                                Las contraseñas coinciden.
                                                </div>
                                            </div>

                                            <div class="form-floating mb-2">
                                                <input type="text" maxlength="255" required class="form-control" id="confirm_password"
                                                name="confirm_password" placeholder="" value="" />
                                                <label for="confirm_password">Confirmación de contraseña</label>
                                                <div class="invalid-feedback" id="confirm_password_invalid_feedback">
                                                Ingresa una confirmación de contraseña válida.
                                                </div>
                                                <div class="valid-feedback">
                                                Las contraseñas coinciden.
                                                </div>
                                            </div>

                                            <div class="d-flex justify-between flex-row align-items-center my-1 gap-3">
                                                <div class="w-50">
                                                <hr class="border border-2 opacity-75" style="border-color: var(--extra-color-1) !important;">
                                                </div>
                                                <div class="w-50">
                                                <hr class="border border-2 opacity-75" style="border-color: var(--extra-color-1) !important;">
                                                </div>
                                            </div>

                                            <button id="submit" class="btn my-2 w-100 py-2 element-animation" type="button" disabled>
                                                Actualizar contraseña
                                            </button>

                                            <br><br><br><br><br>
                                            </form>',
                ], 200);
            }
        } catch (\Throwable $th) {
        }
    }
}
