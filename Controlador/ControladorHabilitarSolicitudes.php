<?php
require_once '../Modelo/ModeloSolicitud.php';

$id_solicitud = $_GET['i_s'];
echo $id_solicitud;

$modelo_solicitud = new ModeloSolicitud();
$modelo_solicitud->habilitar_solicitud($id_solicitud);

header('Location: ../Vista/iuTablaSolicitudes.php');