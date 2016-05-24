<?php
require_once '../Modelo/ModeloSolicitud.php';
class ControladorSolicitud {
    function mostrarTabla(){
        $modelo_solicitud = new ModeloSolicitud();
        $lista = $modelo_solicitud->mostrar_lista_solicitudes();
        return $lista;
    }
    
    function mostrar_datos($id_solicitud){
        $modelo_solicitud = new ModeloSolicitud();
        $arreglo_datos = $modelo_solicitud->mostrar_datos_solicitud($id_solicitud);
        return $arreglo_datos;
    }
    
    function mostrar_cod_proyecto($id_solicitud){
        $modelo_solicitud = new ModeloSolicitud();
        $cod_proyecto = $modelo_solicitud->mostrar_cod_proyecto($id_solicitud);
        return $cod_proyecto;
    }
}
