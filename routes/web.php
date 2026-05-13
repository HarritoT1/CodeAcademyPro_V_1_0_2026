<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;

Route::get('/', function () {
    return view('login'); // http://127.0.0.1:8000/ 
})->name('login'); // Asigna un nombre a la ruta para redirecciones.

// Mecanismos de login y logout.

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate.login');

Route::get('/deauthentication', [LoginController::class, 'logout'])->name('deauthentication.logout');

// Mecanismos de login y logout.

Route::middleware(['auth'])->group(function () { // Protege la ruta con autenticación.

    Route::get('/usercourses', [UserController::class, 'index'])->name('dashboard'); // http://127.0.0.1:8000/usercourses

    Route::get('/contact', function () {
        return view('userpages.contact', ['user' => Auth::user()]); // http://127.0.0.1:8000/contact
    })->name('contact'); // Asigna un nombre a la ruta para redirecciones.

    Route::get('/newcourses', [CourseController::class, 'index'])->name('newcourses'); // http://127.0.0.1:8000/newcourses

    Route::get('/user/{user}', [UserController::class, 'show'])->name('user')->where('user', '[0-9]+'); // http://127.0.0.1:8000/user/{id} - Asegura que el ID sea un número entero.
});

Route::get('/userpassword', function () {
    return view('userpassword'); // http://127.0.0.1:8000/userpassword
})->name("userpassword");

Route::get('/usernew/{user?}', function ($user = null) {
    if ($user) $user = User::find($user);
    return view('usernew', ['roles' => Role::all(), 'user' => $user]); // http://127.0.0.1:8000/usernew
})->name("usernew")->where('user', '[0-9]+');

Route::post('/usernew', [UserController::class, 'store'])->name("usernew.store");






Route::get('/course', function () {
    return view('userpages.course'); // http://127.0.0.1:8000/course
});





