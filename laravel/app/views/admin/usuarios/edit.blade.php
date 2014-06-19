@extends('layouts.master')

@section('title')
@parent

- Usuario {{ $usuario->email }} 
@stop



@section('content')
<div class="jumbotron">
      <div class="container">
            <h2>{{ HTML::linkRoute('admin.usuarios.index','Usuarios') }} > {{ $usuario->email }}</h2>            
      </div>
</div>
<div class="container">
      {{ Form::model($usuario, array('url'=> array('admin/usuarios/'.$usuario->id),'method'=>'PUT')) }}
      
      @foreach($errors->all() as $message)
      <div class="alert alert-danger">{{ $message }}</div>
      @endforeach
      
      <div class="form-group">
            
            {{ Form::label('email','Correo') }}
            {{ Form::text('email',null,array('class'=>'form-control')) }}            
            
      </div>
      <div class="form-group">
            <label for="password">Password</label>            
            <div class="input-group">
                  <input type="password" name="password" class="form-control" id="Password" placeholder="Contraseña">
                  <span class="input-group-btn">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalPassword" onclick="get_password()">
                              Generar Contraseña
                        </button>
                  </span>                  
            </div>
      </div>
      <div class="form-group">
            <label for="password_confirmation">Confirmar</label>
            <input type="password" name="password_confirmation" class="form-control" id="Password_confirmation" placeholder="Confirma tu contraseña">
      </div>      
      <button type="submit" id='confirmar' class="btn btn-success">Confirmar Dominio</button>
      {{ Form::close() }}
</div>


<br />

@include('layouts.modal_password')

@stop

