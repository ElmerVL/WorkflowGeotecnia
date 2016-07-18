<?php
require_once '../Modelo/ModeloEnsayoLaboratorio.php';

class ControladorInicioCalendario {
    function inicializar_calendario($id_proyecto, $tipo_proyecto) {
        if ($tipo_proyecto == 1) {
            $modelo_ensayo_laboratorio = new ModeloEnsayoLaboratorio();
            $tiempo_estimado = $modelo_ensayo_laboratorio->calcular_suma_tiempo_ensayos($id_proyecto);
            $fecha_inicio = date('Y-m-d');
            $fecha_fin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+$tiempo_estimado, date('Y')));
        } else {
            require_once '../Controlador/ControladorAlcance.php';
            $controlador_alcance = new ControladorAlcance();
            $array_datos_alcance = $controlador_alcance->mostrar_datos_alcance($id_proyecto);
            $tiempo_estimado = $array_datos_alcance[5];
            $fecha_inicio = date('Y-m-d');
            $fecha_fin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+$tiempo_estimado, date('Y')));
        }
        
        require_once '../Modelo/ModeloCalendario.php';
        $modelo_calendario = new ModeloCalendario();
        $modelo_calendario->insertar_fechas($tipo_proyecto, $id_proyecto, $fecha_inicio, $fecha_fin);
    }
}

