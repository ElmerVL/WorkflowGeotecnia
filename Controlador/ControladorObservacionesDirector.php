<?php
require_once '../Modelo/ModeloAlcance.php';
echo $id_trabajo = $_GET['i_p'];
echo $observacion = $_POST['observaciones'];
$modelo_alcance = new ModeloAlcance();
$modelo_alcance->registrar_observaciones($id_trabajo, $observacion);
header("Location: ../Vista/iuInformacionAlcance.php?i_p=$id_trabajo&o=t");