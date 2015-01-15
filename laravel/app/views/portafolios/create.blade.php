@extends('layouts.master')

@section('title')
@parent

- Agregar Proyectos
@stop



@section('content')
<div class="jumbotron">
      <div class="container">
            <h2>{{ HTML::linkRoute('portafolio.index','Regresar') }}</h2>
      </div>
</div>
<div class="container">
      <h2>Recuerda que se agrega un proyecto por cada Imagen Full que tengas</h2>
      @include('layouts.show_form_errors')
      {{ Form::open(array('route'=>array('portafolio.store'),'files'=>true))}}
      <div class="form-group">
            <div class="row">
                  <div class="col-sm-12">
                        <div class="form-group">
                              {{ Form::label('proyecto', 'Proyecto') }}
                              {{ Form::text('proyecto', Input::old('proyecto'), array('placeholder' => 'Nombre de proyecto', 'class'=>'form-control')) }}
                        </div>
                        <div class="form-group">
                              {{ Form::label('descripcion', 'Descripción') }}
                              {{ Form::textarea('descripcion', Input::old('descripcion'), array('placeholder' => 'Descripcion', 'class'=>'form-control')) }}
                        </div>
                        <div class="form-group">
                              {{ Form::label('url', 'URL') }}
                              {{ Form::text('url', Input::old('url'), array('placeholder' => 'http://ejemplo.com', 'class'=>'form-control')) }}
                        </div>
                        <div class="form-group">
                              {{ Form::label('prioridad', 'Prioridad') }}
                              {{ Form::text('prioridad', Input::old('prioridad'), array('placeholder' => 'prioridad', 'class'=>'form-control')) }}
                        </div>
                        <div class="form-group">
                              {{ Form::label('thumb','Agregar Thumb') }}
                              {{ Form::file('thumb') }}
                        </div>
                        <div class="form-group">
                              {{ Form::label('imagen','Agregar imagen') }}
                              {{ Form::file('imagen') }}
                        </div>
                        <div class="form-group">
                              {{ Form::label('thumb','Categorias') }}
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'logo')}}Logo
                              </label>
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'marca')}}Marca
                              </label>
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'web')}}Web
                              </label>
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'editorial')}}Editorial
                              </label>
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'promo')}}Promo
                              </label>
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'impresiones')}}Impresiones
                              </label>
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'digita')}}Digital
                              </label>
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'etiqueta')}}Etiqueta
                              </label>
                              <label class="checkbox-inline">
                                    {{ Form::checkbox('categoria[]', 'foto')}}Foto
                              </label>
                        </div>
                  </div>
            </div>
            {{ Form::submit('Agregar Proyecto',array("class"=>"btn btn-primary")) }}

      </div>
      {{ Form::close() }}

</div>

@stop



@section('footer')@stop