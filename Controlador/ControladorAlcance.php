<?php
require_once '../Modelo/ModeloAlcance.php';

class ControladorAlcance {
    function mostrar_datos_alcance($id_trabajo) {
        $modelo_alcance = new ModeloAlcance();
        //return $modelo_alcance->recu_hola_mi_AMOR_:)
        return $modelo_alcance->recuperar_datos_alcance($id_trabajo);
    }
    
    function alcance_registrado($id_trabajo) {
        $modelo_alcance = new ModeloAlcance();
        return $modelo_alcance->alcance_creado($id_trabajo);
    }
    
    function observacion_registrada($id_trabajo) {
        $modelo_alcance = new ModeloAlcance();
        return $modelo_alcance->verificar_observacion($id_trabajo);
    }
}
