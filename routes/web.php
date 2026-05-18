<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('login'); // http://127.0.0.1:8000/ 
})->name('login'); // Asigna un nombre a la ruta para redirecciones.

// Mecanismos de login y logout. --------------------------------

Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate.login');

Route::get('/deauthentication', [LoginController::class, 'logout'])->name('deauthentication.logout');

// Mecanismos de OAuth 2.0 con Google. --------------------------------

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.redirect'); 

Route::get('/auth/google/callback', function () {

    try {
        $googleUser = Socialite::driver('google')->user();

        $user_old = User::where('email', $googleUser->getEmail())->first();

        $user = User::updateOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'google_id' => $googleUser->getId(),
            'name' => $user_old?->name ?? $googleUser->getName(),
            'email_verified_at' => $user_old?->email_verified_at ?? now(),
            'avatar_url' => $user_old?->avatar_url ?? $googleUser->getAvatar(),
        ]);

        Auth::login($user, true);

        return redirect()->route('dashboard');

    } catch (\Throwable $th) {
        return redirect()->route('login')->withErrors(['google' => 'Error al iniciar sesión con Google' . $th->getMessage()]);
    }
})->name('auth.callback');

// Rutas protegidas. --------------------------------

Route::middleware(['auth', 'verified'])->group(function () { // Protege la ruta con autenticación y verificación.

    Route::get('/usercourses', [UserController::class, 'index'])->name('dashboard'); // http://127.0.0.1:8000/usercourses

    Route::get('/contact', function () {
        return view('userpages.contact', ['user' => Auth::user()]); // http://127.0.0.1:8000/contact
    })->name('contact'); // Asigna un nombre a la ruta para redirecciones.

    Route::get('/user/{user}', [UserController::class, 'show'])->name('user')->where('user', '[0-9]+'); // http://127.0.0.1:8000/user/{id} - Asegura que el ID sea un número entero.

    Route::put('/user', [UserController::class, 'update'])->name("user.update");
});

// Creación de usuarios. --------------------------------

Route::get('/usernew/{user?}', function ($user = null) {
    if ($user) $user = User::findOrFail($user);
    return view('usernew', ['roles' => Role::all(), 'user' => $user]); // http://127.0.0.1:8000/usernew
})->name("usernew")->where('user', '[0-9]+');

Route::post('/usernew', [UserController::class, 'store'])->name("usernew.store");

Route::get('/email/verify', function () {
    return view('usernew', ['roles' => Role::all(), 'user' => Auth::user()]);
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/usercourses');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', '¡Email de verificación enviado!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Eliminación de usuarios. --------------------------------

Route::delete('/usernew/cancel', [UserController::class, 'destroy'])->middleware('auth')->name("usernew.destroy");

// Recuperar contraseña de usuarios. --------------------------------

Route::get('/userpassword', function () {
    return view('userpassword'); // http://127.0.0.1:8000/userpassword
})->name("userpassword");

Route::post('/userpassword', [UserController::class, 'requestCode'])->name("userpassword.code");

Route::post('/userpassword/validate', [UserController::class, 'validateCode'])->name("userpassword.validate");

Route::put('/userpasword/reset', [UserController::class, 'resetPassword'])->name("userpassword.reset");


/************************************************************************************************ CURSOS ***************************************************************************************/

Route::middleware(['auth', 'verified'])->group(function () { // Protege la ruta con autenticación.

    Route::get('/newcourses', [CourseController::class, 'index'])->name('newcourses'); // http://127.0.0.1:8000/newcourses

    Route::post('/newcourses/{course}', [CourseController::class, 'inscription'])->name('newcourses.inscription')->where('course', '[0-9]+'); 

    Route::get('/course/{course}', [CourseController::class, 'show'])->name('course')->where('course', '[0-9]+');

    Route::post('/course/{course}/advance' , [CourseController::class, 'advance'])->name('course.advance')->where('course', '[0-9]+');

    Route::get('/certificate', [CourseController::class, 'certificate'])->name('certificate');
});
