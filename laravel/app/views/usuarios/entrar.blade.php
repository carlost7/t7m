@extends('layouts.master')

@section('title')
@parent

| Entrar 
@stop



@section('content')

<div class="jumbotron">

      <div class="container">
            <h1>Escribe tus datos para entrar</h1>
            
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
                        <input type="checkbox"> Seguir conectado
                  </label>
            </div>
      </div>                  
      <button type="submit" id='confirmar' class="btn btn-success btn-md">Entrar</button>        
      {{ HTML::linkRoute('usuario.recuperar','Recuperar Contraseña',null,array('class'=>'btn btn-danger btn-md')) }}
      {{ Form::close() }}
</div>

@stop

@section('footer')
@parent
@stop

