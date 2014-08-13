<?php
require_once '../Modelo/ModeloEnsayoLaboratorio.php';

$id_ensayo = $_GET['i_p'];
$tipo = $_POST['cbox_tipo'];
$ub_general = $_POST['ubicacion_general'];
$ub_especificacion = $_POST['ubicacion_especifica'];
$profundidad = $_POST['profundidad'];
$fecha_toma = $_POST['fecha_toma'];
$metodo_extraccion = $_POST['metodo_extraccion'];
$punto = $_POST['punto'];
$descripcion = $_POST['descripcion'];

$modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
$modelo_ensayo_laboratorio->registrar_muestra($id_ensayo, $ub_general, $ub_especificacion, $profundidad, $fecha_toma, $metodo_extraccion, $punto, $tipo, $descripcion);

header("Location: ../Vista/iuInformacionMuestras.php?i_p=$id_ensayo");