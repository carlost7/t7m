<?php

/**
 * Interface para manejar los correos
 *
 * @author carlos
 */
interface PagosRepository {

      public function obtenerPagosUsuario($id);

      public function generarPreferenciaPago($preference_data);

      public function generarLinkPago($preference);

      public function generarLinkPagoRecurrente($preapproval_data);

      public function generarPagoBase($tipo_pago, $usuario_model, $monto, $descripcion, $inicio, $vencimiento, $activo, $no_orden, $status);

      public function actualizarRegistroPagoExterno($numero_orden, $status);

      public function recibirNotificacionPago($id);
}
