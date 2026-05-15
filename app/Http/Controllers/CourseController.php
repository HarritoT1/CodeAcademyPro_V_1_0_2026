<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Subtopic;

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
            return redirect()->back()->withErrors(['error' => 'El usuario ya se encuentra inscrito en el curso: ' . $course->course_name . '.']);
        }

        // Si el usuario no se encuentra inscrito en el curso, se inscribe.
        $user->courses()->syncWithoutDetaching([$course->id]);

        return redirect()->back()->with('success', 'El usuario se ha inscrito en el curso: ' . $course->course_name . '.');
    }

    public function show (Course $course, Request $request) {
        $user = Auth::user();

        // Validar que este inscrito en el curso.
        if (!$user->courses()->where('courses.id', $course->id)->exists()) {
            return redirect()->route('newcourses')->withErrors(['error' => 'El usuario no se encuentra inscrito en el curso: ' . $course->course_name . '.']);
        }

        try {
            $topic = trim($request->input('topic')) == '' ? null : trim($request->input('topic'));
            $subtopic = trim($request->input('subtopic')) == '' ? null : trim($request->input('subtopic'));

            $content = null;

            if (isset($topic) && isset($subtopic)) { // Filtrando el subtema.
                $subtopicModel = Subtopic::where('id', $subtopic)->where('topic_id', $topic)->firstOrFail();

                if($subtopicModel->topic->course_id != $course->id) { 
                    throw new \Exception('Ese subtema no pertenece al curso.');
                } else $content = $subtopicModel;

            } else if (isset($topic)) { // Filtrando el tema.
                $content = Topic::where('id', $topic)->where('course_id', $course->id)->firstOrFail();
            } else if (isset($subtopic) && !isset($topic)) { // Filtrando directamente el subtema.
                    throw new \Exception('Parametros inválidos.');
            } else { // Inicio del curso.
                $content = $course;
            }

            $course->load([
                'topics' => fn($query) => $query->orderBy('id'),
                'topics.subtopics' => fn($query) => $query->orderBy('id')
            ]);

            $data = [
                'course' => $course,
                'content' => $content,
                'topic_id' => $topic,
                'subtopic_id' => $subtopic
            ];

            $data['content_type'] = get_class($data['content']);

            //dd($data);

            return view('userpages.course', $data);
        } catch (\Throwable $th) {
            return redirect()->route('course', ['course' => $course->id])->withErrors(['error' => 'Parametros inválidos.']);
        }
    }
}
