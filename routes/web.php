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

    Route::get('buscar', 'HomeController@search')->name('buscar');
    Route::get('perfil', 'PerfilController@index')->name('perfil');
    Route::get('edit', 'PerfilController@edit')->name('edit');
    //POST
    Route::get('post', 'PostController@index')->name('post');
    Route::post('insertPost', 'PostController@insertPost')->name('insertPost');
    Route::post('post','PostController@eliminar')->name('post.eliminar');
    //ESTADISTICAS
    Route::get('estadistaca', 'EstadisticaController@index')->name('estadistaca');
    Route::get('generoSeguidor/{id}', 'EstadisticaController@estadisticaGeneroSeguidores');

    //COMENTARIOS
    Route::get('comentario/{id}', 'ComentarioController@index')->where('id','[0-9]+')->name('comentario');

    Route::post('comentarios', 'ComentarioController@crear')->name('comentarios');
    //Route::get('comentario', 'ComentarioController@show')->name('comentario');

    Route::get('contacto', 'ContactoController@index')->name('contacto');
    Route::get('crearcontacto', 'ContactoController@index2')->name('crearcontacto');
    Route::post('storecontacto', 'ContactoController@crear')->name('storecontacto');
    Route::get('compararcontacto', 'ContactoController@compararcontacto')->name('compararcontacto');
    Route::get('contacto/{id}','ContactoController@show')->where('id','[0-9]+')->name('contacto.show');
    Route::put('contacto', 'ContactoController@update')->name('contacto.update');
    Route::post('contacto', 'ContactoController@delete')->name('contacto.eliminar');

    //SEGUIDOS
    Route::get('user/{name}', 'SeguidorController@index')->name('seguido');
    Route::get('getseguidores/{id}', 'SeguidorController@getSeguidores')->name('getSeguidores');
    Route::get('getseguidor/{id}', 'SeguidorController@getSeguidor')->name('getSeguidor');
    Route::post('seguidorStore', 'SeguidorController@store')->name('seguidor.store');

    Route::post('update', 'PerfilController@update')->name('update');
    Route::post('updatePass', 'PerfilController@updatePass')->name('updatePass');
    Route::post('registrar', 'RegistrarController@crear')->name('registrar');
    Route::get('registrar', 'RegistrarController@index')->name('registrar');
    Route::get('editConfiguracion', 'ConfiguracionController@edit')->name('editConfiguracion');
    Route::post('updateConfiguracion', 'ConfiguracionController@update')->name('updateConfiguracion');
    Route::post('updateFoto', 'PerfilController@updateFoto')->name('updateFoto');

    //LIKES
    Route::post('like', 'LikeController@store')->name('like');

    //REPORTES
    Route::get('reportes/{tipo}', 'ReporteController@getReporte')->name('reportes');

    //LOG
    Route::post('counterViews', 'LogController@contadorVistas')->name('counterViews');

    //NOTIFICACIONES
    Route::get('notificaciones', 'NotificacionController@deleteNotificacion')->name('notificaciones');

});
Route::prefix('admin')->namespace('Admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
    //USUARIO
    Route::get('usuarios', 'UserController@index')->name('usuarios');
    Route::get('usuario/{id}','UserController@show')->where('id','[0-9]+')->name('usuarios.show');
    Route::post('usuarios','UserController@eliminar')->name('usuarios.eliminar');
    Route::put('usuario', 'UserController@update')->name('usuarios.update');

    Route::get('configuraciones', 'ConfiguracionController@index')->name('configuraciones');
    Route::get('configuracion/{id}','ConfiguracionController@show')->where('id','[0-9]+')->name('configuraciones.show');
    Route::put('configuracion', 'ConfiguracionController@update')->name('configuraciones.update');
    
    Route::get('seguidores/{id}', 'SeguidorController@index')->where('id','[0-9]+')->name('seguidores');
    Route::post('seguidores','SeguidorController@eliminar')->name('seguidores.eliminar');
    
    Route::get('postsynotifs', 'PostController@index')->name('postsynotifs');
    Route::get('post/{id}','PostController@show')->where('id','[0-9]+')->name('postsynotifs.show');
    Route::post('postsynotifs','PostController@eliminar')->name('postsynotifs.eliminar');
    Route::put('post', 'PostController@update')->name('postsynotifs.update');

    Route::get('likes', 'LikeController@index')->name('likes');

    Route::get('comentarios', 'ComentarioController@index')->name('comentarios');
    Route::get('comentario/{id}','ComentarioController@show')->where('id','[0-9]+')->name('comentarios.show');
    Route::put('comentario', 'ComentarioController@update')->name('comentarios.update');

    Route::get('contactos', 'ContactoController@index')->name('contactos');
    Route::get('contacto/{id}','ContactoController@show')->where('id','[0-9]+')->name('contactos.show');
    Route::put('contacto', 'ContactoController@update')->name('contactos.update');

    //REPORTES
    Route::get('reporteusuarios', 'ReporteController@index')->name('reporteusuarios');

    //ESTADISTICAS
    Route::get('estadisticas', 'EstadisticaController@index')->name('estadisticas');

    //LOG
    Route::get('accesslog', 'LogController@index')->name('accesslog');
    Route::get('accesslog/{nombre}', 'LogController@verLog')->name('accesslog');
});





