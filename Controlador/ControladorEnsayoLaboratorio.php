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
}
