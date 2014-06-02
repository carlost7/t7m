@extends('layouts.master')

@section('title')
@parent

- Correo {{ $correo->correo }} 
@stop



@section('content')
<div class="jumbotron">
      <div class="container">
            <h2>{{ HTML::linkRoute('admin.calendarios.index','Calendario') }} > {{ $calendario->dominio }}</h2>
      </div>
</div>
<div class="container">

      <ul>
            <li>
                  Dominio: {{ $calendario->dominio }}
            </li>
            <li>
                  Fecha de inicio: {{ $calendario->inicio }}
            </li>
            <li>
                  Fecha de finalización: {{ $calendario->fin }}
            </li>
            <li>
                  Tiempo faltante para la renovación: {{ $tiempo_faltante }}
            </li>
            <li>
                  Entidad registradora: {{ $calendario->registrador }}
            </li>
      </ul>


</div>




@stop

@section('footer')@stop