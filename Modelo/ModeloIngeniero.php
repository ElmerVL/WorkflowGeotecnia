<?php
require_once '../Controlador/Conexion.php';
class ModeloIngeniero {
    function mostrar_lista_ingenieros($cargo) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_cantidad_conseguida = pg_query($c, "select count(*) from ingeniero;");
        $f = pg_fetch_object($consulta_cantidad_conseguida);
        $cant = $f->count;
        $array_ingenieros = array();
        if ($cant == 0) {
            echo '<option value="0">No existen ingenieros registrados</option>';
        } else {
            $consulta_ingenieros = pg_query($c, "select idingeniero, nombres, apellidos from ingeniero where cargo = '$cargo';");
            while ($f_ingenieros = pg_fetch_object($consulta_ingenieros)) {
                $id_ingeniero = $f_ingenieros->idingeniero;
                $nombre_ingeniero = $f_ingenieros->nombres;
                $apellidos_ingeniero = $f_ingenieros->apellidos;
                
                $array_ingenieros[] = $id_ingeniero;
                $array_ingenieros[] = $nombre_ingeniero;
                $array_ingenieros[] = $apellidos_ingeniero;
            }
        }
        pg_close($c);
        return $array_ingenieros;
    }
    
    function mostrar_lista_ingeniero_seleccionado() {
        
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_ingenieros = pg_query($c, "select idingeniero, nombres, apellidos from ingeniero;");

        $array_ingenieros = array();
        while ($f_ingenieros = pg_fetch_object($consulta_ingenieros)) {

            $id_ingeniero = $f_ingenieros->idingeniero;
            $nombre_ingeniero = $f_ingenieros->nombres;
            $apellidos_ingeniero = $f_ingenieros->apellidos;

            $array_ingenieros[] = $id_ingeniero;
            $array_ingenieros[] = $nombre_ingeniero;
            $array_ingenieros[] = $apellidos_ingeniero;
        } 
        pg_close($c);
        return $array_ingenieros;
    }
}
