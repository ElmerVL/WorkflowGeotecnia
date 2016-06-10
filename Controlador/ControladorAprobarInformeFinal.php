<?php

require_once '../Modelo/ModeloProyecto.php';
$modelo_proyecto = new ModeloProyecto();
$id_proyecto = $_GET['i_p'];
$t_proy = $_GET['t_p'];

if($t_proy == 1){
    $cod_proyecto = $modelo_proyecto->mostrar_cod_proyecto_el($id_proyecto);
}elseif($t_proy == 2){
    $cod_proyecto = $modelo_proyecto->mostrar_cod_proyecto_tc($id_proyecto);
}

$modelo_proyecto->set_informe_aprobado($cod_proyecto);

header("Location: ../Vista/iuInformeFinal.php?i_p=$id_proyecto&t_p=$t_proy");
