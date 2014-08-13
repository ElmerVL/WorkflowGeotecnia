<?php
require '../Controlador/Conexion.php';

class ModeloEnsayoLaboratorio {
    function registrar_muestra($id_ensayo, $ub_general, $ub_especificacion, $profundidad, $fecha_toma, 
            $metodo_extraccion, $punto, $tipo_muestra, $descripcion) {
        $modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_datos_ensayo = pg_query($c, "select solicitud_idsolicitud, 
                                        solicitud_director_iddirector, 
                                        solicitud_director_usuario_idusuario, 
                                        solicitud_ingeniero_idingeniero, 
                                        solicitud_ingeniero_usuario_idusuario 
                                        from ensayo_laboratorio where idensayo_laboratorio = $id_ensayo");
        $datos_conseguidos = pg_fetch_object($consulta_datos_ensayo);
        echo $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
        echo "<br>";
        echo $id_director = $datos_conseguidos->solicitud_director_iddirector;
        echo "<br>";
        echo $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
        echo "<br>";
        echo $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
        echo "<br>";
        echo $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;
        echo "<br>";
        echo $metodo_extraccion;
        echo $codigo=$modelo_ensayo_laboratorio->generar_codigo($id_ensayo, $metodo_extraccion, $punto, $tipo_muestra, $profundidad, $descripcion);
            pg_query($c, "INSERT INTO muestra(
            ensayo_laboratorio_solicitud_idsolicitud, ensayo_laboratorio_solicitud_director_iddirector, 
            ensayo_laboratorio_solicitud_director_usuario_idusuario, ensayo_laboratorio_solicitud_ingeniero_idingeniero, 
            ensayo_laboratorio_solicitud_ingeniero_usuario_idusuario, ensayo_laboratorio_idensayo_laboratorio, 
            ubicacion_general, ubicacion_especifica, profundidad, fecha_toma, 
            metodo_extraccion, punto, tipo_muestra, descripcion, codigo_muestra)
    VALUES ($id_solicitud, $id_director, 
            $usr_director, $id_ingeniero, 
            $usr_ingeniero, $id_ensayo, 
            '$ub_general', '$ub_especificacion', $profundidad, '$fecha_toma', 
            '$metodo_extraccion', $punto, '$tipo_muestra', '$descripcion', '$codigo');");
        
        pg_close($c);
    }
    
    function generar_codigo($id_ensayo, $metodo_extraccion, $punto, $tipo_muestra, $profundidad, $descripcion) {
        $modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $nro_muestra = $modelo_ensayo_laboratorio->correlativo($id_ensayo);
        $metodo = $modelo_ensayo_laboratorio->codigo_metodo($metodo_extraccion);
        $tipo = $modelo_ensayo_laboratorio->codigo_tipo($tipo_muestra);
        $descrip = $modelo_ensayo_laboratorio->codigo_descripcion($descripcion);
        $codigo = $nro_muestra."-".$metodo."-".$punto."-".$tipo."-".$profundidad."-".$descrip;
        return $codigo;
    }
    
    function codigo_descripcion($descripcion) {
        if($descripcion="Organico"){       $codigo = "O";
        }elseif ($descripcion="Arcilla") { $codigo = "C";
        }elseif ($descripcion="Limo") {    $codigo = "M";
        }elseif ($descripcion="Grava") {   $codigo = "G";
        }elseif ($descripcion="Bolones") { $codigo = "B";
        }elseif ($descripcion="Rocas") {   $codigo = "R";
        }elseif ($descripcion="Arena") {   $codigo = "S";
        }
        return $codigo;
    }
    
    function codigo_tipo($tipo_muestra) {
        if($tipo_muestra="Disturbada"){           $codigo = "D";
        }elseif ($tipo_muestra="No disturbada") { $codigo = "U";
        }
        return $codigo;
    }
    
    function codigo_metodo($metodo_extraccion) {
        if($metodo_extraccion=="Cuchara bipartita"){              $codigo = "TZG";
        }elseif ($metodo_extraccion=="Tubo shelby") {             $codigo = "SHB";
        }elseif ($metodo_extraccion=="Manual") {                  $codigo = "HND";
        }elseif ($metodo_extraccion=="Mostap") {                  $codigo = "MTP";
        }elseif ($metodo_extraccion=="Extraccion nucleo rocas") { $codigo = "ENR";
        }
        return $codigo;
    }
    
    function correlativo($id_ensayo) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_cantidad_muestras = pg_query($c, "select count(*) from muestra "
                . "where ensayo_laboratorio_idensayo_laboratorio = $id_ensayo;");
        $cantidad_conseguida = pg_fetch_object($consulta_cantidad_muestras);
        $cantidad_muestras = $cantidad_conseguida->count;
        return $cantidad_muestras+1;
    }
    
    function mostrar_tipo_trabajo($id_ensayo) {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta_tipo_trabajo = pg_query($c, "select tipo_trabajo from ensayo_laboratorio, solicitud 
where solicitud_idsolicitud = idsolicitud and idensayo_laboratorio = $id_ensayo;");
        $tipo_conseguido = pg_fetch_object($consulta_tipo_trabajo);
        $tipo_trabajo = $tipo_conseguido->tipo_trabajo;
        return $tipo_trabajo;
    }
    
    function mostrar_datos_ensayo($tipo, $categoria) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_arreglo_ensayos = pg_query("select idensayo, ensayo, unidad, precio_unitario, precio_10_muestras "
                                            . "from ensayo "
                                            . "where tipo = '$tipo' and categoria = '$categoria';");
         $array_ensayos = array();
        while ($f = pg_fetch_object($consulta_arreglo_ensayos)) {
            $id_ensayo = $f->idensayo;
            $ensayo = $f->ensayo;
            $unidad = $f->unidad;
            $precio_unitario = $f->precio_unitario;
            $precio_10_muestras = $f->precio_10_muestras;
            
            $array_datos[] = $id_ensayo;
            $array_datos[] = $ensayo;
            $array_datos[] = $unidad;
            $array_datos[] = $precio_unitario;
            $array_datos[] = $precio_10_muestras;
        }
        return $array_ensayos;
        pg_close($c);
    }
    
    function mostrar_ensayos_categorizado($tipo, $categoria) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_arreglo_ensayos = pg_query("select idensayo, ensayo "
                                            . "from ensayo "
                                            . "where tipo = '$tipo' and categoria = '$categoria';");
         $array_ensayos = array();
        while ($f = pg_fetch_object($consulta_arreglo_ensayos)) {
            $id_ensayo = $f->idensayo;
            $ensayo = $f->ensayo;
            $array_ensayos[] = $id_ensayo;
            $array_ensayos[] = $ensayo;
        }
        return $array_ensayos;
        pg_close($c);
    }
}
