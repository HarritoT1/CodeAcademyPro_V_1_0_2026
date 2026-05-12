<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

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
}
 