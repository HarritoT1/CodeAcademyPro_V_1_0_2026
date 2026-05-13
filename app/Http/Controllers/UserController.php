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
                return response()->json([
                    'message' => 'El correo electrónico no se encuentra registrado.'
                ], 401);
            }

            $token = $user->password_reset_token;

            // Si aún existe uno válido.
            if ($token && $token->attempts > 0 && now()->lessThan($token->expires_at)
            ) {
                return response()->json([
                    'message' => 'El código sigue vigente. Espera para resolicitar uno nuevo.',
                    'attempts' => $token->attempts
                ], 200);
            }

            // Si no existe un token válido.
            $code = Str::random(6);
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

    public function updatePassword(Request $request)
    {
        try {;
        } catch (\Throwable $th) {
        }
    }
}
