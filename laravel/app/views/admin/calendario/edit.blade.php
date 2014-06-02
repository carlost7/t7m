@extends('layouts.master')

@section('title')
@parent

- Correo {{ $correo->correo }} 
@stop



@section('content')
<div class="jumbotron">
      <div class="container">
            <h2>{{ HTML::linkRoute('admin.calendarios.index','Correos') }} > Editar: {{ $correo->correo }}</h2>
            <p>Agrega la contraseña en el campo de contraseña</p>
            <p>Modifica el correo de reenvio en el campo de reenvio</p>
      </div>
</div>
<div class="container">

      @foreach($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
      @endforeach

      {{ Form::model($calendario, array('url'=> array('admin/calendarios/'.$correo->id),'method'=>'PUT')) }}

      <div class="form-group">
            {{ Form::label('dominio','Nombre') }}
            {{ Form::text('dominio',null,array('class'=>'form-control','disabled'=>'disabled')) }}            
      </div>
      <div class="form-group">
            {{ Form::label('inicio','Fecha Inicio') }}
            {{ Form::text('inicio',null,array('class'=>'form-control','disabled'=>'disabled')) }}            
      </div>
      <div class="form-group">
            {{ Form::label('fin','Fecha Fin') }}
            {{ Form::text('fin',null,array('class'=>'form-control','disabled'=>'disabled')) }}            
      </div>
      <div class="form-group">
            {{ Form::label('registrador','Registrador') }}
            {{ Form::text('registrador',null,array('class'=>'form-control','disabled'=>'disabled')) }}            
      </div>
      <button type="submit" id='confirmar' class="btn btn-success">Editar Dominio</button>
      {{ Form::close() }}

</div>

@stop

@section('footer')@stop