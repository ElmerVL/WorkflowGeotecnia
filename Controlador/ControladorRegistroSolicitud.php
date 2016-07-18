<?php
require_once '../Modelo/ModeloSolicitud.php';
$cliente = $_POST['cliente'];
$fecha = date('Y-m-d');
$ubicacion = $_POST['ubicacion'];
$tipo = $_POST['cbox_tipo'];
$id_ingeniero = $_POST['cbox_ingenieros'];
$iu = $_GET['iu'];
$id_solicitud = $_GET['i_s'];

if ($id_ingeniero == 0) {
    header("Location: ../../Vista/iuRegistroSolicitud.php");
} else {
    $modelo_solicitud = new ModeloSolicitud();
    $modelo_solicitud->registrar_solicitud($id_solicitud, $cliente, $fecha, $ubicacion, $tipo, $id_ingeniero, $iu);
    header("Location: ../Vista/iuTablaSolicitudes.php");
}