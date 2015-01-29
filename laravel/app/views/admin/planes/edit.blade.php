@extends('layouts.master')

@section('title')
@parent

- Plan {{ $plan->nombre }} 
@stop



@section('content')

<div class="jumbotron">
      <div class="container">
            <h3>Agregar Plan</h3>
      </div>
</div>
<div class="container">

      {{ Form::model($plan, array('url'=> array('admin/planes/'.$plan->id),'method'=>'PUT')) }}

      @foreach($errors->all() as $message)
      <div class="alert alert-danger">{{ $message }}</div>
      @endforeach

      <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" value="{{ $plan->nombre }}" class="form-control" id="nombre" >
      </div>
      <div class="form-group">
            <label for="domain">Domain</label>
            <input type="text" name="domain" value="{{ $plan->domain }}" class="form-control" id="Dominio" >
      </div>
      <div class="form-group">
            <label for="name_server">Name server</label>
            <input type="text" name="name_server" value="{{ $plan->name_server }}" class="form-control" id="Name_Server" >
      </div>
      <div class="form-group">
            <label for="numero_correos">Numero correos</label>
            <input type="text" name="numero_correos" value="{{ $plan->numero_correos }}" class="form-control" id="Numero_correos">
      </div>
      <div class="form-group">
            <label for="quota_correos">Quota correos</label>
            <input type="text" name="quota_correos" value="{{ $plan->quota_correos }}" class="form-control" id="Quota_correos">
      </div>
      <div class="form-group">
            <label for="numero_ftps">Numero ftps</label>
            <input type="text" name="numero_ftps" value="{{ $plan->numero_ftps }}" class="form-control" id="Numero_ftps">
      </div>
      <div class="form-group">
            <label for="quota_ftps">Quota ftps</label>
            <input type="text" name="quota_ftps" value="{{ $plan->quota_ftps }}" class="form-control" id="Quota_ftps">
      </div>
      <div class="form-group">
            <label for="numero_dbs">Numero dbs</label>
            <input type="text" name="numero_dbs" value="{{ $plan->numero_dbs }}" class="form-control" id="Numero_dbs">
      </div>
      <div class="form-group">
            <label for="quota_dbs">Quota dbs</label>
            <input type="text" name="quota_dbs" value="{{ $plan->quota_dbs }}" class="form-control" id="Quota_dbs">
      </div> 
      <div class="form-group">
            <label for="password">Contraseña</label>            
            <div class="input-group">
                  <input type="password" name="password" class="form-control" id="Password" placeholder="Contraseña">
                  <span class="input-group-btn">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalPassword" onclick="get_password()">
                              Generar Contraseña
                        </button>
                  </span>                  
            </div>
      </div>
      <button type="submit" id='confirmar' class="btn btn-success">Editar Plan</button>
      {{ Form::close() }}
</div>

@stop


