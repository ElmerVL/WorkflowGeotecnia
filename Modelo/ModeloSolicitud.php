<?php
require_once '../Controlador/Conexion.php';
require_once '../Modelo/ModeloPago.php';
class ModeloSolicitud {
    function registrar_solicitud($id_solicitud, $cliente, $fecha, $ubicacion, $tipo, $id_ingeniero, $id_usuario) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_id_director = pg_query($c, "select iddirector, usuario_idusuario from director where en_curso = 'true'");
        $id_dir_conseguido = pg_fetch_object($consulta_id_director);
        $id_director = $id_dir_conseguido->iddirector;
        $id_usuario_director = $id_dir_conseguido->usuario_idusuario;
        
        $consulta_id_contador = pg_query($c, "select idcontador from contador where usuario_idusuario = $id_usuario;");
        $id_conseguido = pg_fetch_object($consulta_id_contador);
        $id_contador = $id_conseguido->idcontador;

        $consulta_id_ingeniero = pg_query($c, "select usuario_idusuario from ingeniero where idingeniero = $id_ingeniero;");
        $id_ing_conseguido = pg_fetch_object($consulta_id_ingeniero);
        $id_usr_ingeniero = $id_ing_conseguido->usuario_idusuario;
        
        $modelo_solicitud = new ModeloSolicitud();
        $cod_solicitud = $modelo_solicitud->generar_codigo_solicitud();
        echo $cod_solicitud;
        
        if ($id_solicitud == 0) {
            pg_query($c, "INSERT INTO solicitud(
            director_iddirector, director_usuario_idusuario, 
            ingeniero_idingeniero, ingeniero_usuario_idusuario, cliente, 
            fecha_solicitud, ubicacion, tipo, cod_solicitud, habilitado, contador_idcontador, cod_proyecto)
            VALUES ($id_director, $id_usuario_director, 
            $id_ingeniero, $id_usr_ingeniero,
            '$cliente', '$fecha', '$ubicacion', '$tipo', '$cod_solicitud', 'false', $id_contador, 'N - P');");
            
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

        $consulta = pg_query($c, "select idsolicitud, cliente, ubicacion, tipo, fecha_solicitud, nombres, apellidos, cod_solicitud, habilitado
                              from solicitud, ingeniero
                              where ingeniero_idingeniero = idingeniero
                              order by idsolicitud DESC;");

        $array_solicitudes = array();
        while ($f = pg_fetch_object($consulta)) {

            $id_solicitud = $f->idsolicitud;
            $cod_solicitud = $f->cod_solicitud;
            $cliente = $f->cliente;
            $ubicacion = $f->ubicacion;
            $tipo = $f->tipo;
            $habilitado = $f->habilitado;

            $array_solicitudes[] = $id_solicitud;
            $array_solicitudes[] = $cod_solicitud;
            $array_solicitudes[] = $cliente;
            $array_solicitudes[] = $ubicacion;
            $array_solicitudes[] = $tipo;
            $array_solicitudes[] = $habilitado;
        }
        return $array_solicitudes;
        pg_close($c);
    }
    
    function habilitar_solicitud($id_solicitud) {
        $con = new Conexion();
        $c = $con->getConection();
        $modelo_solicitud = new ModeloSolicitud();
        $cod_proyecto = $modelo_solicitud->generar_codigo_proyecto();
        $actualizacion = pg_query($c, "update solicitud set habilitado = 'true', cod_proyecto = '$cod_proyecto' where idsolicitud = $id_solicitud");
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
    
    
    function mostrar_cod_proyecto($id_solicitud) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select cod_proyecto
                              from solicitud
                              where idsolicitud = $id_solicitud;");
        $f = pg_fetch_object($consulta);
        $cod_proyecto = $f->cod_proyecto;
        pg_close($c);
        return $cod_proyecto;
    }
    
    function generar_codigo_solicitud() {
        $con = new Conexion();
        $c = $con->getConection();
        $cons_filas_este_anio= pg_query($c, "select count(*) 
                                            from solicitud
                                            where date_part('year', fecha_solicitud) = date_part('year', now());");
        $r = pg_fetch_object($cons_filas_este_anio);
        $cant_filas_este_anio = $r->count;
        $cant_filas_este_anio = str_pad($cant_filas_este_anio, 3, "0", STR_PAD_LEFT);
        $cod = "So-".($cant_filas_este_anio+1)."_".date("y");
        return $cod;
    }
    
    function generar_codigo_proyecto() {
        $con = new Conexion();
        $c = $con->getConection();
        $cons_filas_este_anio= pg_query($c, "select count(*) 
                                            from solicitud
                                            where date_part('year', fecha_solicitud) = date_part('year', now()) and habilitado = 'true';");
        $r = pg_fetch_object($cons_filas_este_anio);
        $cant_filas_este_anio = $r->count;
        $cant_filas_este_anio = str_pad($cant_filas_este_anio, 3, "0", STR_PAD_LEFT);
        $cod = "PS-".($cant_filas_este_anio+1)."_".date("y");
        return $cod;
    }
}
