<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', array('as' => 'inicio', 'uses' => 'UsuariosController@login'));
Route::post('obtener_password', array('as' => 'obtener_password', 'uses' => 'UsuariosController@obtenerPass'));

/*
  |---------------------------------
  | Cuentas de usuario
  |---------------------------------
 */
Route::any('usuario/login', array('as' => 'usuario.login', 'uses' => 'UsuariosController@login'));
Route::any('usuario/recuperar', array('as' => 'usuario.recuperar', 'uses' => 'UsuariosController@recuperarPassword'));
Route::any('usuario/reset/{token}', array('as' => 'usuario.reset', 'uses' => 'UsuariosController@regenerarPassword'));

/*
  |--------------------------------------------------------
  | Todas las funciones que el usuario podra realizar
  |-------------------------------------------------------
 */
Route::group(array('before' => 'auth'), function() {

      /*
        |------------------------------------------------------------------------------- -
        | Terminar sesion de usuario, requiere estar loggeado para terminar la sesion
        ----------------------------------------------------------------------------------
       */
      Route::get('usuario/logout', array('as' => 'usuario.logout', 'uses' => 'UsuariosController@logout'));

      Route::resource('correos', 'CorreosController');



      /*
        |------------------------------------------
        |    Seccion del administrador
        |------------------------------------------
       */

      Route::group(array('before' => 'is_admin', 'prefix' => 'admin'), function() {

            /*
             * Admin / t7marketing
             */
            Route::resource('usuarios', 'AdminUsersController');

            Route::resource('correos', 'AdminCorreosController');

            Route::resource('ftps', 'AdminFtpsController');

            Route::resource('dbs', 'AdminDbsController');

            Route::resource('planes', 'AdminPlanesController');
            
            Route::resource('calendarios', 'AdminCalendarioDominiosController');
      });
});


