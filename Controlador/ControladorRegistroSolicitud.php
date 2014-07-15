<?php
require_once '../Modelo/ModeloSolicitud.php';

$cliente = $_POST['cliente'];
echo $cliente."<br />";
$fecha = $_POST['fecha'];
echo $fecha."<br />";
$iu = $_GET['iu'];
echo $iu."<br />";

$modelo_solicitud = new ModeloSolicitud();
$modelo_solicitud->registrar_solicitud($cliente, $fecha, $iu);