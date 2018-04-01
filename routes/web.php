<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function (){
    Route::resource('/users', 'UsersController');
});

Route::group(['middleware' => 'guest'], function (){
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register')->name('register');
    Route::get('/login', 'AuthController@loginForm')->name('login');
    Route::post('/login', 'AuthController@login')->name('logIn');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');
    Route::get('/profile/{id}', 'ProfileController@edit')->name('profile.edit');
    Route::put('/profile/{id}/update', 'ProfileController@update')->name('profile.update');
    Route::resource('/tasks', 'TasksController');
    Route::get('/active/tasks', 'TasksController@active')->name('tasks.active');
    Route::get('/complete/tasks', 'TasksController@complete')->name('tasks.complete');
    Route::get('/personal/tasks', 'TasksController@personal')->name('tasks.personal');
    Route::get('/external/tasks', 'TasksController@external')->name('tasks.external');
    Route::get('/toggle/{id}', 'TasksController@toggle')->name('toggle');
    Route::get('/send/tasks', 'TasksController@sendForm')->name('sendForm');
    Route::post('/send/tasks', 'TasksController@send')->name('send');
});


Route::get('/', 'HomeController@index')->name('home');
