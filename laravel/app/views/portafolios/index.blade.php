@extends('layouts.master')

@section('title')
Portafolios
@stop



@section('content')
<div class="jumbotron">
      <div class="container">
            <p>{{ HTML::linkRoute('portafolio.create','Agregar Proyecto',null,array('class'=>'btn btn-primary btn-lg')) }}</p>
      </div>
</div>
<div class="container">
      <div class="panel panel-default">

            <div class="table-responsive">
                  <table class="table">
                        <tr>
                              <th>Proyecto</th>
                              <th>url</th>
                              <th>Descripción</th>
                              <th>categoria</th>
                              <th>Editar</th>
                              <th>Eliminar</th>
                        </tr>
                        @foreach($portafolios as $portafolio)
                        <tr>
                              <td>{{ HTML::LinkRoute("portafolio.show",$portafolio->proyecto,$portafolio->id) }}</td>
                              <td>{{ $portafolio->url }}</td>
                              <td>{{ $portafolio->descripcion }}</td>
                              <td>{{ json_encode($portafolio->categoria) }}</td>
                              <td>{{ HTML::linkRoute('portafolio.edit','Editar',$portafolio->id) }}</td>
                              <td>
                                    {{ Form::open(array('route' => array('portafolio.destroy',$portafolio->id),'method'=>'DELETE')) }}
                                    {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                                    {{ Form::close() }}
                              </td>                        
                        </tr>
                        @endforeach
                  </table>
            </div>
      </div>
</div>


@stop
