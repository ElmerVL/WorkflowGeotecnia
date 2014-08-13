<?php
require_once '../Modelo/ModeloMuestra.php';

class ControladorMuestra {
    function mostrar_datos_muestra($id_proyecto) {
        $modelo_muestra = new ModeloMuestra();
        $arreglo_datos = $modelo_muestra->mostrar_datos_muestras($id_proyecto);
        return $arreglo_datos;
    }
    
}