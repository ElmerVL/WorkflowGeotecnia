<?php
require_once '../Modelo/ModeloAlcance.php';

$id_trabajo = $_GET['i_p'];
echo $posicion = $_GET['i'];
$valor = $_POST['valor_actualizado'];

$modelo_alcance = new ModeloAlcance();
$modelo_alcance->actualizar_valor_alcance($id_trabajo, $posicion, $valor);
header("Location: ../Vista/iuInformacionAlcance.php?i_p=$id_trabajo");
