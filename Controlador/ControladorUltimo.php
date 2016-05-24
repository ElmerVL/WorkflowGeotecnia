<?php
require_once '../Modelo/ModeloUltimo.php';
class ControladorUltimo {
    function mostrar_10_filas() {
        $modelo_ultimo = new ModeloUltimo();
        return $modelo_ultimo->recuperar_10_filas_bitacora();
    }
}
