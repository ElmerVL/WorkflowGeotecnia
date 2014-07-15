<?php
require ('../Modelo/ModeloAccesoUsuarios.php');

$nombre_usuario = $_POST['name'];
$contrasena_usuario = $_POST['pass'];

echo $nombre_usuario;
echo $contrasena_usuario;
iniciarSesion($nombre_usuario,$contrasena_usuario);

?>
