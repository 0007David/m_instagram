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
    Route::post('insertPost', 'PostController@insertPost')->name('insertPost');
    //ESTADISTICAS
    Route::get('estadistaca', 'EstadisticaController@index')->name('estadistaca');

    //COMENTARIOS
    Route::get('comentarios', 'ComentarioController@index')->name('comentarios');

    //SEGUIDOS
    Route::get('seguido', 'SeguidorController@index')->name('seguido');

    Route::post('update', 'PerfilController@update')->name('update');
    Route::post('updatePass', 'PerfilController@updatePass')->name('updatePass');
    Route::post('registrar', 'RegistrarController@crear')->name('registrar');
    Route::get('registrar', 'RegistrarController@index')->name('registrar');
    Route::get('editConfiguracion', 'ConfiguracionController@edit')->name('editConfiguracion');
    Route::post('updateConfiguracion', 'ConfiguracionController@update')->name('updateConfiguracion');
    Route::post('updateFoto', 'PerfilController@updateFoto')->name('updateFoto');
});
Route::namespace('Admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    //USUARIO
    Route::get('usuarios', 'UserController@index')->name('usuarios');
    Route::get('usuario/{id}','UserController@show')->where('id','[0-9]+')->name('usuarios.show');
    Route::put('usuario', 'UserController@update')->name('usuarios.update');

    Route::get('configuraciones', 'ConfiguracionController@index')->name('configuraciones');
    Route::get('seguidores', 'SeguidorController@index')->name('seguidores');
    Route::get('postsynotifs', 'PostController@index')->name('postsynotifs');
    Route::get('likes', 'LikeController@index')->name('likes');
    Route::get('comentarios', 'ComentarioController@index')->name('comentarios');
    Route::get('contactos', 'ContactoController@index')->name('contactos');
    Route::get('reportes', 'ReporteController@index')->name('reportes');
    Route::get('estadisticas', 'EstadisticaController@index')->name('estadisticas');
});





