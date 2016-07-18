<?php

require_once '../Modelo/ModeloProyecto.php';
$modelo_proyecto = new ModeloProyecto();
echo $id_proyecto = $_GET['i_p'];
$cod_solicitud = $modelo_proyecto->mostrar_cod_solicitud_tc($id_proyecto);
echo $nombreArchivo = $_FILES['archivo']['name'];
echo $nombreTemporalArchivo = $_FILES['archivo']['tmp_name'];
echo $tipoArchivo = $_FILES['archivo']['type'];
echo $trabajo = $_GET['t_r'];

if ($trabajo == 1) {
    $d = $destino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_campo/";
    if (file_exists($d)) {
        $destino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_campo/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    } else {
        mkdir("../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_campo/", 0777, true);
        $destino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_campo/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    }
}
if ($trabajo == 2) {
    $d = $destino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_gabinete/";
    if (file_exists($d)) {
        $destino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_gabinete/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    } else {
        mkdir("../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_gabinete/", 0777, true);
        $destino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_gabinete/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    }
}
if ($trabajo == 3) {
    $d = $destino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_laboratorio/";
    if (file_exists($d)) {
        $destino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_laboratorio/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    } else {
        mkdir("../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_laboratorio/", 0777, true);
        $destsino = "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_laboratorio/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    }
}
header("Location: ../Vista/iuRegistroResultados.php?i_p=$id_proyecto&t_p=2");