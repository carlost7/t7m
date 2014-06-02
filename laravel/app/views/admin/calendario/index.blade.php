@extends('layouts.master')

@section('title')
@parent

- Calendario Dominios
@stop



@section('content')
<div class="jumbotron">
      <div class="container">
            <h2>Calendario de Dominios</h2>
            <br />
            <p>{{ HTML::linkRoute('admin.calendarios.create','Agregar Dominio ',null,array('class'=>'btn btn-primary btn-lg')) }}</p>            
      </div>
</div>
<div class="container">
      <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Lista de Dominios</div>

            <div class="table-responsive">
                  <table class="table">
                        <tr>
                              <th>Dominio</th>
                              <th>Inicio</th>                    
                              <th>Fin</th>
                              <th>Registrador</th>
                              <th>Editar</th>
                              <th>Eliminar</th>
                        </tr>
                        @foreach($calendarios as $calendario)
                        <tr>

                              <td>{{ $calendario->dominio }}</td>
                              <td>{{ $calendario->inicio }}</td>
                              <td>{{ $calendario->fin }}</td>
                              <td>{{ $calendario->registrador }}</td>
                              <td>{{ HTML::link('admin/calendarios/'.$calendario->id.'/edit','Editar',array('class'=>'btn btn-primary btn-xs')) }}</td>
                              <td>
                                    {{ Form::open(array('route' => array('admin.calendarios.destroy',$calendario->id),'method'=>'DELETE')) }}
                                    {{ Form::submit('Eliminar', array('class' => 'btn btn-danger btn-xs')) }}
                                    {{ Form::close() }}
                              </td>                        
                        </tr>
                        @endforeach
                  </table>
            </div>
      </div>
</div>



@stop
