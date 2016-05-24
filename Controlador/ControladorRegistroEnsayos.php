<?php 
require_once '../Modelo/ModeloEnsayoLaboratorio.php';
$modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
echo $id_proyecto = $_GET['i_p'];

$array_ensayos = array();
if(!(empty($_POST['ensayos']))){
    foreach($_POST['ensayos'] as $ensayo){
        $array_ensayos[]=$ensayo;
    }
}

for ($i = 0; $i < count($array_ensayos); $i++) {
    echo $id_ensayo = $array_ensayos[$i];
    echo $cant_ensayo = $_POST["txt_cant_$id_ensayo"];
    $modelo_ensayo_laboratorio->insertar_detalle_ensayo($id_proyecto, $id_ensayo, $cant_ensayo);
}

header("Location: ../Vista/iuConfirmacionEnsayos.php?i_p=$id_proyecto");