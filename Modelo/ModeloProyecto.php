<?php
require_once '../Controlador/Conexion.php';
class ModeloProyecto {
   function mostrar_lista_proyectos_e_l() {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select idensayo_laboratorio, nombres, apellidos, cliente, tipo, muestra_registrada, cod_solicitud
                                    from ensayo_laboratorio, ingeniero, solicitud
                                    where solicitud_ingeniero_idingeniero = idingeniero and solicitud_idsolicitud = idsolicitud
                                    order by idensayo_laboratorio;");
        $array_proyectos = array();
        while ($f = pg_fetch_object($consulta)) {
            $cod_solicitud = $f->cod_solicitud;
            $id_proyecto = $f->idensayo_laboratorio;
            $nombre_resp = $f->nombres;
            $apellido_resp = $f->apellidos;
            $responsable = $nombre_resp . " " . $apellido_resp;
            $cliente = $f->cliente;
            if (($f->muestra_registrada) == 'f') {
                $muestra_registrada = "NO";
            } elseif (($f->muestra_registrada) == 't') {
                $muestra_registrada = "SI";
            }
            $tipo = $f->tipo;
            $array_proyectos[] = "<a href=../Vista/iuInformacionProyecto.php?i_p=$id_proyecto&t=1>" . $cod_solicitud;
            $array_proyectos[] = $responsable;
            $array_proyectos[] = $cliente;
            $array_proyectos[] = $tipo;
            $array_proyectos[] = $muestra_registrada;
        }

        return $array_proyectos;
    }

    function mostrar_lista_proyectos_t_c() {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select idtrabajo_campo, nombres, apellidos, cliente, tipo, cod_solicitud
                                        from trabajo_campo, ingeniero, solicitud
                                        where solicitud_ingeniero_idingeniero = idingeniero and solicitud_idsolicitud = idsolicitud
                                        order by idtrabajo_campo;");

        while ($f = pg_fetch_object($consulta)) {
            $cod_solicitud = $f->cod_solicitud;
            $id_proyecto = $f->idtrabajo_campo;
            $nombre_resp = $f->nombres;
            $apellido_resp = $f->apellidos;
            $responsable = $nombre_resp . " " . $apellido_resp;
            $cliente = $f->cliente;

            $tipo = $f->tipo;
            $array_proyectos[] = "<a href=../Vista/iuInformacionProyecto.php?i_p=$id_proyecto&t=2>" . $cod_solicitud;
            $array_proyectos[] = $responsable;
            $array_proyectos[] = $cliente;
            $array_proyectos[] = $tipo;
            $array_proyectos[] = " ";
        }

        return $array_proyectos;
    }

    function mostrar_lista_proyectos_e_l_ingeniero($id_usuario) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select idensayo_laboratorio, nombres, apellidos, cliente, tipo, muestra_registrada, cod_solicitud
                                    from ensayo_laboratorio, ingeniero, solicitud
                                    where solicitud_ingeniero_idingeniero = idingeniero and solicitud_idsolicitud = idsolicitud and solicitud_ingeniero_usuario_idusuario = $id_usuario
                                    order by idensayo_laboratorio;");
        $array_proyectos = array();
        while ($f = pg_fetch_object($consulta)) {
            $cod_solicitud = $f->cod_solicitud;
            $id_proyecto = $f->idensayo_laboratorio;
            $nombre_resp = $f->nombres;
            $apellido_resp = $f->apellidos;
            $responsable = $nombre_resp . " " . $apellido_resp;
            $cliente = $f->cliente;
            if (($f->muestra_registrada) == 'f') {
                $muestra_registrada = "NO";
            } elseif (($f->muestra_registrada) == 't') {
                $muestra_registrada = "SI";
            }
            $tipo = $f->tipo;
            $array_proyectos[] = "<a href=../Vista/iuInformacionProyecto.php?i_p=$id_proyecto&t=1>" . $cod_solicitud;
            $array_proyectos[] = $responsable;
            $array_proyectos[] = $cliente;
            $array_proyectos[] = $tipo;
            $array_proyectos[] = $muestra_registrada;
        }

        return $array_proyectos;
    }

    function mostrar_lista_proyectos_t_c_ingeniero($id_usuario) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select idtrabajo_campo, nombres, apellidos, cliente, tipo, cod_solicitud
                                        from trabajo_campo, ingeniero, solicitud
                                        where solicitud_ingeniero_idingeniero = idingeniero and solicitud_idsolicitud = idsolicitud and solicitud_ingeniero_usuario_idusuario = $id_usuario
                                        order by idtrabajo_campo;");
        $array_proyectos = array();
        while ($f = pg_fetch_object($consulta)) {
            $cod_solicitud = $f->cod_solicitud;
            $id_proyecto = $f->idtrabajo_campo;
            $nombre_resp = $f->nombres;
            $apellido_resp = $f->apellidos;
            $responsable = $nombre_resp . " " . $apellido_resp;
            $cliente = $f->cliente;

            $tipo = $f->tipo;
            $array_proyectos[] = "<a href=../Vista/iuInformacionProyecto.php?i_p=$id_proyecto&t=2>" . $cod_solicitud;
            $array_proyectos[] = $responsable;
            $array_proyectos[] = $cliente;
            $array_proyectos[] = $tipo;
            $array_proyectos[] = " ";
        }

        return $array_proyectos;
    }
    
    function mostrar_datos_proyecto_e_l($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select cliente, ubicacion, tipo, fecha_solicitud, ingeniero_idingeniero
                              from solicitud, ingeniero, ensayo_laboratorio
                              where ingeniero_idingeniero = idingeniero and solicitud_idsolicitud = idsolicitud and idensayo_laboratorio = $id_proyecto;");

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
    
    function mostrar_datos_proyecto_t_c($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select cliente, ubicacion, tipo, fecha_solicitud, ingeniero_idingeniero
                              from solicitud, ingeniero, trabajo_campo
                              where ingeniero_idingeniero = idingeniero and solicitud_idsolicitud = idsolicitud and idtrabajo_campo = $id_proyecto;");

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
    
    
    function mostrar_cod_solicitud_el($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select cod_solicitud
                                    from ensayo_laboratorio, solicitud
                                    where solicitud_idsolicitud = idsolicitud and idensayo_laboratorio = $id_proyecto;");
        $f = pg_fetch_object($consulta);
        $cod_solicitud = $f->cod_solicitud;
        return $cod_solicitud;
    }
    
    function mostrar_cod_solicitud_tc($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select cod_solicitud
                                    from trabajo_campo, solicitud
                                    where solicitud_idsolicitud = idsolicitud and idtrabajo_campo = $id_proyecto;");
        $f = pg_fetch_object($consulta);
        $cod_solicitud = $f->cod_solicitud;
        return $cod_solicitud;
    }
}
