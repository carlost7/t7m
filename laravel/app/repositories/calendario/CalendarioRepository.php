<?php

/**
 * Interface para manejar los correos
 *
 * @author carlos
 */
interface CalendarioRepository {

      public function listarCalendarios();

      public function obtenerCalendario($id);

      public function agregarCalendario($dominio, $inicio, $fin, $registrador);

      public function editarCalendario($id, $dominio, $inicio, $fin, $registrador);

      public function eliminarCalendario($calendario_model);

}
