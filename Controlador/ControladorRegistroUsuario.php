<?php
require ('../Modelo/ModeloRegistroUsuario.php');

  echo $usuario = $_POST['nombre_usuario'];
  $rol = $_POST['cbox_rol'];
  $contrasenia = $_POST['contrasenia'];
  $nombres = $_POST['nombres'];
  $apellidos = $_POST['apellidos'];
  
  $modelo_registro = new ModeloRegistroUsuario();
  
  if($modelo_registro->verificar_usuario($usuario)){
      header("Location: ../Vista/iuRegistroUsuarios.php?m=1");
  }else{
      $modelo_registro->registrar_usuario($usuario, $contrasenia);
      $modelo_registro->registrar_user_rol($usuario, $nombres, $apellidos, $rol);
      header("Location: ../Vista/iuRegistroUsuarios.php?m=0");
  }
  
