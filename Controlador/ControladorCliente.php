<?php
require_once '../Modelo/ModeloCliente.php';
class ControladorCliente {
    function cliente_registrado($id_ensayo, $t_proyecto) {
        $modelo_cliente = new ModeloCliente();
        return $modelo_cliente->verificar_cliente_registrado($id_ensayo, $t_proyecto);
    }
    
    function ver_datos_cliente($id_ensayo, $t_proyecto) {
        $modelo_cliente = new ModeloCliente();
        return $modelo_cliente->mostrar_datos_cliente($id_ensayo, $t_proyecto);
    }
}
