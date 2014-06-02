<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
      </head>
      <body>
            <h2>Bienvenido a T7Marketing</h2>
            <div>
                  <h3>
                        Creamos una cuenta en nuestro panel de control para que puedas crear tus correos
                  </h3>

                  <p>El link para entrar a la aplicación es el siguiente</p>
                  
                  {{URL::route('inicio','Panel de Usuario - T7Marketing')}}
                  
                  <p>Los datos de entrada son los siguientes</p>
                  <ul>
                        <li>
                              Usuario: {{ $usuario }}
                        </li>
                        <li>
                              Password: {{ $password }}
                        </li>
                  </ul>

                  <strong>T7Marketing</strong>
            </div>
      </body>
</html>
