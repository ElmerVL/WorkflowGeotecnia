<?php
require_once '../Modelo/ModeloCuantias.php';
class ControladorCuantias {
    function generar_formulario($id_ensayo, $tipo_proyecto) {
        $modelo_cuantias = new ModeloCuantias();
        $modelo_cuantias->imprimir_formulario($id_ensayo, $tipo_proyecto);
    }

}

