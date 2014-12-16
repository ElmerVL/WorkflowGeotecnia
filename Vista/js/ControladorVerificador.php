<?php

require '../Modelo/ModeloVerificador.php';
$login = $_GET['nombre_usuario'];
$str = strtolower($login); //TODO MINUSCULA
echo verificarLogin($str);