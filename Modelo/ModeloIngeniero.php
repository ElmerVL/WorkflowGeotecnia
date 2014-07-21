<?php
require_once '../Controlador/Conexion.php';
class ModeloIngeniero {
    function mostrar_lista_ingenieros() {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_cantidad_conseguida = pg_query($c, "select count(*) from ingeniero;");
        $f = pg_fetch_object($consulta_cantidad_conseguida);
        $cant = $f->count;

        if ($cant == 0) {
            echo '<option value="0">No existen ingenieros registrados</option>';
        } else {
            $consulta_ingenieros = pg_query($c, "select idingeniero, nombres, apellidos from ingeniero;");
            while ($f_ingenieros = pg_fetch_object($consulta_ingenieros)) {
                $id_ingeniero = $f_ingenieros->idingeniero;
                $nombre_ingeniero = $f_ingenieros->nombres;
                $apellidos_ingeniero = $f_ingenieros->apellidos;
                echo "<option value='$id_ingeniero'>$nombre_ingeniero $apellidos_ingeniero</option>";
            }
        }
        pg_close($c);
    }
}
