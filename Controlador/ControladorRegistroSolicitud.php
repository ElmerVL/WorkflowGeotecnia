<?php
require_once '../Modelo/ModeloSolicitud.php';

$cliente = $_POST['cliente'];
echo $cliente."<br />";
$fecha = $_POST['fecha'];
echo $fecha."<br />";
$ubicacion = $_POST['ubicacion'];
echo $ubicacion."<br />";
$tipo = $_POST['cbox_tipo'];
echo $tipo."<br />";
$id_ingeniero = $_POST['cbox_ingenieros'];
echo $id_ingeniero."<br />";
$iu = $_GET['iu'];
echo $iu."<br />";
$modelo_solicitud = new ModeloSolicitud();
$modelo_solicitud->registrar_solicitud($cliente, $fecha, $ubicacion, $tipo, $id_ingeniero, $iu);
header("Location: ../Vista/iuTablaSolicitudes.php");