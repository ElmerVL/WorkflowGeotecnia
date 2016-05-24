<?php
require_once '../Controlador/Conexion.php';

class ModeloEnsayoLaboratorio {
    
    function actualizar_tiempo($id_proyecto, $cod_ensayo, $direccion) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_tiempo_actual = pg_query("select tiempo_total
                                        from detalle_ensayos 
                                        where ensayo_laboratorio_idensayo_laboratorio = $id_proyecto and ensayo_idensayo = '$cod_ensayo';");
        $f = pg_fetch_object($consulta_tiempo_actual);
        $tiempo_a = $f->tiempo_total;
        if($direccion==1){
            $tiempo_total = $tiempo_a+1;
        } else {
            $tiempo_total = $tiempo_a-1;
        }
        pg_query("UPDATE detalle_ensayos
                            SET tiempo_total=$tiempo_total
                          WHERE ensayo_laboratorio_idensayo_laboratorio = $id_proyecto and ensayo_idensayo = '$cod_ensayo';");
        
        pg_close($c);
    }
    
    function calcular_suma_tiempo_ensayos($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_suma_tiempo = pg_query("select sum(tiempo_total) 
                                        from detalle_ensayos 
                                        where ensayo_laboratorio_idensayo_laboratorio = $id_proyecto;");
        
        $f = pg_fetch_object($consulta_suma_tiempo);
        $suma_tiempos = $f->sum;
        return $suma_tiempos;
        pg_close($c);
    }
    
    function eliminar_ensyao($id_proyecto, $cod_ensayo) {
        $con = new Conexion();
        $c = $con->getConection();
        
        pg_query($c, "DELETE FROM formulario_el CASCADE
                        WHERE detalle_ensayos_ensayo_idensayo = '$cod_ensayo' and detalle_ensayos_ensayo_laboratorio_idensayo_laboratorio = $id_proyecto;");
        pg_query($c, "DELETE FROM detalle_ensayos
                        WHERE ensayo_idensayo = '$cod_ensayo' and ensayo_laboratorio_idensayo_laboratorio = $id_proyecto;");
        pg_close($c);
    }
    
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
        $id_solicitud = $datos_conseguidos->solicitud_idsolicitud;
        $id_director = $datos_conseguidos->solicitud_director_iddirector;
        $usr_director = $datos_conseguidos->solicitud_director_usuario_idusuario;
        $id_ingeniero = $datos_conseguidos->solicitud_ingeniero_idingeniero;
        $usr_ingeniero = $datos_conseguidos->solicitud_ingeniero_usuario_idusuario;
        $metodo_extraccion;
        $codigo=$modelo_ensayo_laboratorio->generar_codigo($id_ensayo, $metodo_extraccion, $punto, $tipo_muestra, $profundidad, $descripcion);
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
        pg_query($c, "UPDATE ensayo_laboratorio
                        SET muestra_registrada='true'
                        WHERE idensayo_laboratorio = $id_ensayo;");
        pg_close($c);
    }
    
    function generar_codigo($id_ensayo, $metodo_extraccion, $punto_1, $tipo_muestra, $profundidad, $descripcion) {
        $modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $corr_muestra = $modelo_ensayo_laboratorio->correlativo($id_ensayo);
        $nro_muestra = str_pad($corr_muestra, 3, "0", STR_PAD_LEFT);
        $metodo = $modelo_ensayo_laboratorio->codigo_metodo($metodo_extraccion);
        $punto = str_pad($punto_1, 3, "0", STR_PAD_LEFT);
        $tipo = $modelo_ensayo_laboratorio->codigo_tipo($tipo_muestra);
        $descrip = $modelo_ensayo_laboratorio->codigo_descripcion($descripcion);
        $codigo = $nro_muestra."-".$metodo."-".$punto."-".$tipo."-".$profundidad."-".$descrip;
        return $codigo;
    }
    
    function codigo_descripcion($descripcion) {
        if($descripcion=="Organico"){       $codigo = "O";
        }elseif ($descripcion=="Arcilla") { $codigo = "C";
        }elseif ($descripcion=="Limo") {    $codigo = "M";
        }elseif ($descripcion=="Grava") {   $codigo = "G";
        }elseif ($descripcion=="Bolones") { $codigo = "B";
        }elseif ($descripcion=="Rocas") {   $codigo = "R";
        }elseif ($descripcion=="Arena") {   $codigo = "S";
        }
        return $codigo;
    }
    
    function codigo_tipo($tipo_muestra) {
        if($tipo_muestra=="Disturbada"){           $codigo = "D";
        }elseif ($tipo_muestra=="No disturbada") { $codigo = "U";
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
                                            . "where tipo = '$tipo' and categoria = '$categoria'"
                                            . "order by idensayo;");
         $array_ensayos = array();
        while ($f = pg_fetch_object($consulta_arreglo_ensayos)) {
            $id_ensayo = $f->idensayo;
            $ensayo = $f->ensayo;
            $unidad = $f->unidad;
            $precio_unitario = $f->precio_unitario;
            $precio_10_muestras = $f->precio_10_muestras;
            
            $array_ensayos[] = $id_ensayo;
            $array_ensayos[] = $ensayo;
            $array_ensayos[] = $unidad;
            $array_ensayos[] = $precio_unitario;
            $array_ensayos[] = $precio_10_muestras;
        }
        return $array_ensayos;
        pg_close($c);
    }
    
    function mostrar_ensayos_categorizado($tipo, $categoria) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_arreglo_ensayos = pg_query("select idensayo, ensayo "
                                            . "from ensayo "
                                            . "where tipo = '$tipo' and categoria = '$categoria'"
                                            . "order by idensayo;");
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
    
    function insertar_detalle_ensayo($id_proyecto, $id_ensayo, $cant_ensayo) {
        $con = new Conexion();
        $c = $con->getConection();
        $modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $consulta_datos_insertar = pg_query($c, "select solicitud_ingeniero_usuario_idusuario, 
                    solicitud_ingeniero_idingeniero, 
                    solicitud_director_usuario_idusuario, 
                    solicitud_director_iddirector, 
                    solicitud_idsolicitud 
            from ensayo_laboratorio 
            where idensayo_laboratorio = $id_proyecto");
        $f = pg_fetch_object($consulta_datos_insertar);
        $usr_ingeniero = $f->solicitud_ingeniero_usuario_idusuario;
        $id_ingeniero = $f->solicitud_ingeniero_idingeniero;
        $usr_director = $f->solicitud_director_usuario_idusuario;
        $id_director = $f->solicitud_director_iddirector;
        $id_solicitud = $f->solicitud_idsolicitud;
        
        $consulta_precio_unitario = pg_query($c, "select precio_unitario, precio_10_muestras, duracion_ensayo from ensayo where idensayo = '$id_ensayo'");
        $d_u = pg_fetch_object($consulta_precio_unitario);
        if($cant_ensayo>=10)
            $precio_unitario = $d_u->precio_10_muestras;
        else
            $precio_unitario = $d_u->precio_unitario;
        $precio_ensayo_total = $modelo_ensayo_laboratorio->calcular_precio($id_ensayo, $cant_ensayo);
        $tiempo_unidad = $d_u->duracion_ensayo;
        $tiempo_total = ($d_u->duracion_ensayo)*$cant_ensayo;


        echo 'PST'. $id_ensayo;
        echo 'TU'. $tiempo_unidad;
        echo 'TT'. $tiempo_total;

        
        pg_query($c, "INSERT INTO detalle_ensayos(
            ensayo_laboratorio_solicitud_idsolicitud, 
            ensayo_laboratorio_solicitud_director_iddirector, ensayo_laboratorio_solicitud_director_usuario_idusuario, 
            ensayo_laboratorio_solicitud_ingeniero_idingeniero, ensayo_laboratorio_solicitud_ingeniero_usuario_idusuario, 
            ensayo_laboratorio_idensayo_laboratorio, ensayo_idensayo, cantidad_ensayo, precio_total_ensayo, precio_unitario, tiempo_total, tiempo_unidad)
                VALUES ($id_solicitud, 
                        $id_director, $usr_director, 
                        $id_ingeniero, $usr_ingeniero, 
                        $id_proyecto, '$id_ensayo', $cant_ensayo, $precio_ensayo_total, $precio_unitario, $tiempo_total, $tiempo_unidad);");
        pg_query($c, "UPDATE ensayo_laboratorio 
                        SET ensayos_registrados='true'
                      WHERE idensayo_laboratorio = $id_proyecto;");
        pg_close($c);
    }
    
    function calcular_precio($id_ensayo, $cant_ensayo){
            $con = new Conexion();
            $c = $con->getConection();
        if($cant_ensayo<10){
            $consulta_precio = pg_query($c, "select precio_unitario from ensayo where idensayo = '$id_ensayo' ;");
            $f = pg_fetch_object($consulta_precio);
            $precio_e = $f->precio_unitario;
            $precio_t = $precio_e*$cant_ensayo;
        }else{
            $consulta_precio = pg_query($c, "select precio_10_muestras from ensayo where idensayo = '$id_ensayo' ;");
            $f = pg_fetch_object($consulta_precio);
            $precio_e = $f->precio_10_muestras;
            $precio_t = $precio_e*$cant_ensayo;
        }
        return $precio_t;
        pg_close($c);
    }
    
    function mostrar_resumen_detalle_ensayos_registrados($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_arreglo_ensayos = pg_query("select ensayo_idensayo, tipo, categoria, ensayo
                                        from detalle_ensayos, ensayo 
                                        where ensayo_laboratorio_idensayo_laboratorio = $id_proyecto and ensayo_idensayo = idensayo;");
        $array_datos_ensayos = array();
        while ($f = pg_fetch_object($consulta_arreglo_ensayos)) {
            $id_ensayo = $f->ensayo_idensayo;
            $tipo = $f->tipo;
            $categoria = $f->categoria;
            $nombre_ensayo = $f->ensayo;
            
            $array_datos_ensayos[] = $id_ensayo;
            $array_datos_ensayos[] = $tipo;
            $array_datos_ensayos[] = $categoria;
            $array_datos_ensayos[] = $nombre_ensayo;
            
        }
        return $array_datos_ensayos;
        pg_close($c);
    }
    
    function mostrar_detalle_ensayos_registrados($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_arreglo_ensayos = pg_query("select ensayo_idensayo, tipo, categoria, ensayo, cantidad_ensayo, precio_total_ensayo, tiempo_total, detalle_ensayos.precio_unitario 
                                        from detalle_ensayos, ensayo 
                                        where ensayo_laboratorio_idensayo_laboratorio = $id_proyecto and ensayo_idensayo = idensayo;");
        $array_datos_ensayos = array();
        while ($f = pg_fetch_object($consulta_arreglo_ensayos)) {
            $id_ensayo = $f->ensayo_idensayo;
            $tipo = $f->tipo;
            $categoria = $f->categoria;
            $nombre_ensayo = $f->ensayo;
            $cantidad = $f->cantidad_ensayo;
            $precio = $f->precio_total_ensayo;
            $precio_unitario = $f->precio_unitario;
            $duracion = $f->tiempo_total;
            $array_datos_ensayos[] = $id_ensayo;
            $array_datos_ensayos[] = $tipo;
            $array_datos_ensayos[] = $categoria;
            $array_datos_ensayos[] = $nombre_ensayo;
            $array_datos_ensayos[] = $cantidad;
            $array_datos_ensayos[] = $precio;
            $array_datos_ensayos[] = $precio_unitario;
            $array_datos_ensayos[] = $duracion;
        }
        return $array_datos_ensayos;
        pg_close($c);
    }
    
    function mostrar_suma_total_ensayos($id_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_suma_precios = pg_query("select sum(precio_total_ensayo) from detalle_ensayos where ensayo_laboratorio_idensayo_laboratorio = $id_proyecto;");
        
        $f = pg_fetch_object($consulta_suma_precios);
        $suma_precios = $f->sum;
        
        return $suma_precios;
        pg_close($c);
    }
}
