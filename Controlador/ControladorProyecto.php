<?php
require_once '../Modelo/ModeloProyecto.php';
class ControladorProyecto {
    function mostrar_tabla($filtro){
        $modelo_solicitud = new ModeloProyecto();
        if($filtro==0){
            $ensayos_laboratorio = $modelo_solicitud->mostrar_lista_proyectos_e_l();
            $trabajos_campo = $modelo_solicitud->mostrar_lista_proyectos_t_c();
            $resultado = array_merge($ensayos_laboratorio, $trabajos_campo);
        }elseif ($filtro==1) {
            $resultado = $modelo_solicitud->mostrar_lista_proyectos_e_l();
        }elseif ($filtro==2) {
            $resultado = $modelo_solicitud->mostrar_lista_proyectos_t_c();
        }
        return $resultado;
    }
    
    function mostrar_tabla_ingeniero($filtro, $id_usuario){
        $modelo_solicitud = new ModeloProyecto();
        if($filtro==0){
            $ensayos_laboratorio = $modelo_solicitud->mostrar_lista_proyectos_e_l_ingeniero($id_usuario);
            $trabajos_campo = $modelo_solicitud->mostrar_lista_proyectos_t_c_ingeniero($id_usuario);
            $resultado = array_merge($ensayos_laboratorio, $trabajos_campo);
        }elseif ($filtro==1) {
            $resultado = $modelo_solicitud->mostrar_lista_proyectos_e_l_ingeniero($id_usuario);
        }elseif ($filtro==2) {
            $resultado = $modelo_solicitud->mostrar_lista_proyectos_t_c_ingeniero($id_usuario);
        }
        return $resultado;
    }
    
    function mostrar_datos_e_l($id_proyecto) {
        $modelo_proyecto = new ModeloProyecto();
        $arreglo_datos = $modelo_proyecto->mostrar_datos_proyecto_e_l($id_proyecto);
        return $arreglo_datos;
    }
    
    function mostrar_datos_t_c($id_proyecto) {
        $modelo_proyecto = new ModeloProyecto();
        $arreglo_datos = $modelo_proyecto->mostrar_datos_proyecto_t_c($id_proyecto);
        return $arreglo_datos;
    }
}
