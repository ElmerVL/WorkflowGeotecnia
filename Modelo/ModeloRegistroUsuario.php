<?php
require ('../Controlador/Conexion.php');

class ModeloRegistroUsuario {
    function verificar_usuario($usuario) {
        $con = new Conexion();
        $c = $con->getConection();
        $usuario = strtolower($usuario);
        $consulta_filas_usuario = pg_query($c, "select count(*) from usuario where login = '$usuario';");
        $f = pg_fetch_object($consulta_filas_usuario);
        $numero = $f->count;
        $res;
        if($numero == 1){
            $res = true;
        }else{
            $res = false;
        }
        return $res;
        pg_close($c);
    }
    
    function registrar_usuario($usuario, $contrasenia) {
        $con = new Conexion();
        $c = $con->getConection();
        $nombre_usuario = strtolower($usuario);
        pg_query($c, "INSERT INTO usuario(
                login, passwd, habilitada)
                VALUES ('$nombre_usuario', '$contrasenia', TRUE);");
        pg_close($c);
    }

    function registrar_user_rol($usuario, $nombres, $apellidos, $rol) {
        $con = new Conexion();
        $c = $con->getConection();
        $nom_usuario = strtolower($usuario);
        $nombres = strtolower($nombres);
        $apellidos = strtolower($apellidos);
        $consulta_idusuario = pg_query($c, "SELECT idusuario FROM Usuario WHERE login='$nom_usuario'");
        $f = pg_fetch_object($consulta_idusuario);
        $idusuario = $f->idusuario;
        $sql_rol = "INSERT INTO user_rol(
                            usuario_idusuario, rol_codrol)
                    VALUES ($idusuario, $rol);";
        pg_query($c, $sql_rol) or die("ERROR :(" . pg_last_error());

        if($rol == 2){
            $query_insertar = pg_query($c, "INSERT INTO director(
            usuario_idusuario, nombres, apellidos)
            VALUES ($idusuario, '$nombres', '$apellidos');");
        } elseif ($rol == 3) {
            $query_insertar = pg_query($c, "INSERT INTO contador(
            usuario_idusuario, nombres, apellidos)
            VALUES ($idusuario, '$nombres', '$apellidos');");
        } elseif ($rol == 4) {
            $query_insertar = pg_query($c, "INSERT INTO ingeniero(
            usuario_idusuario, nombres, apellidos)
            VALUES ($idusuario, '$nombres', '$apellidos');");
        } elseif ($rol == 5) {
            $query_insertar = pg_query($c, "INSERT INTO auxiliar(
            usuario_idusuario, nombres, apellidos)
            VALUES ($idusuario, '$nombres', '$apellidos');");
        }   
        pg_close($c);
        
    }
    
}
