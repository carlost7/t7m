@extends('layouts.master')

@section('title')
@parent

- Agregar Calendario Dominio
@stop



@section('content')
<div class="jumbotron">
      <div class="container">
            <h2>{{ HTML::linkRoute('admin.calendarios.index','Calendario') }} > Agregar Calendario</h2>            
      </div>
</div>
<div class="container">

      @foreach($errors->all() as $error)
      <div class="alert alert-danger">{{ $error }}</div>
      @endforeach

      <br />
      {{ Form::open(array('url'=>'admin/calendarios','id'=>'form_confirm')) }}

      <div class="form-group">
            <label for="dominio">Dominio</label>
            <input type="text" name="dominio" value="{{ Input::old('dominio')}}" class="form-control" id="Dominio" placeholder="Nombre del dominio">
      </div>
      <div class="form-group">
            <label for="inicio">Fecha Inicio</label>
            <input type="text" name="inicio" value="{{ Input::old('inicio')}}" class="form-control" id="Inicio" placeholder="Fecha de inicio">
      </div>
      <div class="form-group">
            <label for="fin">Fecha Fin</label>
            <input type="text" name="fin" value="{{ Input::old('fin')}}" class="form-control" id="Fin" placeholder="Fecha de Finalización">
      </div>
      <div class="form-group">
            <label for="registrador">Registrador</label>
            <input type="text" name="registrador" value="{{ Input::old('registrador')}}" class="form-control" id="Registrador" placeholder="En donde se registro el dominio">
      </div>
      <button type="submit" id='confirmar' class="btn btn-success">Agregar Dominio</button>
      {{ Form::close() }}

</div>

@stop

@section('scripts')
<script>
      $('#Inicio').datepicker({
            format: 'dd-mm-yyyy'
      });
      
      $('#Fin').datepicker({
            format: 'dd-mm-yyyy'
      });
</script>
@stop

@section('footer')@stop

