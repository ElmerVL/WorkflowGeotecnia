<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorWorkflow
 *
 * @author VAIO
 */
require_once '../Modelo/ModeloWorkflow.php';
class ControladorWorkflow {
    function mostrar_solicitudes() {
        $modelo_workflow = new ModeloWorkflow();
        return $modelo_workflow->consultar_solicitudes();
    }
    
    function mostrar_alcances_NC() {
        $modelo_workflow = new ModeloWorkflow();
        return $modelo_workflow->consultar_alcances_NC();
    }
}
