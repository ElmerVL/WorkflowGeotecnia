<?php
require_once '../Controlador/Conexion.php';
class ModeloUltimo {
    function recuperar_10_filas_bitacora() {
        $modelo_ultimo = new ModeloUltimo();
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select actividad, fecha, id_solicitud 
                                from bitacora_principales order by fecha desc limit 10 offset 0;");
        $array_actividades = array();
        while ($f = pg_fetch_object($consulta)) {
            $actividad = $f->actividad;
            $fecha = $f->fecha;
            $id_solicitud = $f->id_solicitud;
            $array_actividades[] = $actividad;
            $array_actividades[] = $fecha;
            $array_actividades[] = $id_solicitud;
            $id_proyecto = $modelo_ultimo->obtener_id_proyecto($id_solicitud);
            $tipo_proyecto = $modelo_ultimo->obtener_tipo($id_solicitud);
            $array_actividades[] = "<a style =  'font-size: 16px;' href = ../Vista/iuInformacionProyecto.php?i_p=$id_proyecto&t=$tipo_proyecto>$actividad</a><br /><h7>$fecha</h7>";
        }
        return $array_actividades;
    }
    
    function obtener_tipo($id_solicitud) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select tipo from solicitud where idsolicitud = $id_solicitud;");
        $f = pg_fetch_object($consulta);
        $tipo = $f->tipo;
        if($tipo == 'ensayo de laboratorio'){
            $tipo = 1;
        }elseif($tipo == 'trabajo de campo'){
            $tipo = 2;
        }
        return $tipo;
    }
    
    function obtener_id_proyecto($id_solicitud) {
        $modelo_ultimo = new ModeloUltimo();
        $con = new Conexion();
        $c = $con->getConection();
        $tipo = $modelo_ultimo->obtener_tipo($id_solicitud);
        if($tipo == 1){
            $consulta = pg_query($c, "select idensayo_laboratorio from ensayo_laboratorio where solicitud_idsolicitud = $id_solicitud;");
            $f = pg_fetch_object($consulta);
            $id_proyecto = $f->idensayo_laboratorio;
        }elseif($tipo == 2){
            $consulta = pg_query($c, "select idtrabajo_campo from trabajo_campo where solicitud_idsolicitud = $id_solicitud;");
            $f = pg_fetch_object($consulta);
            $id_proyecto = $f->idtrabajo_campo;
        }
        return $id_proyecto;
    }
}
