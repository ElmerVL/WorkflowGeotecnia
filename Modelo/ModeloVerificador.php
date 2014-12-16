<?php

require '../Controlador/Conexion.php';

function verificarLogin($login) {
    $conec = new Conexion();
    $con = $conec->getConection();
        $sql_grupos = "select * from grupo_empresa";
        $consulta = pg_query($con,$sql_grupos);
        $filas = pg_num_rows($consulta);
        if ($filas==0) {
            $sql = "select * from usuario where login = '$login'";
            $result = pg_query($con, $sql);
            $rows = pg_num_rows($result);
            if ($rows == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }  else {
            $sql = "select * from usuario as u, grupo_empresa as ge where u.idusuario = ge.usuario_idusuario and nombrelargoge='$login' or nombrecortoge='$login' or login='$login'";
            $result = pg_query($con, $sql);
            $rows = pg_num_rows($result);
            if ($rows == 0) {
                echo "true";
            } else {
                echo "false";
            }           
        }  
}

function verificarNombreLargoEmpresa($nombre_empresa) {
    $conec = new Conexion();
    $con = $conec->getConection();
    $sql_grupos = "select * from grupo_empresa";
        $consulta = pg_query($con,$sql_grupos);
        $filas = pg_num_rows($consulta);
        if ($filas==0) {
            $sql = "select * from usuario where login = '$nombre_empresa'";
            $result = pg_query($con, $sql);
            $rows = pg_num_rows($result);
            if ($rows == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }  else {
            $sql = "select * from usuario as u, grupo_empresa as ge where u.idusuario = ge.usuario_idusuario and nombrelargoge='$nombre_empresa' or nombrecortoge='$nombre_empresa' or login='$nombre_empresa'";
            $result = pg_query($con, $sql);
            $rows = pg_num_rows($result);
            if ($rows == 0) {
                echo "true";
            } else {
                echo "false";
            }           
        }  
}

function verificarNombreCortoEmpresa($nombre_empresa) {
    $conec = new Conexion();
    $con = $conec->getConection();
    $sql_grupos = "select * from grupo_empresa";
        $consulta = pg_query($con,$sql_grupos);
        $filas = pg_num_rows($consulta);
        if ($filas==0) {
            $sql = "select * from usuario where login = '$nombre_empresa'";
            $result = pg_query($con, $sql);
            $rows = pg_num_rows($result);
            if ($rows == 0) {
                echo "true";
            } else {
                echo "false";
            }
        }  else {
            $sql = "select * from usuario as u, grupo_empresa as ge where u.idusuario = ge.usuario_idusuario and nombrelargoge='$nombre_empresa' or nombrecortoge='$nombre_empresa' or login='$nombre_empresa'";
            $result = pg_query($con, $sql);
            $rows = pg_num_rows($result);
            if ($rows == 0) {
                echo "true";
            } else {
                echo "false";
            }           
        } 
}

function verificarTelefonoEmpresa($telefono) {
    $conec = new Conexion();
    $con = $conec->getConection();
    $sql = "SELECT * FROM grupo_empresa where telefonoge ='$telefono'";
    $result = pg_query($con, $sql);
    $rows = pg_num_rows($result);
    if ($rows == 0) {
        echo "true";
    } else {
        echo "false";
    }
}

function verificarCorreoEmpresa($correo) {
    $conec = new Conexion();
    $con = $conec->getConection();
    $sql = "SELECT * FROM grupo_empresa where correoge ='$correo'";
    $result = pg_query($con, $sql);
    $rows = pg_num_rows($result);
    if ($rows == 0) {
        echo "true";
    } else {
        echo "false";
    }
}

function verificarCorreoConsultor($correo) {
    $conec = new Conexion();
    $con = $conec->getConection();
    $sql = "SELECT * FROM consultor where correoconsultor ='$correo'";
    $result = pg_query($con, $sql);
    $rows = pg_num_rows($result);
    if ($rows == 0) {
        echo "true";
    } else {
        echo "false";
    }
}

function verificarTelefonoConsultor($telefono) {
    $conec = new Conexion();
    $con = $conec->getConection();
    $sql = "SELECT * FROM consultor where telefonoconsultor ='$telefono'";
    $result = pg_query($con, $sql);
    $rows = pg_num_rows($result);
    if ($rows == 0) {
        echo "true";
    } else {
        echo "false";
    }
}

?>
