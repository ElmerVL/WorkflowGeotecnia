<?php
require_once '../Modelo/ModeloProyecto.php';
class ControladorProyecto {
    
    function revisar_habilitado_el($id_proyecto) {
        $modelo_proyecto = new ModeloProyecto();
        $habilitado = $modelo_proyecto->verificar_proyecto_habilitado_el($id_proyecto);
        return $habilitado;
    }
    
    function revisar_habilitado_tc($id_proyecto) {
        $modelo_proyecto = new ModeloProyecto();
        $habilitado = $modelo_proyecto->verificar_proyecto_habilitado_tc($id_proyecto);
        return $habilitado;
    }
    
    function conseguir_cod_solicitud_tc($id_proyecto) {
        $modelo_proyecto = new ModeloProyecto();
        $cod_solicitud = $modelo_proyecto->mostrar_cod_solicitud_tc($id_proyecto);
        return $cod_solicitud;
    }
    
    function conseguir_cod_solicitud_el($id_proyecto) {
        $modelo_proyecto = new ModeloProyecto();
        $cod_solicitud = $modelo_proyecto->mostrar_cod_solicitud_el($id_proyecto);
        return $cod_solicitud;
    }
    
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
    
    function mostrar_codigos_proyectos($filtro){
        $modelo_solicitud = new ModeloProyecto();
        if($filtro==0){
            $ensayos_laboratorio = $modelo_solicitud->mostrar_lista_e_l();
            $trabajos_campo = $modelo_solicitud->mostrar_lista_t_c();
            $resultado = array_merge($ensayos_laboratorio, $trabajos_campo);
        }elseif ($filtro==1) {
            $resultado = $modelo_solicitud->mostrar_lista_e_l();
        }elseif ($filtro==2) {
            $resultado = $modelo_solicitud->mostrar_lista_t_c();
        }
        return $resultado;
    }
    
    
    function mostrar_estado_ensayos_laboratorio(){
        $modelo_solicitud = new ModeloProyecto();
        $resultado = $modelo_solicitud->mostrar_lista_estado_ensayo_laboratorio();
        return $resultado;
    }

    function mostrar_estado_trabajos_campo(){
        $modelo_solicitud = new ModeloProyecto();
        $resultado = $modelo_solicitud->mostrar_lista_estado_trabajo_campo();
        return $resultado;
    }
    
    function mostrar_codigos_ensayos($id_solicitud){
        $modelo_solicitud = new ModeloProyecto();
        $resultado = $modelo_solicitud->mostrar_lista_ensayos($id_solicitud);
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
