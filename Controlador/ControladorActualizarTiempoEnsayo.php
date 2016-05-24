<?php
require_once '../Modelo/ModeloEnsayoLaboratorio.php';
$modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
$direccion = $_GET['d'];
$id_proyecto = $_GET['i_p'];
$cod_ensayo = $_GET['c_e'];
$modelo_ensayo_laboratorio->actualizar_tiempo($id_proyecto, $cod_ensayo, $direccion);
header("Location: ../Vista/iuConfirmacionEnsayos.php?i_p=$id_proyecto");