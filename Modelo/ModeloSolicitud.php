<?php

require_once '../Controlador/Conexion.php';

class ModeloSolicitud {

    function registrar_solicitud($cliente, $fecha, $ubicacion, $tipo, $id_ingeniero, $id_usuario) {
        if($id_ingeniero == 0){
            header("Location: ../Vista/iuRegistroSolicitud.php");
        }else{
            $con = new Conexion();
            $c = $con->getConection();

            $consulta_id_director = pg_query($c, "select iddirector from director where usuario_idusuario = $id_usuario;");
            $id_conseguido = pg_fetch_object($consulta_id_director);
            $id_director = $id_conseguido->iddirector;
            
            $consulta_id_ingeniero = pg_query($c, "select usuario_idusuario from ingeniero where idingeniero = $id_ingeniero;");
            $id_ing_conseguido = pg_fetch_object($consulta_id_ingeniero);
            $id_usr_ingeniero = $id_ing_conseguido->usuario_idusuario;
            
            pg_query($c, "INSERT INTO solicitud(
            director_iddirector, director_usuario_idusuario, 
            ingeniero_idingeniero, ingeniero_usuario_idusuario, cliente, 
            fecha_solicitud, ubicacion, tipo)
            VALUES ($id_director, $id_usuario, 
            $id_ingeniero, $id_usr_ingeniero,
            '$cliente', '$fecha', '$ubicacion', '$tipo');");
            
            pg_close($c);
        }
    }
    
    function mostrar_lista_solicitudes() {
    $con = new Conexion();
    $c = $con->getConection();

    $consulta = pg_query($c, "select idsolicitud, cliente, ubicacion, tipo, fecha_solicitud, nombres, apellidos
                              from solicitud, ingeniero
                              where ingeniero_idingeniero = idingeniero
                              order by idsolicitud;");
    
    $array_solicitudes = array();
    while ($f = pg_fetch_object($consulta)) {
        
        $id_solicitud = $f->idsolicitud;
        $cliente = $f->cliente;
        $ubicacion = $f->ubicacion;
        $tipo = $f->tipo;
        $fecha_u = $f->fecha_solicitud;
        
        $dia=date("d", strtotime($fecha_u));
        $mes=date("F", strtotime($fecha_u));
        if ($mes=="January") $mes="Ene";
        if ($mes=="February") $mes="Feb";
        if ($mes=="March") $mes="Mar";
        if ($mes=="April") $mes="Abr";
        if ($mes=="May") $mes="May";
        if ($mes=="June") $mes="Jun";
        if ($mes=="July") $mes="Jul";
        if ($mes=="August") $mes="Ago";
        if ($mes=="September") $mes="Sep";
        if ($mes=="October") $mes="Oct";
        if ($mes=="November") $mes="Nov";
        if ($mes=="December") $mes="Dic";
        $anio=date("Y", strtotime($fecha_u));
        $fecha = $dia." - ".$mes.", ".$anio; //date( "d-M, Y", strtotime($fecha_u) );
        $nombres = $f->nombres;
        $apellidos = $f->apellidos;
        
            $array_solicitudes[] = "<a href='#'>".$id_solicitud;
                $array_solicitudes[] = $cliente;
                $array_solicitudes[] = $ubicacion;
                $array_solicitudes[] = $tipo;
                $array_solicitudes[] = $nombres." ".$apellidos;
                $array_solicitudes[] = $fecha;
        }
        return $array_solicitudes;
    pg_close($c);
}

}
