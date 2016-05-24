<?php
require_once '../Controlador/Conexion.php';
class ModeloCalendario {
    function insertar_fechas($tipo_proyecto, $id_proyecto, $fecha_inicio, $fecha_fin) {
        $con = new Conexion();
        $c = $con->getConection();
        if ($tipo_proyecto == 1) {
            $consulta_datos_ensayo = pg_query($c, "select solicitud_idsolicitud, solicitud_director_iddirector, 
                                    solicitud_director_usuario_idusuario, solicitud_ingeniero_idingeniero, 
                                    solicitud_ingeniero_usuario_idusuario, idensayo_laboratorio
                                    from ensayo_laboratorio
                                    where idensayo_laboratorio = $id_proyecto");
            $datos_conseguidos = pg_fetch_object($consulta_datos_ensayo);
            $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
            $id_director = $datos_conseguidos->solicitud_director_iddirector;
            $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
            $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
            $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;
        } else {
            $consulta_datos_trabajo = pg_query($c, "select solicitud_idsolicitud, solicitud_director_iddirector, 
                                    solicitud_director_usuario_idusuario, solicitud_ingeniero_idingeniero, 
                                    solicitud_ingeniero_usuario_idusuario, idensayo_laboratorio
                                    from trabajo_campo
                                    where idtrabajo_campo = $id_proyecto");
            $datos_conseguidos = pg_fetch_object($consulta_datos_trabajo);
            $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
            $id_director = $datos_conseguidos->solicitud_director_iddirector;
            $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
            $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
            $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;
        }
        return pg_query($c, "INSERT INTO calendario(
                                        solicitud_ingeniero_usuario_idusuario, solicitud_ingeniero_idingeniero, 
                                        solicitud_director_usuario_idusuario, solicitud_director_iddirector, 
                                        solicitud_idsolicitud, fecha_inicio, fecha_fin)
                                        VALUES ($usr_ingeniero, $id_ingeniero, 
                                                $usr_director, $id_director, 
                                                $id_solicitud, '$fecha_inicio', '$fecha_fin');");
    }
    
    function recuperar_fechas() {
        $con = new Conexion();
        $c = $con->getConection();
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_1 = pg_query($c, "select fecha_inicio, fecha_fin, solicitud_idsolicitud, cliente, tipo, cod_solicitud, idsolicitud
                                    from calendario, solicitud
                                    where solicitud_idsolicitud = idsolicitud");
        $arreglo_fechas = array();
        while ($f = pg_fetch_object($consulta_1)) {
            $fecha_inicio = $f->fecha_inicio;
            $fecha_fin = $f->fecha_fin;
            $cod_solicitud =  $f->cod_solicitud;
            $cliente = $f->cliente;
            $tipo = $f->tipo;
            $id_solicitud = $f->idsolicitud;
            if($tipo == 'ensayo de laboratorio'){
                $consulta_el = pg_query($c, "select idensayo_laboratorio 
                                            from ensayo_laboratorio
                                            where solicitud_idsolicitud = $id_solicitud;");
                $f_el = pg_fetch_object($consulta_el);
                $id_proyecto = $f_el->idensayo_laboratorio;
            } else {
                $consulta_tc = pg_query($c, "select idtrabajo_campo 
                                            from trabajo_campo
                                            where solicitud_idsolicitud = $id_solicitud;");
                $f_tc = pg_fetch_object($consulta_tc);
                $id_proyecto = $f_tc->idtrabajo_campo;
            }
            $arreglo_fechas[] = $fecha_inicio;
            $arreglo_fechas[] = $fecha_fin;
            $arreglo_fechas[] = $cod_solicitud;
            $arreglo_fechas[] = $cliente;
            $arreglo_fechas[] = $id_proyecto;
        }
        return $arreglo_fechas;
    }
}
