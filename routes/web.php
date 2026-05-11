<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login'); // http://127.0.0.1:8000/ 
});

Route::get('/userpassword', function () {
    return view('userpassword'); // http://127.0.0.1:8000/userpassword
});

Route::get('/contact', function () {
    return view('userpages.contact'); // http://127.0.0.1:8000/contact
});

Route::get('/course', function () {
    return view('userpages.course'); // http://127.0.0.1:8000/course
});

Route::get('/newcourses', function () {
    return view('userpages.newcourses'); // http://127.0.0.1:8000/newcourses
});

Route::get('/user', function () {
    return view('userpages.user'); // http://127.0.0.1:8000/user
});

Route::get('/usercourses', function () {
    return view('userpages.userhome'); // http://127.0.0.1:8000/usercourses
});

Route::get('/usernew', function () {
    return view('usernew'); // http://127.0.0.1:8000/usernew
}); 