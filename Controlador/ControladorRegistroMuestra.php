<?php
require_once '../Modelo/ModeloEnsayoLaboratorio.php';

echo "<br>".$id_ensayo = $_GET['i_p'];
echo "<br>".$tipo = $_POST['cbox_tipo'];
echo "<br>".$ub_general = $_POST['ubicacion_general'];
echo "<br>".$ub_especificacion = $_POST['ubicacion_especifica'];
echo "<br>".$profundidad = $_POST['profundidad'];
echo "<br>".$fecha_toma = $_POST['fecha_toma'];
echo "<br>".$metodo_extraccion = $_POST['metodo_extraccion'];
echo "<br>".$punto = $_POST['punto'];
echo "<br>".$descripcion = $_POST['descripcion'];

$modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
$modelo_ensayo_laboratorio->registrar_muestra($id_ensayo, $ub_general, $ub_especificacion, $profundidad, $fecha_toma, $metodo_extraccion, $punto, $tipo, $descripcion);

header("Location: ../Vista/iuInformacionMuestras.php?i_p=$id_ensayo");