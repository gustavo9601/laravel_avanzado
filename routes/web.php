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
Route::get('user-image/{id}', 'UsersController@getImageUser')->name('user.image');

Route::resource('messages', 'MessagesController');

Route::resource('chats', 'ChatController');
Route::post('chats/read/{id}', 'ChatController@read')->name('chats.read');
Route::delete('chats/{id}', 'ChatController@destory')->name('chats.destroy');


use Carbon\Carbon;
// Prueba de envio de notificaciones masiva
Route::get('great-all-users', function () {

    $users = \App\User::all();
    $message = 'Un cordial saludo a todos hoy ' . Carbon::today();
    // Usando el fasar Notification le pasamos al send(instancia de usuarios a enviar notificacion, clase de la notificacion)
    \Notification::send($users, new \App\Notifications\GreatAllUsers($message));

    return redirect()->to('/')->with(['flash' => 'mesnaje enviado a todos los usuarios']);
    // Por lo general se puede delegar a un listener como queue

})->name('great.all.users')
    ->middleware(['auth']);


// Execute job test
Route::get('job', function () {

    dispatch(new \App\Jobs\SendEmail);

    return "Ejecutado";

});


// Reports

Route::get('reports/export-pdf', 'ExportDataFilesController@exportToPdf')->name('reports.export-pdf');
Route::get('reports', 'ExportDataFilesController@index')->name('reports');
