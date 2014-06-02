<?php

/**
 * Description of CorreosController
 *
 * @author carlos
 */
class CalendarioRepositoryEloquent implements CalendarioRepository {

      public function agregarCalendario($dominio, $inicio, $fin, $registrador)
      {
            try
            {
                  $calendario = new CalendarioDominio();
                  $calendario->dominio = $dominio;
                  $calendario->inicio = new DateTime($inicio);
                  $calendario->fin = new DateTime($fin);
                  $calendario->registrador = $registrador;

                  if ($calendario->save())
                  {
                        return $calendario;
                  }
                  else
                  {
                        return null;
                  }
            }
            catch (Exception $e)
            {
                  Log::error('AgregarCalendario. ' . print_r($e, true));
                  Session::put('error', print_r($e));
                  return null;
            }
      }

      public function editarCalendario($id, $dominio, $inicio, $fin, $registrador)
      {
            try
            {

                  $calendario = $this->obtenerCalendario($id);
                  if ($calendario != null)
                  {
                        if (isset($dominio))
                        {

                              $calendario->dominio = $dominio;
                        }
                        if (isset($inicio))
                        {

                              $calendario->inicio = new DateTime($inicio);
                        }
                        if (isset($fin))
                        {

                              $calendario->fin = new DateTime($fin);
                        }
                        if (isset($registrador))
                        {

                              $calendario->registrador = $registrador;
                        }
                        if ($calendario->save())
                        {
                              return $calendario;
                        }
                        else
                        {
                              return null;
                        }
                  }
                  else
                  {
                        return null;
                  }
            }
            catch (Exception $e)
            {
                  Log::error('EditarCalendario. ' . print_r($e, true));
            }
      }

      public function eliminarCalendario($calendario_model)
      {
            try
            {
                  $calendario_model->delete();
            }
            catch (Exception $e)
            {
                  Log::error('EliminarCalendario. ' . print_r($e, true));
            }
      }

      public function listarCalendarios()
      {
            return CalendarioDominio::all();
      }

      public function obtenerCalendario($id)
      {
            return CalendarioDominio::find($id);
      }

      public function obtenerDominiosPorVencer()
      {
            //Obtenemos los registros que esten entre hoy y 5 dias en el futuro
            $now = Carbon\Carbon::now();
            $daysLater = Carbon\Carbon::now()->addDays(5);            
            return CalendarioDominio::whereBetween('fin',array($now,$daysLater))->get();            
      }

}
