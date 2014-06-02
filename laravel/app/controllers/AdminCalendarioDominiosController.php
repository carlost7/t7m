<?php

use CalendarioRepository as Calendario;

class AdminCalendarioDominiosController extends \BaseController {

      protected $Calendario;

      public function __construct(Calendario $calendario)
      {
            $this->Calendario = $calendario;
      }

      /**
       * Display a listing of the resource.
       *
       * @return Response
       */
      public function index()
      {
            $calendarios = $this->Calendario->listarCalendarios();
            return View::make('admin.calendario.index')->with('calendarios', $calendarios);
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return Response
       */
      public function create()
      {
            return View::make('admin.calendario.create');
      }

      /**
       * Store a newly created resource in storage.
       *
       * @return Response
       */
      public function store()
      {
            $validator = $this->getCalendarioValidator();
            if ($validator->passes())
            {
                  $dominio = Input::get('dominio');
                  $inicio = Input::get('inicio');
                  $fin = Input::get('fin');
                  $registrador = Input::get('registrador');
                  if ($this->Calendario->agregarCalendario($dominio, $inicio, $fin, $registrador))
                  {
                        Session::flash('message', 'Calendario de dominio agregado con exito');
                        return Redirect::to('admin/calendarios');
                  }
                  else
                  {
                        Session::flash('error', 'Error al crear el calendario');
                  }
            }
            return Redirect::back()->withErrors($validator)->withInput();
      }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $calendario = $this->Calendario->obtenerCalendario($id);
            return View::make('admin.calendario.show')->with('calendario', $calendario);
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $calendario = $this->Calendario->obtenerCalendario($id);
            return View::make('admin.calendario.edit')->with('calendario', $calendario);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $calendario = $this->Calendario->obtenerCalendario($id);
            if ($calendario != null && $calendario->id)
            {
                  $validator = $this->getCalendarioValidator();
                  if ($validator->passes())
                  {
                        $dominio = Input::get('dominio');
                        $inicio = Input::get('inicio');
                        $fin = Input::get('fin');
                        $registrador = Input::get('registrador');
                        if ($this->Calendario->editarCalendario($id, $dominio, $inicio, $fin, $registrador))
                        {
                              Session::flash('message', 'Calendario de dominio editado');
                              return Redirect::to('admin/calendarios');
                        }
                        else
                        {
                              Session::flash('error', 'Error al editar el calendario');
                        }
                  }
            }
            else
            {
                  Session::flash('error','No existe el calendario');
            }
            return Redirect::back()->withErrors($validator)->withInput();
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            $calendario = $this->Calendario->obtenerCalendario($id);
            if ($calendario != null)
            {
                  if ($this->Calendario->eliminarCalendario($calendario))
                  {
                        Session::flash('message', 'Calendario eliminado con exito');
                        return Redirect::Route('admin.calendarios');
                  }
                  else
                  {
                        Session::flash('message', 'Calendario eliminado con exito');
                        return Redirect::back();
                  }
            }
      }

      protected function getCalendarioValidator()
      {
            return Validator::make(Input::all(), array(
                        'dominio' => 'required',
                        'inicio' => 'required|date',
                        'fin' => 'required|date',
                        'registrador' => 'required',
            ));
      }

}
