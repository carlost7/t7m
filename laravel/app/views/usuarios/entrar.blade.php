@extends('layouts.master')

@section('title')
@parent

| Entrar 
@stop



@section('content')

<div class="jumbotron">

      <div class="container">
            <h2>Bienvenido al Panel de Administración de T7Marketing</h2>
            <h3>Escribe los datos para ingresar</h3>
            
      </div>
</div>
<div class="container">

      {{ Form::open(array('route'=>'usuario.login')) }}
      @if($errors->has())
      @foreach ($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
      @endforeach
      @endif      
      <br />
      <div class="form-group">
            <label for="Correo">Correo</label>
            <input type="email" name="correo" value="{{ Input::old('correo') }}" class="form-control" id="Correo" placeholder="Escribe tu correo">
      </div>
      <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" name="password" class="form-control" id="Password" placeholder="Contraseña">             
      </div>      
      <div class="form-group">
            <div class="checkbox">
                  <label>
                        <input type="checkbox"> Permanecer conectado
                  </label>
            </div>
      </div>                  
      <button type="submit" id='confirmar' class="btn btn-success btn-md">Entrar</button>        
      {{ HTML::linkRoute('usuario.recuperar','¿Olvidaste tu contraseña?',null,array('class'=>'btn btn-danger btn-md')) }}
      {{ Form::close() }}
</div>

@stop

@section('footer')
@parent
@stop

