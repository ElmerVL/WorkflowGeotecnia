<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModeloWorkflow
 *
 * @author VAIO
 */
class ModeloWorkflow {
    function consultar_solicitudes() {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select cod_solicitud
                                from solicitud
                                where habilitado = 'f'
                                order by fecha_solicitud desc limit 10 offset 0;");
        $array_solicitudes = array();
        $array_solicitudes[] = "";
        while ($f = pg_fetch_object($consulta)) {
            $cod_proyecto = $f->cod_proyecto;
            $array_solicitudes[] = $cod_proyecto;
        }
        return $array_solicitudes;
    }
    
    function consultar_alcances_NC() {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select cod_solicitud
                                from trabajo_campo, solicitud
                                where alcance_creado = 'f' and solicitud_idsolicitud = idsolicitud
                                order by fecha_solicitud desc limit 10 offset 0;");
        $array_solicitudes = array();
        $array_solicitudes[] = "";
        while ($f = pg_fetch_object($consulta)) {
            $cod_proyecto = $f->cod_proyecto;
            $array_solicitudes[] = $cod_proyecto;
        }
        return $array_solicitudes;
    }
    
    function consultar_alcances_NA() {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select cod_solicitud
                                from trabajo_campo, solicitud
                                where alcance_creado = 't' and alcance_aprobado = 'f' and solicitud_idsolicitud = idsolicitud
                                order by fecha_solicitud desc limit 10 offset 0;");
        $array_solicitudes = array();
        $array_solicitudes[] = "";
        while ($f = pg_fetch_object($consulta)) {
            $cod_proyecto = $f->cod_proyecto;
            $array_solicitudes[] = $cod_proyecto;
        }
        return $array_solicitudes;
    }
}
