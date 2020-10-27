<?php

use Illuminate\Support\Facades\Route;

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

// Debugear cuantas consultas ejecuta por llamar el recurso
/*DB::listen(function ($query) {
    echo '<pre>' . $query->sql . '</pre>';   // consulta sql
    echo '<pre>' . $query->time . '</pre>';  // tiempo en retornar el servidor
});*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');
Route::get('user-image/{id}', 'UsersController@getImageUser')->name('user-image');

Route::resource('messages', 'MessagesController');



// Execute job test
Route::get('job', function(){

    dispatch(new \App\Jobs\SendEmail);

    return "Ejecutado";

});
