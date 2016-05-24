<?php

require_once '../Controlador/Conexion.php';

class ModeloAlcance {

    function registrar_alcance($id_trabajo, $antecedente, $objetivo, $trabajo_campo, $trabajo_gabinete, $trabajo_laboratorio, $duracion, $precio, $forma_pago, $r_adicionales) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_datos_t_c = pg_query($c, "select solicitud_ingeniero_usuario_idusuario, 
            solicitud_ingeniero_idingeniero, solicitud_director_usuario_idusuario, 
            solicitud_director_iddirector, solicitud_idsolicitud 
            from trabajo_campo 
            where idtrabajo_campo = $id_trabajo;");
        $datos_conseguidos = pg_fetch_object($consulta_datos_t_c);
        $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
        $id_director = $datos_conseguidos->solicitud_director_iddirector;
        $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
        $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
        $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;

        pg_query($c, "INSERT INTO alcance(
            trabajo_campo_solicitud_idsolicitud, trabajo_campo_solicitud_director_iddirector, 
            trabajo_campo_solicitud_director_usuario_idusuario, trabajo_campo_solicitud_ingeniero_idingeniero, 
            trabajo_campo_solicitud_ingeniero_usuario_idusuario, trabajo_campo_idtrabajo_campo, 
            antecedente, objetivo, trabajo_campo, trabajo_gabinete, trabajo_laboratorio, 
            duracion, precio, forma_pago, reques_adicionales)
    VALUES ($id_solicitud, $id_director, 
            $usr_director, $id_ingeniero, 
            $usr_ingeniero, $id_trabajo, 
            '$antecedente', '$objetivo', '$trabajo_campo', '$trabajo_gabinete', '$trabajo_laboratorio', 
            $duracion, $precio, '$forma_pago', '$r_adicionales');");
        
        pg_query($c, "UPDATE trabajo_campo
                        SET alcance_creado='true', alcance_aprobado='true'
                      WHERE idtrabajo_campo = $id_trabajo;");
        
        pg_close($c);
    }
    
    function recuperar_datos_alcance($id_trabajo) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_datos_alcance = pg_query($c, "select antecedente, objetivo, trabajo_campo, 
                                    trabajo_gabinete, trabajo_laboratorio, 
                                    duracion, precio, forma_pago, reques_adicionales, observaciones 
                                    from alcance
                                    where trabajo_campo_idtrabajo_campo = $id_trabajo;");
        $array_alcance = array();
        $datos_conseguidos = pg_fetch_object($consulta_datos_alcance);
        $array_alcance[] = $datos_conseguidos->antecedente;
        $array_alcance[] = $datos_conseguidos->objetivo;
        $array_alcance[] = $datos_conseguidos->trabajo_campo;
        $array_alcance[] = $datos_conseguidos->trabajo_gabinete;
        $array_alcance[] = $datos_conseguidos->trabajo_laboratorio;
        $array_alcance[] = $datos_conseguidos->duracion;
        $array_alcance[] = $datos_conseguidos->precio;
        $array_alcance[] = $datos_conseguidos->forma_pago;
        $array_alcance[] = $datos_conseguidos->reques_adicionales;
        $array_alcance[] = $datos_conseguidos->observaciones;

        return $array_alcance;
    }
    
    function alcance_creado($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $cuenta_filas_alcance = pg_query($c, "select count(*) 
                                    from alcance
                                    where trabajo_campo_idtrabajo_campo = $id_proyecto");
        $f = pg_fetch_object($cuenta_filas_alcance);
        $cantidad = $f->count;
        if($cantidad > 0){
            return TRUE;
        } else {
            return FALSE;
        }
        pg_close($c);
    }
    
    function registrar_observaciones($id_trabajo, $observacion) {
        $con = new Conexion();
        $c = $con->getConection();
        $sql_insetar_observacion = pg_query($c, "UPDATE alcance
                                  SET observaciones='$observacion', con_observacion = TRUE
                                  WHERE trabajo_campo_idtrabajo_campo = $id_trabajo");
        
        pg_close($c);
    }
    
    function verificar_observacion($id_trabajo) {
        $con = new Conexion();
        $c = $con->getConection();
        $bool_observacion = pg_query($c, "select con_observacion 
                                    from alcance
                                    where trabajo_campo_idtrabajo_campo = $id_trabajo");
        $r=  pg_fetch_object($bool_observacion);
        $bool = $r->con_observacion;
        $res = FALSE;
        if($bool == 't'){
            $res = TRUE;
        }else {
            $res = FALSE;
        }
        return $res;
        pg_close($c);
    }
    
    function actualizar_valor_alcance($id_trabajo, $posicion, $valor) {
        $con = new Conexion();
        $c = $con->getConection();
        switch ($posicion) {
            case 0:
                pg_query($c, "UPDATE alcance
                            SET antecedente='$valor'
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 1:
                pg_query($c, "UPDATE alcance
                            SET objetivo='$valor'
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 2:
                pg_query($c, "UPDATE alcance
                            SET trabajo_campo='$valor'
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 3:
                pg_query($c, "UPDATE alcance
                            SET trabajo_gabinete='$valor'
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 4:
                pg_query($c, "UPDATE alcance
                            SET trabajo_laboratorio='$valor'
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 5:
                pg_query($c, "UPDATE alcance
                            SET duracion=$valor
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 6:
                pg_query($c, "UPDATE alcance
                            SET precio=$valor
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 7:
                pg_query($c, "UPDATE alcance
                            SET forma_pago='$valor'
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 8:
                pg_query($c, "UPDATE alcance
                            SET reques_adicionales='$valor'
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
            case 9:
                pg_query($c, "UPDATE alcance
                            SET observaciones='$valor'
                          WHERE trabajo_campo_idtrabajo_campo = $id_trabajo;");
                break;
        }
    }
    
}