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

// Route::get('/', function () {
//     return view('welcome');
// Register & Login User
// });
Route::middleware(['guest'])->group(function () {
    Route::get('/', 'LoginController@index')->name('login');
    Route::post('login', 'LoginController@autenticar');
    Route::get('/logout', 'LoginController@logout')->name('logout');
    Route::post('/register', 'RegistrationController@register');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('perfil', 'PerfilController@index')->name('perfil');
    Route::get('edit', 'PerfilController@edit')->name('edit');
    //POST
    Route::get('post', 'PostController@index')->name('post');
    //ESTADISTICAS
    Route::get('estadistaca', 'EstadisticaController@index')->name('estadistaca');

    Route::post('update', 'PerfilController@update')->name('update');
    Route::post('updatePass', 'PerfilController@updatePass')->name('updatePass');
    Route::post('registrar', 'RegistrarController@crear')->name('registrar');
    Route::get('registrar', 'RegistrarController@index')->name('registrar');
    Route::get('editConfiguracion', 'ConfiguracionController@edit')->name('editConfiguracion');
    Route::post('updateConfiguracion', 'ConfiguracionController@update')->name('updateConfiguracion');
});



