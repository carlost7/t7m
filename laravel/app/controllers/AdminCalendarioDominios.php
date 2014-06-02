<?php

use CalendarioRepository as Calendario;

class AdminCalendarioDominios extends \BaseController
{

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
            return View::make('calendario.index')->with('calendarios',$calendarios);
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return Response
       */
      public function create()
      {
            return View::make('calendario.create');
      }

      /**
       * Store a newly created resource in storage.
       *
       * @return Response
       */
      public function store()
      {
            
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
            return View::make('calendario.show')->with('calendario',$calendario);
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
            return View::make('calendario.edit')->with('calendario',$calendario);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            //
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
            if($calendario!=null){
                  if($this->Calendario->eliminarCalendario($calendario)){
                        Session::flash('message','Calendario eliminado con exito');
                        return Redirect::Route('admin.calendarios');
                  }else{
                        Session::flash('message','Calendario eliminado con exito');
                        return Redirect::back();
                  }
            }
      }

}
