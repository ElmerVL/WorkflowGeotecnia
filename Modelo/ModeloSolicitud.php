<?php

require_once '../Controlador/Conexion.php';

class ModeloSolicitud {

    function registrar_solicitud($cliente, $fecha, $id_usuario) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_id_director = pg_query($c, "select iddirector from director where usuario_idusuario = $id_usuario;");
        $id_conseguido = pg_fetch_object($consulta_id_director);
        $id_director = $id_conseguido->iddirector;

        pg_query($c, "INSERT INTO solicitud(
                            director_iddirector, director_usuario_idusuario, 
                            cliente, fecha_solicitud)
                       VALUES ($id_director, $id_usuario, 
                               '$cliente', '$fecha');");
        echo "inscrito";
        pg_close($c);
    }

}
