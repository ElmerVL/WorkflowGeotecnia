<?php
class Conexion {
    public function getConection() {
        $cadena = "host='localhost' port='5432' dbname='Geotecnia' user ='postgres' password='postgres'";
        $con = pg_connect($cadena) or die('Error en la conexion');
        return $con;
    }

    function ejecutarSql($sql) {
        $conec = new Conexion();
        $con = $conec->getConection();
        $filas = array();
        $consulta = pg_query($con, $sql);
        while ($f = pg_fetch_array($consulta)) {
            $filas[] = $f;
        }
        return $filas;
    }

}