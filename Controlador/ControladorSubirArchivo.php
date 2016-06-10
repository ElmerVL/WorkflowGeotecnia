<?php
if($_GET['i_f'] == 1) {
    require_once '../Modelo/ModeloProyecto.php';
    $modelo_proyecto = new ModeloProyecto();
    $id_proyecto = $_GET['i_p'];
    $t_proy = $_GET['t_p'];
    $cod_proyecto = 0;
    if($t_proy == 1){
        $cod_proyecto = $modelo_proyecto->mostrar_cod_proyecto_el($id_proyecto);
        $tipo_proyecto = 'EnsayoLaboratorio';
    }else if($t_proy == 2){
        $cod_proyecto = $modelo_proyecto->mostrar_cod_proyecto_tc($id_proyecto);
        $tipo_proyecto = 'TrabajoCampo';
    }

    $d = $destino = "../Archivos/$tipo_proyecto/$cod_proyecto/InformeFinal/";

    $nombreArchivo = $_FILES['archivo']['name'];
    $nombreTemporalArchivo = $_FILES['archivo']['tmp_name'];
    $tipoArchivo = $_FILES['archivo']['type'];
echo $nombreTemporalArchivo;
    if (file_exists($d)) {
        $destino = "../Archivos/$tipo_proyecto/$cod_proyecto/InformeFinal/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    } else {
        mkdir("../Archivos/$tipo_proyecto/$cod_proyecto/InformeFinal/", 0777, true);
        $destino = "../Archivos/$tipo_proyecto/$cod_proyecto/InformeFinal/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    }

    header("Location: ../Vista/iuRegistroInformeFinal.php?i_p=$id_proyecto&t_p=$t_proy");
} else {
    require_once '../Modelo/ModeloProyecto.php';
    $modelo_proyecto = new ModeloProyecto();
    $id_proyecto = $_GET['i_p'];
    $cod_proyecto = $modelo_proyecto->mostrar_cod_proyecto_el($id_proyecto);
    $id_ensayo = $_GET['e_l'];
    $nombreArchivo = $_FILES['archivo']['name'];
    $nombreTemporalArchivo = $_FILES['archivo']['tmp_name'];
    $tipoArchivo = $_FILES['archivo']['type'];

    $d = $destino = "../Archivos/EnsayoLaboratorio/$cod_proyecto/$id_ensayo/";

    if (file_exists($d)) {
        $destino = "../Archivos/EnsayoLaboratorio/$cod_proyecto/$id_ensayo/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    } else {
        mkdir("../Archivos/EnsayoLaboratorio/$cod_proyecto/$id_ensayo/", 0777, true);
        $destino = "../Archivos/EnsayoLaboratorio/$cod_proyecto/$id_ensayo/" . $nombreArchivo;
        copy($nombreTemporalArchivo, $destino);
        move_uploaded_file($nombreTemporalArchivo, $destino);
    }
    header("Location: ../Vista/iuRegistroResultados.php?i_p=$id_proyecto&t_p=1");
}