<?php
require_once '../Controlador/Conexion.php';

class ModeloPago {
    function verificar_anticipo_pagado($id_proyecto, $tipo_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        if($tipo_proyecto == 1){
            $cons_id_solicitud = pg_query($c, "select solicitud_idsolicitud from ensayo_laboratorio where idensayo_laboratorio = $id_proyecto");
            $r_sol = pg_fetch_object($cons_id_solicitud);
            $id_solicitud=$r_sol->solicitud_idsolicitud;
        } else {
            $cons_id_solicitud = pg_query($c, "select solicitud_idsolicitud from trabajo_campo where idtrabajo_campo = $id_proyecto");
            $r_sol = pg_fetch_object($cons_id_solicitud);
            $id_solicitud=$r_sol->solicitud_idsolicitud;
        }
        $cons_anticipo_pagado = pg_query($c, "select count(*) from estado_pago where solicitud_idsolicitud = $id_solicitud;");
        $r = pg_fetch_object($cons_anticipo_pagado);
        $cant = $r->count;
        if($cant > 0){
            $resp = true;
        } else {
            $resp = false;
        }
        return $resp;
        pg_close($c);
    }
    
    function verificar_saldo_pagado($id_proyecto, $tipo_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        if($tipo_proyecto == 1){
            $cons_id_solicitud = pg_query($c, "select solicitud_idsolicitud from ensayo_laboratorio where idensayo_laboratorio = $id_proyecto");
            $r_sol = pg_fetch_object($cons_id_solicitud);
            $id_solicitud=$r_sol->solicitud_idsolicitud;
        } else {
            $cons_id_solicitud = pg_query($c, "select solicitud_idsolicitud from trabajo_campo where idtrabajo_campo = $id_proyecto");
            $r_sol = pg_fetch_object($cons_id_solicitud);
            $id_solicitud=$r_sol->solicitud_idsolicitud;
        }
        $cons_saldo_pagado = pg_query($c, "select saldo_pagado from estado_pago where solicitud_idsolicitud = $id_solicitud;");
        $r = pg_fetch_object($cons_saldo_pagado);
        $resp = $r->saldo_pagado;
        if($resp == "t"){
            $res = true;
        } else {
            $res = false;
        }
        return $res;
        pg_close($c);
    }
    
    function insertar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, $porcentaje_pago, $monto_pago, $p_anticipo, $p_saldo) {
        $con = new Conexion();
        $c = $con->getConection();
        if($tipo_proyecto==1){
            $consulta_datos_ensayo = pg_query($c, "select solicitud_idsolicitud, 
                                            solicitud_director_iddirector, 
                                            solicitud_director_usuario_idusuario, 
                                            solicitud_ingeniero_idingeniero, 
                                            solicitud_ingeniero_usuario_idusuario 
                                            from ensayo_laboratorio where idensayo_laboratorio = $id_proyecto");
            $datos_conseguidos = pg_fetch_object($consulta_datos_ensayo);
            $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
            $id_director = $datos_conseguidos->solicitud_director_iddirector;
            $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
            $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
            $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;
        }else{
            $consulta_datos_ensayo = pg_query($c, "select solicitud_idsolicitud, 
                                        solicitud_director_iddirector, 
                                        solicitud_director_usuario_idusuario, 
                                        solicitud_ingeniero_idingeniero, 
                                        solicitud_ingeniero_usuario_idusuario 
                                        from trabajo_campo where idtrabajo_campo = $id_proyecto");
            $datos_conseguidos = pg_fetch_object($consulta_datos_ensayo);
            $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
            $id_director = $datos_conseguidos->solicitud_director_iddirector;
            $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
            $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
            $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;
        }
        $modelo_pago = new ModeloPago(); 
        $id_estado = $modelo_pago->generar_id_estado();
        pg_query($c, "INSERT INTO estado_pago(
            idestado_pago, solicitud_ingeniero_usuario_idusuario, solicitud_ingeniero_idingeniero, 
            solicitud_director_usuario_idusuario, solicitud_director_iddirector, 
            solicitud_idsolicitud, porcentaje_anticipo, anticipo_pagado, 
            porcentaje_saldo, saldo_pagado)
                VALUES ($id_estado, $usr_ingeniero, $id_ingeniero, 
                        $usr_director, $id_director, 
                        $id_solicitud, $p_anticipo, 'TRUE', 
                        $p_saldo, 'FALSE');");
        
        pg_close($c);
        $modelo_pago->insertar_orden_pago($id_estado, $nro_orden_pago, $nro_factura_pago, $porcentaje_pago, $monto_pago, $usr_ingeniero, $id_ingeniero, $usr_director, $id_director, $id_solicitud);
    }
    
    
    function actualizar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, $porcentaje_pago, $monto_pago) {
        $con = new Conexion();
        $c = $con->getConection();
        
        if($tipo_proyecto==1){
            $consulta_datos_ensayo = pg_query($c, "select solicitud_idsolicitud, 
                                            solicitud_director_iddirector, 
                                            solicitud_director_usuario_idusuario, 
                                            solicitud_ingeniero_idingeniero, 
                                            solicitud_ingeniero_usuario_idusuario 
                                            from ensayo_laboratorio where idensayo_laboratorio = $id_proyecto");
            $datos_conseguidos = pg_fetch_object($consulta_datos_ensayo);
            $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
            $id_director = $datos_conseguidos->solicitud_director_iddirector;
            $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
            $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
            $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;
        }else{
            $consulta_datos_ensayo = pg_query($c, "select solicitud_idsolicitud, 
                                        solicitud_director_iddirector, 
                                        solicitud_director_usuario_idusuario, 
                                        solicitud_ingeniero_idingeniero, 
                                        solicitud_ingeniero_usuario_idusuario 
                                        from trabajo_campo where idtrabajo_campo = $id_proyecto");
            $datos_conseguidos = pg_fetch_object($consulta_datos_ensayo);
            $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
            $id_director = $datos_conseguidos->solicitud_director_iddirector;
            $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
            $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
            $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;
        }
        
        $modelo_pago = new ModeloPago(); 
        
        $consulta_id_estado = pg_query($c, "select idestado_pago from estado_pago where solicitud_idsolicitud = $id_solicitud;");
        $dato = pg_fetch_object($consulta_id_estado);
        $id_estado = $dato->idestado_pago;
        echo "id estado aqui ".$id_estado;
        pg_query($c, "UPDATE estado_pago
                        SET saldo_pagado=true
                        WHERE solicitud_idsolicitud = $id_solicitud;");
        pg_close($c);
        if($porcentaje_pago<100){
            $modelo_pago->insertar_orden_pago($id_estado, $nro_orden_pago, $nro_factura_pago, $porcentaje_pago, $monto_pago, $usr_ingeniero, $id_ingeniero, $usr_director, $id_director, $id_solicitud);
        }
    }
    
    function insertar_orden_pago($id_estado, $nro_orden_pago, 
                                    $nro_factura_pago, $porcentaje_pago, 
                                    $monto_pago, $usr_ingeniero, $id_ingeniero, 
                                    $usr_director, $id_director, $id_solicitud) {
        $con = new Conexion();
        $c = $con->getConection();
        
        pg_query($c, "INSERT INTO orden_pago(
                        estado_pago_solicitud_idsolicitud, estado_pago_solicitud_director_iddirector, 
                        estado_pago_solicitud_director_usuario_idusuario, estado_pago_solicitud_ingeniero_idingeniero, 
                        estado_pago_solicitud_ingeniero_usuario_idusuario, estado_pago_idestado_pago, 
                        nro_orden_pago, nro_factura_pago, porcentaje_pago, monto_pago)
                        VALUES ($id_solicitud, $id_director, 
                                $usr_director, $id_ingeniero, 
                                $usr_ingeniero, $id_estado, 
                                $nro_orden_pago, $nro_factura_pago, $porcentaje_pago, $monto_pago);");
        pg_close($c);
    }
    
    function generar_id_estado() {
        $con = new Conexion();
        $c = $con->getConection();
        
        $cons_cantidad = pg_query($c, "select count(*) from estado_pago;");
        $r = pg_fetch_object($cons_cantidad);
        $cant = $r->count;
        return $cant+1;
        pg_close($c);
    }
}

