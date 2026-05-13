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

class UserController extends Controller
{
    public function index() {
        $user = Auth::user(); // Obtiene el usuario autenticado actual.
        
        $user_courses = $user->courses->map(function ($course) use ($user) {
            $course->image_url = 'storage/' . $course->image_url; // Ajusta la URL de la imagen para que apunte al almacenamiento público.
            $course->progress = DB::select('CALL get_progress_in_course(?, ?)', [$course->id, $user->id])[0]->progress ?? 0; // Llama al procedimiento almacenado para obtener el progreso del usuario en el curso.
            return $course;
        });

        return view('userpages.userhome', compact('user', 'user_courses')); // http://127.0.0.1:8000/usercourses
    }

    public function show(User $user) {
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

    public function store (UserStoreRequest $request) {
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
}
 