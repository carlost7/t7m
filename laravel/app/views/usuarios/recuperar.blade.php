@extends('layouts.master')

@section('title')
@parent

| Recuperar Contraseña
@stop



@section('content')

<div class="jumbotron">

      <div class="container">
            <h3>Escribe el correo con el que se creo tu cuenta para poder restaurarla</h3>            
      </div>

</div>
<div class="container">

      {{ Form::open(array('route'=>'usuario.recuperar')) }}
      <div class="form-group">
            <label for="Correo">Correo</label>
            <input type="email" name="email" value="{{ Input::old('correo') }}" class="form-control" id="Correo" placeholder="Escribe tu correo">
      </div>            
      <button type="submit" id='recordar' class="btn btn-success btn-lg">Enviar correo</button>
      {{ Form::close() }}
</div>

@stop

@section('footer')
@parent
@stop
