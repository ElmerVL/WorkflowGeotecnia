<?php
require_once '../Controlador/ControladorCuantias.php';
echo $id_ensayo = $_GET['i_p'];
echo $tipo_proyecto = $_GET['t'];
$controlador_cuantias = new ControladorCuantias();
$controlador_cuantias->generar_formulario($id_ensayo, $tipo_proyecto);
