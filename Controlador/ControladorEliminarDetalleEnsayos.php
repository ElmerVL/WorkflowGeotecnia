<?php
require_once '../Modelo/ModeloEnsayoLaboratorio.php';
$modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
echo $id_proyecto = $_GET['i_p'];
echo $cod_ensayo = $_GET['c_e'];
$modelo_ensayo_laboratorio->eliminar_ensyao($id_proyecto, $cod_ensayo);
header("Location: ../Vista/iuConfirmacionEnsayos.php?i_p=$id_proyecto");