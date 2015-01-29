<?php

/**
 * Modelo para manejar las funciones que realiza el WHM sdk
 *
 * @author carlos
 */
class WHMFunciones {

      protected $xmlapi;
      protected $plan;

      public function __construct($plan)
      {
            $this->xmlapi = new xmlapi(Config::get('whm.host'));
            $this->xmlapi->set_user(Config::get('whm.username'));
            $this->xmlapi->set_hash(Config::get('whm.hash'));
            $this->xmlapi->set_output('json');
            $this->plan = $plan;
      }

      /*
        |--------------------------------------------------
        |    Seccion para agregar elementos al servidor
        |--------------------------------------------------
       */

      /*
       * Funcion para agregar un dominio/addon al servidor 
       */

      public function agregarDominioServidor($domain, $subdomain, $password)
      {

            if (!isset($domain) || !isset($subdomain) || !isset($password))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WHMFunciones. AgregarDominioServidor, Faltan datos en la funcion');
                  return false;
            }

            $response = $this->xmlapi->api2_query($this->plan->name_server, "AddonDomain", "addaddondomain", array('newdomain' => $domain, 'dir' => "public_html/" . $domain,
                  'subdomain' => $subdomain, 'pass' => $password)
            );

            $resultado = json_decode($response, true);
            if ($resultado['cpanelresult']['data'][0]['result'] == 1)
            {
                  return true;
            }
            else
            {
                  Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                  Log::error('WHMFunciones. AgregarDominioServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                  return false;
            }
      }

      /*
       * Agregar Correos al servidor
       */

      public function agregarCorreoServidor($domain, $email, $password)
      {

            if (!isset($domain) || !isset($email) || !isset($password))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WHMFunciones. AgregarCorreoServidor, Faltan datos en la funcion');
                  return false;
            }
            else
            {
                  $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'addpop', array('domain' => $domain, 'email' => $email, 'password' => $password, 'quota' => $this->plan->quota_correos));

                  $resultado = json_decode($response, true);
                  if ($resultado['cpanelresult']['data'][0]['result'] == 1)
                  {
                        return true;
                  }
                  else
                  {
                        Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                        Log::error('WHMFunciones. AgregarCorreoServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                        return false;
                  }
            }
      }

      /*
       * Agregar Forwarder al servidor;
       */

      public function agregarForwardServidor($domain, $email, $redireccion)
      {

            if (!isset($domain) || !isset($email) || !isset($redireccion))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WHMFunciones. AgregarForwardServidor, Faltan datos en la funcion');
                  return false;
            }
            else
            {
                  $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'addforward', array('domain' => $domain, 'email' => $email, 'fwdopt' => 'fwd', 'fwdemail' => $redireccion));

                  $resultado = json_decode($response, true);
                  Log::error($resultado);
                  if (!isset($resultado['cpanelresult']['error']))
                  {
                        return true;
                  }
                  else
                  {
                        Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                        Log::error('WHMFunciones. AgregarForwarderServidor ' . $resultado['cpanelresult']);
                        return false;
                  }
            }
      }

      /*
       * Funcion para agregar un dominio/addon al servidor 
       */

      public function agregarFtpServidor($user_name, $home_dir, $pass)
      {
            if (!isset($user_name) || !isset($pass) || !isset($home_dir))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WHMFunciones. AgregarFTPServidor, Faltan datos en la funcion ' . $user_name . ' ' . $home_dir . ' ' . $pass);
                  return false;
            }
            else
            {

                  $response = $this->xmlapi->api2_query($this->plan->name_server, "Ftp", "addftp", array('pass' => $pass, 'user' => $user_name, 'quota' => $this->plan->quota_ftps, 'homedir' => $home_dir));

                  $resultado = json_decode($response, true);


                  if ($resultado['cpanelresult']['data'][0]['result'] == 1)
                  {
                        return true;
                  }
                  else
                  {
                        Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                        Log::error('WHMFunciones. AgregarFtpServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                        return false;
                  }
            }
      }

      /*
       * Funcion para agregar un dominio/addon al servidor 
       */

      public function agregarDbServidor($username, $password, $dbname)
      {
            if (!isset($username) || !isset($password) || !isset($dbname))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WHMFunciones. AgregarDbServidor, Faltan datos en la funcion ' . $username . ' ' . $password . ' ' . $dbname);
                  return false;
            }


            $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "adduser", array($username, $password));

            if ($response != false)
            {
                  $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "adddb", array($dbname));
                  if ($response != false)
                  {
                        $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "adduserdb", array($dbname, $username, 'all'));
                        if ($response != false)
                        {
                              return true;
                        }
                        else
                        {
                              Log::error('WHMFunciones. agregarDbServidor Error al agregar la base de datos');
                              return false;
                        }
                  }
            }

            $resultado = json_decode($response, true);
            if ($resultado['cpanelresult']['data'][0]['result'] == 1)
            {
                  return true;
            }
            else
            {
                  Log::error('WHMFunciones. AgregarDbServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                  return false;
            }
      }

      /*
        |-----------------------------------------------
        |    Seccion para editar elementos del servidor
        |-----------------------------------------------
       */

      /*
       * Funciones para editar el password del servidor
       */

      public function editarPasswordCorreoServidor($domain, $email, $password)
      {

            if (!isset($domain) || !isset($email) || !isset($password))
            {
                  Session::flash('error', 'falta un argumento');
                  return false;
            }
            else
            {
                  $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'passwdpop', array('domain' => $domain, 'email' => $email, 'password' => $password));

                  $resultado = json_decode($response, true);
                  if ($resultado['cpanelresult']['data'][0]['result'] == 1)
                  {
                        return true;
                  }
                  else
                  {
                        Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                        Log::error('WHMFunciones. AgregarPasswordCorreoServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                        return false;
                  }
            }
      }

      /*
       * Funciones para editar el password del servidor
       */

      public function editarPasswordFtpServidor($user, $pass)
      {

            if (!isset($user) || !isset($pass))
            {
                  Session::flash('error', 'falta un argumento');
                  return false;
            }
            else
            {
                  $response = $this->xmlapi->api2_query($this->plan->name_server, 'Ftp', 'passwd', array('user' => $user, 'pass' => $pass));

                  $resultado = json_decode($response, true);
                  if ($resultado['cpanelresult']['data'][0]['result'] == 1)
                  {
                        return true;
                  }
                  else
                  {
                        Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                        Log::error('WHMFunciones. editarPasswordFtpServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                        return false;
                  }
            }
      }

      /*
        |---------------------------------------------------
        |    Seccion para eliminar del servidor
        |---------------------------------------------------
       */

      public function eliminarDominioServidor($domain, $subdomain)
      {

            if (!isset($domain) || !isset($subdomain))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WHMFunciones. eliminarDominioServidor: faltan datos para eliminar el dominio');
                  return false;
            }
            else
            {
                  $response = $this->xmlapi->api2_query($this->plan->name_server, 'AddonDomain', 'deladdondomain', array('domain' => $domain, 'subdomain' => $subdomain));

                  $resultado = json_decode($response, true);
                  if ($resultado['cpanelresult']['data'][0]['result'] == 1)
                  {
                        return true;
                  }
                  else
                  {
                        Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                        Log::error('WHMFunciones. eliminarDominioServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                        return false;
                  }
            }
      }

      /*
       * Funcion para eliminar un correo del servidor
       */

      public function eliminarCorreoServidor($domain, $username)
      {
            if (!isset($domain) || !isset($username))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WHMFunciones. eliminarCorreoServidor: faltan datos para eliminar el correo');
                  return false;
            }
            else
            {
                  $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'delpop', array('domain' => $domain, 'email' => $username,));

                  $resultado = json_decode($response, true);
                  if ($resultado['cpanelresult']['data'][0]['result'] == 1)
                  {
                        return true;
                  }
                  else
                  {
                        Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                        Log::error('WHMFunciones. EliminarCorreoServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                        return false;
                  }
            }
      }

      /*
       * Funcion para eliminar forwarders del servidor
       */

      public function eliminarFwdServidor($email, $forward)
      {
            if (!isset($email) || !isset($forward))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WHMFunciones. eliminarCorreoServidor: faltan datos para eliminar el correo');
                  return false;
            }
            else
            {
                  $this->xmlapi->api1_query($this->plan->name_server, 'Email', 'delforward', array($email . '=' . $forward));
                  return true;
            }
      }

      /*
       * Funcion para eliminar un correo del servidor
       */

      public function eliminarFtpServidor($user, $borrar)
      {
            if (!isset($user) || !isset($borrar))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WhmFunciones. EliminarFtpServidor, Faltan datos en la funcion');
                  return false;
            }
            else
            {
                  $response = $this->xmlapi->api2_query($this->plan->name_server, 'Ftp', 'delftp', array('user' => $user, 'destroy' => $borrar));

                  $resultado = json_decode($response, true);
                  if ($resultado['cpanelresult']['data'][0]['result'] == 1)
                  {
                        return true;
                  }
                  else
                  {
                        Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                        Log::error('Error en WHM: EliminarFTPServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                        return false;
                  }
            }
      }

      /*
       * Funcion para eliminar un correo del servidor
       */

      public function eliminarDbServidor($username, $dbname)
      {
            if (!isset($username) || !isset($dbname))
            {
                  Session::flash('error', 'falta un argumento');
                  Log::error('WhmFunciones. EliminarDBServidor, Faltan datos en la funcion');
                  return false;
            }


            $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "deluserdb", array($dbname, $username));

            if ($response != false)
            {

                  $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "deluser", array($username));
                  if ($response != false)
                  {
                        $response = $this->xmlapi->api1_query($this->plan->name_server, "Mysql", "deldb", array($dbname));
                        if ($response != false)
                        {
                              return true;
                        }
                        else
                        {
                              Log::error('Error whm: EliminarDBServidor Error al eliminar la base de datos');
                              return false;
                        }
                  }
                  else
                  {
                        Log::error('Error whm: EliminarDBServidor Error al eliminar el usuario');
                        return false;
                  }
            }
            else
            {
                  Log::error('Error whm: EliminarDBServidor Error al eliminar el usuario de la base de datos');
                  return false;
            }
      }

      /*
        |--------------------------------
        | Obtener quotas
        |--------------------------------
       */

      /*
       * obtiene el uso de un solo correo del servidor
       */

      public function obtenerQuotaCorreoServidor($username, $domain)
      {
            $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'getdiskusage', array('user' => $username, 'domain' => $domain));

            $resultado = json_decode($response, true);
            return $resultado['cpanelresult']['data']['0']['diskused'];
      }

      /*
       * Obtiene el uso de los correos
       */

      public function obtenerQuotaCorreosServidor($domain)
      {     dd($this->plan->name_server);
            $response = $this->xmlapi->api2_query($this->plan->name_server, 'Email', 'listpopswithdisk', array('domain' => $domain));

            $resultado = json_decode($response, true);
            $quotas = array();
            dd($resultado);
            if ($resultado['cpanelresult']['data'] != null)
            {
                  foreach ($resultado['cpanelresult']['data'] as $result)
                  {
                        $correo = array('diskquota' => $result['diskquota'], 'diskused' => $result['diskused']);
                        $quotas[$result['login']] = $correo;
                  }
                  return $quotas;
            }
            else
            {
                  return null;
            }
      }

      /*
       * Obtiene el uso de la base de datos
       */

      public function obtenerQuotaDBServidor($dbname)
      {

            if (!isset($dbname))
            {
                  Log::error('WHMFunciones: obtenerQuotaDBServidor: Error no especifico nombre de base de datos');
                  return false;
            }

            $response = $this->xmlapi->api2_query($this->plan->name_server, 'MysqlFE', 'listdbs', array('regex' => $dbname));

            $resultado = json_decode($response, true);
            if (isset($resultado['cpanelresult']['data'][0]['db']))
            {
                  $database = $resultado['cpanelresult']['data'];
                  return $database;
            }
            else
            {
                  Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['reason']);
                  Log::error('WHMFunciones. EliminarFTPServidor ' . $resultado['cpanelresult']['data'][0]['reason']);
                  return false;
            }
      }

      /*
        |----------------------------------
        |    Agregar cuentas de cpanel
        |----------------------------------
       */

      /*
       * Agregar cuenta al servidor
       */

      public function agregarCuentaHostServidor($username, $domain_name, $password)
      {
            if (!isset($username) || !isset($domain_name) || !isset($password))
            {
                  Log::error('WHMFunciones: agregarCuentaHostServidor: no especifico username o domain name o password');
                  return false;
            }

            $acctconf = array('username' => $username,
                  'password' => $password,
                  'domain' => $password,
                  'plan'=>'primerse_enterprise');

            $response = $this->xmlapi->createacct($acctconf);
            $resultado = json_decode($response, true);
            if ($resultado['cpanelresult']['data'][0]['createacct']['result'] == 1)
            {
                  return true;
            }
            else
            {
                  Session::set('mensaje_servidor', 'El servidor respondio: ' . $resultado['cpanelresult']['data'][0]['createacct']['statusmsg']);
                  Log::error('Error en WHM: EliminarFTPServidor ' . print_r($resultado,true));
                  return false;
            }
      }

}
