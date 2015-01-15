<?php

class PortafoliosController extends \BaseController {

      /**
       * Display a listing of portafolios
       *
       * @return Response
       */
      public function index()
      {
            $portafolios = Portafolio::orderBy('proyecto')->get();

            return View::make('portafolios.index', compact('portafolios'));
      }

      /**
       * Show the form for creating a new portafolio
       *
       * @return Response
       */
      public function create()
      {
            return View::make('portafolios.create');
      }

      /**
       * Store a newly created portafolio in storage.
       *
       * @return Response
       */
      public function store()
      {
            $thumb = Input::file('thumb');
            $full  = Input::file('imagen');

            $validator = Validator::make($data      = Input::all(), Portafolio::$rules);

            if ($validator->passes())
            {
                  $portafolio = new Portafolio;
                  $portafolio->imagen = Str::slug($portafolio->proyecto);
                  if ($portafolio->save())
                  {
                        if (isset($thumb))
                        {
                              $thumb_name = Str::slug($portafolio->proyecto) . "_thumb." . $thumb->getClientOriginalExtension();
                              $thumb->move("img/thumb", $thumb_name);
                        }
                        if (isset($full))
                        {
                              $full_name = Str::slug($portafolio->proyecto) . "_" . $portafolio->id . "." . $thumb->getClientOriginalExtension();
                              $full->move("img/fulls", $full_name);
                        }

                        if (isset($thumb_name) && isset($full_name))
                        {
                              $portafolio->thumb_name = $thumb_name;
                              $portafolio->full_name  = $full_name;
                              $portafolio->update();
                        }

                        //redirigimos con un mensaje flash
                        return Redirect::route('portafolio.index');
                  }
            }


            return Redirect::back()->withErrors($validator)->withInput();
      }

      /**
       * Display the specified portafolio.
       *
       * @param  int  $id
       * @return Response
       */
      public function show($id)
      {
            $portafolio = Portafolio::findOrFail($id);

            return View::make('portafolios.show', compact('portafolio'));
      }

      /**
       * Show the form for editing the specified portafolio.
       *
       * @param  int  $id
       * @return Response
       */
      public function edit($id)
      {
            $portafolio = Portafolio::find($id);

            return View::make('portafolios.edit', compact('portafolio'));
      }

      /**
       * Update the specified portafolio in storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function update($id)
      {
            $portafolio = Portafolio::find($id);
            $thumb = Input::file('thumb');
            $full  = Input::file('imagen');

            $validator = Validator::make($data      = Input::all(), Portafolio::$rules);

            if ($validator->passes())
            {
                  if ($portafolio->update())
                  {
                        if (isset($thumb))
                        {
                              if(isset($portafolio->thumb_name)){
                                    $thumb_name = $portafolio->thumb_name;
                              }else{
                                    $thumb_name = Str::slug($portafolio->proyecto) . "_thumb." . $thumb->getClientOriginalExtension();
                              }
                              
                              $thumb->move("img/thumb", $thumb_name);
                        }
                        if (isset($full))
                        {
                              if(isset($portafolio->full_name)){
                                    $full_name = $portafolio->full_name;
                              }else{
                                    $full_name = Str::slug($portafolio->proyecto) . "_" . $portafolio->id . "." . $thumb->getClientOriginalExtension();
                              }                              
                              $full->move("img/fulls", $full_name);
                        }

                        if (isset($thumb_name) && isset($full_name))
                        {
                              $portafolio->thumb_name = $thumb_name;
                              $portafolio->full_name  = $full_name;
                              $portafolio->update();
                        }

                        //redirigimos con un mensaje flash
                        return Redirect::route('portafolio.index');
                  }
            }


            return Redirect::back()->withErrors($validator)->withInput();
      }

      /**
       * Remove the specified portafolio from storage.
       *
       * @param  int  $id
       * @return Response
       */
      public function destroy($id)
      {
            Portafolio::destroy($id);

            return Redirect::route('portafolio.index');
      }

}
