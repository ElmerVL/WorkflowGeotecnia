<?php
require_once '../Modelo/ModeloReporte.php';

echo $tipo = $_POST['tipo_reporte'];
echo $anio = $_POST['cbox_anio_reporte'];
$modelo_reporte =  new ModeloReporte();
if($anio != 'todos') {
    if($tipo == 'solicitudes'){
        $modelo_reporte->imprimir_reporte_solicitudes($anio);
    }
    if($tipo == 'ensayos de laboratorio'){
        $modelo_reporte->imprimir_reporte_ensayos($anio);
    }
    if($tipo == 'muestras'){
        $modelo_reporte->imprimir_reporte_muestras($anio);
    }
    if($tipo == 'trabajos de campo'){
        $modelo_reporte->imprimir_reporte_trabajos($anio);
    }
} else {
    if($tipo == 'solicitudes'){
        $modelo_reporte->imprimir_todos_solicitudes();
    }
    if($tipo == 'ensayos de laboratorio'){
        $modelo_reporte->imprimir_todos_ensayos();
    }
    if($tipo == 'muestras'){
        $modelo_reporte->imprimir_todos_muestras();
    }
    if($tipo == 'trabajos de campo'){
        $modelo_reporte->imprimir_todos_trabajos();
    }
}



