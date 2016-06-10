<?php
require_once '../Controlador/Conexion.php';
class ModeloProyecto {
    function verificar_proyecto_habilitado_el($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_habilitado = pg_query($c, "select habilitado
                                    from ensayo_laboratorio, solicitud
                                    where idsolicitud = solicitud_idsolicitud and idensayo_laboratorio = $id_proyecto;");
        $r = pg_fetch_object($consulta_habilitado);
        $habilitado = $r->habilitado;
        return $habilitado;
    }
    
    function verificar_proyecto_habilitado_tc($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_habilitado = pg_query($c, "select habilitado
                                    from trabajo_campo, solicitud
                                    where idsolicitud = solicitud_idsolicitud and idtrabajo_campo = $id_proyecto;");
        $r = pg_fetch_object($consulta_habilitado);
        $habilitado = $r->habilitado;
        return $habilitado;
    }
    
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
    
    function mostrar_lista_ensayos($id_solicitud) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select ensayo_idensayo 
                                from detalle_ensayos
                                where ensayo_laboratorio_solicitud_idsolicitud = $id_solicitud;");
        $array_ensayos = array();
        while ($f = pg_fetch_object($consulta)) {
            $id_ensayo = $f->ensayo_idensayo;
            $array_ensayos[] = $id_ensayo;
        }

        return $array_ensayos;
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
    
    function mostrar_lista_estado_ensayo_laboratorio() {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "SELECT idsolicitud, cod_solicitud, cod_proyecto, cliente, 
                                    nombres, apellidos, habilitado, 
                                    muestra_registrada, ensayos_registrados, 
                                    fecha_solicitud, anticipo_pagado, saldo_pagado, 
                                    informe_entregado
                                    FROM ensayo_laboratorio, solicitud, ingeniero, estado_pago
                                    WHERE idsolicitud = ensayo_laboratorio.solicitud_idsolicitud AND ingeniero_idingeniero = idingeniero AND idsolicitud = estado_pago.solicitud_idsolicitud
                                    ORDER BY fecha_solicitud DESC;");
        $array_proyectos = array();
        while ($f = pg_fetch_object($consulta)) {
            $id_solicitud = $f->idsolicitud;
            $cod_solicitud = $f->cod_solicitud;
            $cod_proyecto = $f->cod_proyecto;
            $nombre_resp = $f->nombres;
            $apellido_resp = $f->apellidos;
            $responsable = $nombre_resp . " " . $apellido_resp;
            $nombre_proyecto = $f->cliente;
            $fecha_solicitud =$f->fecha_solicitud;
            
            if (($f->habilitado) == 't') {
                $habilitado = "SI";
            } else {
                $habilitado = "NO";
            }
            
            if (($f->muestra_registrada) == 't') {
                $muestra_registrada = "SI";
            } else {
                $muestra_registrada = "NO";
            }
            
            if (($f->ensayos_registrados) == 't') {
                $ensayos_registrados = "SI";
            } else{
                $ensayos_registrados = "NO";
            }
            
            if (($f->anticipo_pagado) == 't') {
                $anticipo_pagado = "SI";
            } else{
                $anticipo_pagado = "NO";
            }
            
            if (($f->saldo_pagado) == 't') {
                $saldo_pagado = "SI";
            } else{
                $saldo_pagado = "NO";
            }
            
            if (($f->informe_entregado) == 't') {
                $informe_entregado = "SI";
            } else{
                $informe_entregado = "NO";
            }
            
            $array_proyectos[] = $id_solicitud;
            $array_proyectos[] = $cod_solicitud;
            $array_proyectos[] = $responsable;
            $array_proyectos[] = $nombre_proyecto;
            $array_proyectos[] = $habilitado;
            $array_proyectos[] = $muestra_registrada;
            $array_proyectos[] = $ensayos_registrados;
            $array_proyectos[] = $fecha_solicitud;
            $array_proyectos[] = $anticipo_pagado;
            $array_proyectos[] = $saldo_pagado;
            $array_proyectos[] = $informe_entregado;
            $array_proyectos[] = $cod_proyecto;
        }

        return $array_proyectos;
    }
    
    
    function mostrar_lista_estado_trabajo_campo() {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "SELECT idsolicitud, cod_solicitud, cliente, 
                                    nombres, apellidos, habilitado, 
                                    alcance_creado, alcance_aprobado,
                                    fecha_solicitud, anticipo_pagado, saldo_pagado, 
                                    informe_entregado, cod_proyecto
                                    FROM trabajo_campo, solicitud, ingeniero, estado_pago
                                    WHERE idsolicitud = trabajo_campo.solicitud_idsolicitud AND ingeniero_idingeniero = idingeniero AND idsolicitud = estado_pago.solicitud_idsolicitud
                                    ORDER BY fecha_solicitud DESC;");
        $array_proyectos = array();
        while ($f = pg_fetch_object($consulta)) {
            $id_solicitud = $f->idsolicitud;
            $cod_solicitud = $f->cod_solicitud;
            $nombre_resp = $f->nombres;
            $apellido_resp = $f->apellidos;
            $responsable = $nombre_resp . " " . $apellido_resp;
            $nombre_proyecto = $f->cliente;
            $fecha_solicitud =$f->fecha_solicitud;
            $cod_proyecto =$f->cod_proyecto;
            
            if (($f->habilitado) == 't') {
                $habilitado = "SI";
            } else {
                $habilitado = "NO";
            }
            
            if (($f->alcance_creado) == 't') {
                $alcance_creado = "SI";
            } else {
                $alcance_creado = "NO";
            }
            
            if (($f->alcance_aprobado) == 't') {
                $alcance_aprobado = "SI";
            } else{
                $alcance_aprobado = "NO";
            }
            
            if (($f->anticipo_pagado) == 't') {
                $anticipo_pagado = "SI";
            } else{
                $anticipo_pagado = "NO";
            }
            
            if (($f->saldo_pagado) == 't') {
                $saldo_pagado = "SI";
            } else{
                $saldo_pagado = "NO";
            }
            
            if (($f->informe_entregado) == 't') {
                $informe_entregado = "SI";
            } else{
                $informe_entregado = "NO";
            }
            
            $array_proyectos[] = $id_solicitud;
            $array_proyectos[] = $cod_solicitud;
            $array_proyectos[] = $responsable;
            $array_proyectos[] = $nombre_proyecto;
            $array_proyectos[] = $habilitado;
            $array_proyectos[] = $cod_proyecto;
            $array_proyectos[] = $alcance_creado;
            $array_proyectos[] = $alcance_aprobado;
            $array_proyectos[] = $fecha_solicitud;
            $array_proyectos[] = $anticipo_pagado;
            $array_proyectos[] = $saldo_pagado;
            $array_proyectos[] = $informe_entregado;
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


    function mostrar_cod_proyecto_el($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select cod_proyecto
                                    from ensayo_laboratorio, solicitud
                                    where solicitud_idsolicitud = idsolicitud and idensayo_laboratorio = $id_proyecto;");
        $f = pg_fetch_object($consulta);
        $cod_proyecto = $f->cod_proyecto;
        return $cod_proyecto;
    }

    function mostrar_cod_proyecto_tc($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select cod_proyecto
                                    from trabajo_campo, solicitud
                                    where solicitud_idsolicitud = idsolicitud and idtrabajo_campo = $id_proyecto;");
        $f = pg_fetch_object($consulta);
        $cod_proyecto = $f->cod_proyecto;
        return $cod_proyecto;
    }
    
    
    function mostrar_lista_e_l() {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select idensayo_laboratorio, tipo, cod_solicitud
                                    from ensayo_laboratorio, ingeniero, solicitud
                                    where solicitud_ingeniero_idingeniero = idingeniero and solicitud_idsolicitud = idsolicitud
                                    order by idensayo_laboratorio;");
        $array_proyectos = array();
        while ($f = pg_fetch_object($consulta)) {
            $cod_solicitud = $f->cod_solicitud;
            $id_proyecto = $f->idensayo_laboratorio;
            $tipo = $f->tipo;
            $array_proyectos[] = $id_proyecto;
            $array_proyectos[] = $cod_solicitud;
            $array_proyectos[] = $tipo;
        }
        return $array_proyectos;
    }

    function mostrar_lista_t_c() {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select idtrabajo_campo, tipo, cod_solicitud
                                        from trabajo_campo, ingeniero, solicitud
                                        where solicitud_ingeniero_idingeniero = idingeniero and solicitud_idsolicitud = idsolicitud
                                        order by idtrabajo_campo;");
        $array_proyectos = array();
        while ($f = pg_fetch_object($consulta)) {
            $cod_solicitud = $f->cod_solicitud;
            $id_proyecto = $f->idtrabajo_campo;
            $tipo = $f->tipo;
            $array_proyectos[] = $id_proyecto;
            $array_proyectos[] = $cod_solicitud;
            $array_proyectos[] = $tipo;
        }
        return $array_proyectos;
    }

    function set_informe_aprobado($cod_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();

        pg_query($c, "update solicitud
                      set informe_aprobado = TRUE
                      where cod_proyecto = '$cod_proyecto';");

    }

    function verificar_informe_final_aprobado($cod_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_aprobado = pg_query($c, "select informe_aprobado
                                    from solicitud
                                    where cod_proyecto = '$cod_proyecto';");
        $r = pg_fetch_object($consulta_aprobado);
        $aprobado = $r->informe_aprobado;
        return $aprobado;
    }
}


