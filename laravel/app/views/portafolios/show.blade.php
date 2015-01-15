@extends('layouts.master')

@section('title')
{{ $portafolio->proyecto }} 
@stop



@section('content')
<div class="jumbotron">
      <div class="container">
            <h2>{{ HTML::linkRoute('portafolio.index','Regresar') }}</h2>
      </div>
</div>
<div class="container">
      <table class="table">
            <ul>
                  <li>Proyecto: {{$portafolio->proyecto}}</li>
                  <li>url: {{$portafolio->url}}</li>
                  <li>Descripción: {{$portafolio->descripcion}}</li>
                  <li>Prioridad: {{$portafolio->prioridad}}</li>
                  <li>categoria: {{json_encode($portafolio->categoria)}}</li>                  
                  <li>thumb: {{ HTML::Image('img/thumb/'.$portafolio->thumb_name)}}</li>                  
                  <li>full: {{ HTML::Image('img/fulls/'.$portafolio->full_name)}}</li>                  
            </ul>
            
      </table>
</div>
@stop

