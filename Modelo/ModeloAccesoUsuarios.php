<?php

require('../Controlador/Conexion.php');

function iniciarSesion($nombre_usuario, $contrasena_usuario) {
    $conec = new Conexion();
    $con = $conec->getConection();

    $ingreso_nombre_usuario = strtolower($nombre_usuario);
    $ingreso_contrasena_usuario = $contrasena_usuario;

    if (!isset($_SESSION)) {
        session_start();
    }

    $consulta_usuario = "SELECT * FROM usuario WHERE login='$ingreso_nombre_usuario' AND passwd='$ingreso_contrasena_usuario' AND habilitada = TRUE";
    $consulta = pg_query($con, $consulta_usuario);
    $filas = pg_fetch_array($consulta);
    if (!$filas[0]) {
        header("Location: ../index.php");
    } else { //opcion2: Usuario logueado correctamente
        //Definimos las variables de sesión y redirigimos a la página de usuario
        $idusuario = $filas['idusuario'];
        $_SESSION['id_usuario'] = $filas['idusuario'];
        $_SESSION['nombre'] = $filas['login'];

        $consulta_rol = "SELECT rol_codrol FROM user_rol WHERE usuario_idusuario ='$idusuario'";
        $roles = pg_query($con, $consulta_rol);
        $fila = pg_fetch_array($roles);
        $rol_usuario = $fila['rol_codrol'];
        $_SESSION['rol'] = $fila['rol_codrol'];
        
        switch ($rol_usuario){
            case 1: //administrador 
                header("Location: ../Vista/iuAdministrador.php");
                break;
            case 2: // director
                header("Location: ../Vista/iuDirector.php");
                break;
            case 3://contador
                header("Location: ../Vista/iuContador.php");
                break;
            case 4 ://ingeniero 
                header("Location: ../Vista/iuIngeniero.php");
                break;
            case 5://auxiliar 
                header("Location: ../Vista/iuAuxiliar.php");
                break;
            case 6://auxiliar 
                header("Location: ../Vista/iuTecnico.php");
                break;
        }
        
    }
}

?>
