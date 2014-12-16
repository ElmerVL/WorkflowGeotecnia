<?php
require_once '../Modelo/ModeloIngeniero.php';
class ControladorIngeniero {
    function lista_ingenieros($cargo) {
        $modelo_ingeniero = new ModeloIngeniero();
        $arreglo_ingenieros = $modelo_ingeniero->mostrar_lista_ingenieros($cargo);
        return $arreglo_ingenieros;
    }
    function lista_ingeniero_seleccionado() {
        $modelo_ingeniero = new ModeloIngeniero();
        $arreglo_ingenieros = $modelo_ingeniero->mostrar_lista_ingeniero_seleccionado();
        return $arreglo_ingenieros;
    }
}
