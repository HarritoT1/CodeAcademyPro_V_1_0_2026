<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class CourseController extends Controller
{
    public function index() {
        $user = Auth::user();
        $enrolled_course_ids = $user->courses->pluck('id')->toArray();
        $newcourses = Course::whereNotIn('id', $enrolled_course_ids)->get();

        return view('userpages.newcourses', compact('user', 'newcourses'));
    }

    public function inscription(Course $course) {
        // El curso existe por el parameter model binding. Si no existe, lanza una excepción 404 y se muestra la vista de 404, ya no llega al controlador.
        $user = Auth::user();

        // validar que el usuario no se haya inscrito en el curso.
        if ($user->courses()->where('courses.id', $course->id)->exists()) {
            return redirect()->back()->withErrors(['error' => 'El usuario ya se encuentra inscrito en el curso.']);
        }

        // Si el usuario no se encuentra inscrito en el curso, se inscribe.
        $user->courses()->syncWithoutDetaching([$course->id]);

        return redirect()->back()->with('success', 'El usuario se ha inscrito en el curso.');
    }
}
