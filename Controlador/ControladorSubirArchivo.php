<?php


require_once '../Modelo/ModeloProyecto.php';
$modelo_proyecto = new ModeloProyecto();
echo $id_proyecto = $_GET['i_p'];
$cod_solicitud = $modelo_proyecto->mostrar_cod_solicitud_el($id_proyecto);
echo $id_ensayo = $_GET['e_l'];
echo $nombreArchivo = $_FILES['archivo']['name'];
echo $nombreTemporalArchivo = $_FILES['archivo']['tmp_name'];
echo $tipoArchivo = $_FILES['archivo']['type'];

$d = $destino = "../Archivos/EnsayoLaboratorio/$cod_solicitud/$id_ensayo/";

if (file_exists($d)) {
    $destino = "../Archivos/EnsayoLaboratorio/$cod_solicitud/$id_ensayo/" . $nombreArchivo;
    copy($nombreTemporalArchivo, $destino);
    move_uploaded_file($nombreTemporalArchivo, $destino);
} else {
    mkdir("../Archivos/EnsayoLaboratorio/$cod_solicitud/$id_ensayo/", 0777, true);
    $destino = "../Archivos/EnsayoLaboratorio/$cod_solicitud/$id_ensayo/" . $nombreArchivo;
    copy($nombreTemporalArchivo, $destino);
    move_uploaded_file($nombreTemporalArchivo, $destino);
}