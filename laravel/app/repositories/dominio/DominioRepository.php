<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DominioRepository
 *
 * @author carlos
 */
interface DominioRepository {

      public function comprobarDominio($dominio);

      public function agregarDominio($nombre_dominio, $password, $usuario_id, $plan_id,$agregar_servidor);

      public function eliminarDominio($dominio_model);

      public function apartarDominio($user_model, $dominio, $is_propio, $plan_model);

      public function obtenerDominioPendiente($user_model);
}
