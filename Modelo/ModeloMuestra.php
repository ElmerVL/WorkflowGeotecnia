<?php
require_once '../Controlador/Conexion.php';

class ModeloMuestra {

    function mostrar_datos_muestras($id_ensayo) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta = pg_query($c, "select codigo_muestra, idmuestra, nombres, apellidos, 
                                ubicacion_general, ubicacion_especifica, 
                                profundidad, fecha_toma, metodo_extraccion, 
                                punto, tipo_muestra, descripcion 
                                from muestra, ingeniero 
                                where idingeniero = ensayo_laboratorio_solicitud_ingeniero_idingeniero and ensayo_laboratorio_idensayo_laboratorio = $id_ensayo;");
        $array_datos = array();
        while ($f = pg_fetch_object($consulta)) {
            $id_muestra = $f->idmuestra;
            $nombre_resp = $f->nombres;
            $apellido_resp = $f->apellidos;
            $responsable = $nombre_resp . " " . $apellido_resp;
            $ubicacion_general = $f->ubicacion_general;
            $ubicacion_especifica = $f->ubicacion_especifica;
            $profundidad = $f->profundidad;
            $fecha_toma = $f->fecha_toma;
            $metodo_extraccion = $f->metodo_extraccion;
            $punto = $f->punto;
            $tipo_muestra = $f->tipo_muestra;
            $descripcion = $f->descripcion;
            $codigo_muestra = $f->codigo_muestra;

            $array_datos[] = $codigo_muestra;
            $array_datos[] = $id_muestra;
            $array_datos[] = $responsable;
            $array_datos[] = $tipo_muestra;
            $array_datos[] = $ubicacion_general;
            $array_datos[] = $ubicacion_especifica;
            $array_datos[] = $profundidad;
            $array_datos[] = $fecha_toma;
            $array_datos[] = $metodo_extraccion;
            $array_datos[] = $punto;
            $array_datos[] = $descripcion;
        }
        return $array_datos;
        pg_close($c);
    }


}
