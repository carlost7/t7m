<!DOCTYPE html>
<html lang="es">
      <head>
            <meta charset="utf-8">
      </head>
      <body>
            <h2>Bienvenido a T7marketing</h2>
            <p>Designamos una cuenta en nuestro panel de control para que puedas crear y gestionar tus correos.</p>
            <br>
            <p>Haz click en el siguiente link para poder entrar a la aplicación:</p>
            <div>
                  <h3>
                        Creamos una cuenta en nuestro panel de control para que puedas crear tus correos
                  </h3>

                  <p>El link para entrar a la aplicación es el siguiente</p>
                  
                  {{URL::route('inicio','Panel de Usuario - T7Marketing')}}

                  <p>Introduce los siguientes datos de entrada:</p>
                  
                  <ul>
                        <li>
                              Usuario: {{ $usuario }}
                        </li>
                        <li>
                              Password: {{ $password }}
                        </li>
                  </ul>                 
                  
                  <p>Sigue las instrucciones de la página y en poco tiempo podrás manejar tus cuentas de correo electrónico, con tus propias contraseñas.</p>

                  <strong>T7Marketing</strong>
            </div>
      </body>
</html>