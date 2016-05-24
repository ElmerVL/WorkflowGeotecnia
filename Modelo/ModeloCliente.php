<?php
require_once '../Controlador/Conexion.php';
require_once '../Modelo/ModeloEnsayoLaboratorio.php';
class ModeloCliente {
    function ingresar_datos_cliente($id_ensayo, $nombre_factura,
            $nit_ci, $nombre_contacto, $telefono_fijo, $telefono_celular, $correo, $direccion, $tipo_cliente, $t_proyecto, $ci_contacto) {
        $con = new Conexion();
        $c = $con->getConection();
        $modelo_cliente = new ModeloCliente();
        $id_cliente = $modelo_cliente->mostrar_cantidad() + 1;
        pg_query($c, "INSERT INTO cliente(idcliente,
            nombre_factura, nit_ci, nombre_contacto, telefono_fijo, 
            telefono_celular, correo, direccion_fiscal, tipo_cliente, ci_contacto)
            VALUES ($id_cliente, '$nombre_factura', $nit_ci, '$nombre_contacto', $telefono_fijo, $telefono_celular, 
                    '$direccion', '$correo', '$tipo_cliente', $ci_contacto);");
        if($t_proyecto == 'ensayo de laboratorio')
            $modelo_cliente->registrar_formulario($id_ensayo, $id_cliente);
        else
            $modelo_cliente->registrar_formulario_tc($id_ensayo, $id_cliente);
    }
    
    function mostrar_cantidad() {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_numero = pg_query($c, "select count(*) from cliente;");
        $f = pg_fetch_object($consulta_numero);
        $cantidad = $f->count;        
        return $cantidad;
        pg_close($c);
    }
    
    function registrar_formulario($id_ensayo, $id_cliente) {
        $con = new Conexion();
        $c = $con->getConection();
        $consulta_ids_detalle_ensayos = pg_query($c, "select iddetalle_ensayos from detalle_ensayos where ensayo_laboratorio_idensayo_laboratorio = $id_ensayo;");
        while ($f = pg_fetch_object($consulta_ids_detalle_ensayos)) {
            $id_detalle = $f->iddetalle_ensayos;
            $consulta_datos_detalle = pg_query($c, "select ensayo_laboratorio_solicitud_ingeniero_usuario_idusuario, 
                                                        ensayo_laboratorio_solicitud_ingeniero_idingeniero, 
                                                        ensayo_laboratorio_solicitud_director_usuario_idusuario, 
                                                        ensayo_laboratorio_solicitud_director_iddirector, 
                                                        ensayo_laboratorio_solicitud_idsolicitud, ensayo_idensayo
                                                    from detalle_ensayos where iddetalle_ensayos = $id_detalle;");
            $f_de = pg_fetch_object($consulta_datos_detalle);
            $usr_ingeniero = $f_de->ensayo_laboratorio_solicitud_ingeniero_usuario_idusuario;
            $id_ingeniero = $f_de->ensayo_laboratorio_solicitud_ingeniero_idingeniero; 
            $usr_director = $f_de->ensayo_laboratorio_solicitud_director_usuario_idusuario;
            $id_director = $f_de->ensayo_laboratorio_solicitud_director_iddirector;
            $id_solicitud = $f_de->ensayo_laboratorio_solicitud_idsolicitud;
            $cod_ensayo = $f_de->ensayo_idensayo;
            
            pg_query($c, "INSERT INTO formulario_el(
                                cliente_idcliente, detalle_ensayos_ensayo_laboratorio_idensayo_laboratorio, 
                                detalle_ensayos_ensayo_laboratorio_solicitud_ingeniero_usuario_, 
                                detalle_ensayos_ensayo_laboratorio_solicitud_ingeniero_idingeni, 
                                detalle_ensayos_ensayo_laboratorio_solicitud_director_usuario_i, 
                                detalle_ensayos_ensayo_laboratorio_solicitud_director_iddirecto, 
                                detalle_ensayos_ensayo_laboratorio_solicitud_idsolicitud, detalle_ensayos_ensayo_idensayo, 
                                detalle_ensayos_iddetalle_ensayos, formulario_registrado)
                            VALUES ($id_cliente, $id_ensayo, 
                                    $usr_ingeniero, 
                                    $id_ingeniero, 
                                    $usr_director, 
                                    $id_director, 
                                    $id_solicitud, '$cod_ensayo', 
                                    $id_detalle, true);");
        }
        pg_close($c);
    }
    
    function registrar_formulario_tc($id_trabajo, $id_cliente) {
        $con = new Conexion();
        $c = $con->getConection();
        
            $consulta_datos_trabajo = pg_query($c, "select solicitud_ingeniero_usuario_idusuario, solicitud_ingeniero_idingeniero, solicitud_director_usuario_idusuario, solicitud_director_iddirector, solicitud_idsolicitud 
                    from trabajo_campo
                    where idtrabajo_campo = $id_trabajo;");
            $f = pg_fetch_object($consulta_datos_trabajo);
            $usr_ingeniero = $f->solicitud_ingeniero_usuario_idusuario;
            $id_ingeniero = $f->solicitud_ingeniero_idingeniero; 
            $usr_director = $f->solicitud_director_usuario_idusuario;
            $id_director = $f->solicitud_director_iddirector;
            $id_solicitud = $f->solicitud_idsolicitud;
            
            pg_query($c, "INSERT INTO formulario_tc(
            trabajo_campo_solicitud_idsolicitud, trabajo_campo_solicitud_director_iddirector, 
            trabajo_campo_solicitud_director_usuario_idusuario, trabajo_campo_solicitud_ingeniero_idingeniero, 
            trabajo_campo_solicitud_ingeniero_usuario_idusuario, trabajo_campo_idtrabajo_campo, 
            cliente_idcliente, formulario_registrado)
                        VALUES ($id_solicitud, $id_director, 
                                $usr_director, $id_ingeniero, 
                                $usr_ingeniero, $id_trabajo, 
                                $id_cliente, true);");
        pg_close($c);
    }
    
    function verificar_cliente_registrado($id_ensayo, $t_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        
        if($t_proyecto == 1){
            $fila_cliente = pg_query($c, "select count(*) from formulario_el where detalle_ensayos_ensayo_laboratorio_idensayo_laboratorio = $id_ensayo;");
            $cant_fila_conseguida = pg_fetch_object($fila_cliente);
            $cant = $cant_fila_conseguida->count;
        }else{
            $fila_cliente = pg_query($c, "select count(*) from formulario_tc where trabajo_campo_idtrabajo_campo = $id_ensayo;");
            $cant_fila_conseguida = pg_fetch_object($fila_cliente);
            $cant = $cant_fila_conseguida->count;
        }
        if($cant > 0)
            return TRUE;
        else
            return FALSE;
        pg_close($c);
    }
    
    function mostrar_datos_cliente($id_ensayo, $tipo_proyecto) {
        $con = new Conexion();
        $c = $con->getConection();
        if($tipo_proyecto == 1){
        $consulta_arreglo_cliente = pg_query("select distinct tipo_cliente, nombre_factura, 
                                                            nit_ci, nombre_contacto, telefono_fijo, telefono_celular, correo, 
                                                            direccion_fiscal, ci_contacto
                                                from cliente, formulario_EL 
                                                where detalle_ensayos_ensayo_laboratorio_idensayo_laboratorio = $id_ensayo "
                . "                                         and cliente_idcliente = idcliente;");
        }else{
            $consulta_arreglo_cliente = pg_query("select distinct tipo_cliente, nombre_factura, 
                                                            nit_ci, nombre_contacto, telefono_fijo, telefono_celular, correo, 
                                                            direccion_fiscal, ci_contacto
                                                from cliente, formulario_TC 
                                                where trabajo_campo_idtrabajo_campo = $id_ensayo
                                                and cliente_idcliente = idcliente;");
        }
         $array_datos_cliente = array();
        while ($f = pg_fetch_object($consulta_arreglo_cliente)) {
            $tipo_cliente = $f->tipo_cliente;
            $nombre_factura = $f->nombre_factura;
            $nit_ci = $f->nit_ci;
            $nombre_contacto = $f->nombre_contacto;
            $telefono_fijo = $f->telefono_fijo;
            $telefono_celular = $f->telefono_celular;
            $correo = $f->correo;
            $direccion_fiscal = $f->direccion_fiscal;
            $ci_contacto = $f->ci_contacto;
            $array_datos_cliente[] = $tipo_cliente;
            $array_datos_cliente[] = $nombre_factura;
            $array_datos_cliente[] = $nit_ci;
            $array_datos_cliente[] = $nombre_contacto;
            $array_datos_cliente[] = $telefono_fijo;
            $array_datos_cliente[] = $telefono_celular;
            $array_datos_cliente[] = $correo;
            $array_datos_cliente[] = $direccion_fiscal;
            $array_datos_cliente[] = $ci_contacto;
        }
        return $array_datos_cliente;
        pg_close($c);
    }
    
}