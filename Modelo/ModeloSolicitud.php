<?php
require_once '../Controlador/Conexion.php';

class ModeloSolicitud {
    function registrar_solicitud($id_solicitud, $cliente, $fecha, $ubicacion, $tipo, $id_ingeniero, $id_usuario) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_id_director = pg_query($c, "select iddirector from director where usuario_idusuario = $id_usuario;");
        $id_conseguido = pg_fetch_object($consulta_id_director);
        $id_director = $id_conseguido->iddirector;

        $consulta_id_ingeniero = pg_query($c, "select usuario_idusuario from ingeniero where idingeniero = $id_ingeniero;");
        $id_ing_conseguido = pg_fetch_object($consulta_id_ingeniero);
        $id_usr_ingeniero = $id_ing_conseguido->usuario_idusuario;
        if ($id_solicitud == 0) {
            pg_query($c, "INSERT INTO solicitud(
            director_iddirector, director_usuario_idusuario, 
            ingeniero_idingeniero, ingeniero_usuario_idusuario, cliente, 
            fecha_solicitud, ubicacion, tipo)
            VALUES ($id_director, $id_usuario, 
            $id_ingeniero, $id_usr_ingeniero,
            '$cliente', '$fecha', '$ubicacion', '$tipo');");
        } else {
            pg_query($c, "UPDATE solicitud
            SET ingeniero_idingeniero=$id_ingeniero, ingeniero_usuario_idusuario=$id_usr_ingeniero, cliente='$cliente', 
            fecha_solicitud='$fecha', ubicacion='$ubicacion', tipo='$tipo'
            WHERE idsolicitud = $id_solicitud;");
        }
        pg_close($c);
    }

    function mostrar_lista_solicitudes() {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select idsolicitud, cliente, ubicacion, tipo, fecha_solicitud, nombres, apellidos
                              from solicitud, ingeniero
                              where ingeniero_idingeniero = idingeniero
                              order by idsolicitud;");

        $array_solicitudes = array();
        while ($f = pg_fetch_object($consulta)) {

            $id_solicitud = $f->idsolicitud;
            $cliente = $f->cliente;
            $ubicacion = $f->ubicacion;
            $tipo = $f->tipo;

            $array_solicitudes[] = "<a href='../Vista/iuInformacionSolicitud.php?i_s=$id_solicitud'>" . $id_solicitud;
            $array_solicitudes[] = $cliente;
            $array_solicitudes[] = $ubicacion;
            $array_solicitudes[] = $tipo;
        }
        return $array_solicitudes;
        pg_close($c);
    }

    function mostrar_datos_solicitud($id_solicitud) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select cliente, ubicacion, tipo, fecha_solicitud, ingeniero_idingeniero
                              from solicitud, ingeniero
                              where ingeniero_idingeniero = idingeniero and idsolicitud = $id_solicitud;");

        $array_datos = array();
        $f = pg_fetch_object($consulta);
        $cliente = $f->cliente;
        $ubicacion = $f->ubicacion;
        $tipo = $f->tipo;
        $fecha_u = $f->fecha_solicitud;
        $fecha = $fecha_u;
        $responsable = $f->ingeniero_idingeniero;
        $array_datos[] = $cliente;
        $array_datos[] = $ubicacion;
        $array_datos[] = $tipo;
        $array_datos[] = $responsable;
        $array_datos[] = $fecha;
        pg_close($c);
        return $array_datos;
    }
}
