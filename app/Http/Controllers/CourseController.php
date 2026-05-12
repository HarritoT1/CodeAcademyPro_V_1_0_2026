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
}
