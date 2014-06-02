<?php

/**
 * Description of CorreosController
 *
 * @author carlos
 */
class CalendarioRepositoryEloquent implements CalendarioRepository
{

      public function agregarCalendario($dominio, $inicio, $fin, $registrador)
      {
            try
            {
                  $calendario = new CalendarioDominio();
                  $calendario->dominio = $dominio;
                  $calendario->inicio = $inicio;
                  $calendario->fin = $fin;
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

                              $calendario->inicio = $inicio;
                        }
                        if (isset($fin))
                        {

                              $calendario->fin = $fin;
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

}
