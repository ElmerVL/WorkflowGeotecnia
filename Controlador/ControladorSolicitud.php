<?php
require_once '../Modelo/ModeloSolicitud.php';
class ControladorSolicitud {
    function mostrarTabla(){
        $modelo_solicitud = new ModeloSolicitud();
        $lista = $modelo_solicitud->mostrar_lista_solicitudes();
        return $lista;
    }
}
