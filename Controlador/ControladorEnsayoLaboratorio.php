<?php
require_once '../Modelo/ModeloEnsayoLaboratorio.php';
class ControladorEnsayoLaboratorio {
    function recuperar_tipo_trabajo($id_ensayo) {
        $ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $tipo_trabajo = $ensayo_laboratorio->mostrar_tipo_trabajo($id_ensayo);
        return $tipo_trabajo;
    }
    
    function mostrar_tabla_ensayo_categoria($tipo, $categoria) {
        $ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $ensayos = $ensayo_laboratorio->mostrar_ensayos_categorizado($tipo, $categoria);
        return $ensayos;
    }
    
    function mostrar_detalle_ensayos_registrados($id_proyecto) {
        $ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $datos_ensayos = $ensayo_laboratorio->mostrar_detalle_ensayos_registrados($id_proyecto);
        return $datos_ensayos;
    }
    
    function mostrar_detalle_ensayos_registrados_resumido($id_proyecto) {
        $ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $datos_ensayos = $ensayo_laboratorio->mostrar_resumen_detalle_ensayos_registrados($id_proyecto);
        return $datos_ensayos;
    }
    
    function sumar_costo_ensayos($id_proyecto) {
        $ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $suma_ensayos = $ensayo_laboratorio->mostrar_suma_total_ensayos($id_proyecto);
        return $suma_ensayos;
    }
    
    function calcular_tiempo_proximado_ensayos($id_proyecto) {
        $ensayo_laboratorio = new ModeloEnsayoLaboratorio();
        $tiempo_total = $ensayo_laboratorio->calcular_suma_tiempo_ensayos($id_proyecto);
        return $tiempo_total;
    }
}
