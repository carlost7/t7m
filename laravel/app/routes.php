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

Route::get('prueba', function() {

      $a   = array(1, 2, 3);
      $b   = array(2, 3, 4);
      $bp  = array(5, 1, 2);
      $bpp = array(7, 1, 2, 3);

      $delb   = array_diff($a, $b);
      $delbp  = array_diff($a, $bp);
      $delbpp = array_diff($a, $bpp);


      $addb   = array_diff($b, $a);
      $addbp  = array_diff($bp, $a);
      $addbpp = array_diff($bpp, $a);


      $intb   = array_merge(array_intersect($a, $b), $addb);
      $intbp  = array_merge(array_intersect($a, $bp), $addbp);
      $intbpp = array_merge(array_intersect($a, $bpp), $addbpp);

      dd($intb);
});

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

            Route::get('crear_correos', function() {
                  dd(Session::get('dominio_usuario'));
                  $correo = new CorreosRepositoryEloquent(Session::get('dominio_usuario'));

                  $quotas = $correo->listarQuotas();

                  foreach ($quotas as $correo){

                  }
                  dd($quotas);

                  $nombre = Input::get('nombre');
                  if (strpos(Input::get('correo'), '@'))
                  {
                        Session::flash('error', 'El campo correo solo debe contener el nombre de usuario');
                        return Redirect::to('admin/correos/create')->withInput();
                  }
                  $correo = Input::get('correo') . '@' . Session::get('dominio_usuario')->dominio;
                  $redireccion = Input::get('redireccion');
                  $password = Input::get('password');
                  if ($this->Correo->agregarCorreo($nombre, $correo, $redireccion, $password))
                  {
                        Session::flash('message', 'Correo Agregado con exito');
                        return Redirect::to('admin/correos');
                  }
                  else
                  {
                        Session::flash('error', 'Error al crear el correo');
                  }


            });
      });

      Route::group(array('before' => 'is_project'), function() {

            Route::resource('portafolio', 'PortafoliosController');
      });
});


