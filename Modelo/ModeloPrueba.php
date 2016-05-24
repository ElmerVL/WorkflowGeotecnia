<?php
require_once '../Modelo/ModeloEnLetras.php';
$total=1234; 
$V=new ModeloEnLetras(); 
$con_letra = strtoupper($V->ValorEnLetras($total,"")); 
echo "<b>".$con_letra."</b>";      