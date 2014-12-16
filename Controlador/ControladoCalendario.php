<?php
require_once '../Modelo/ModeloCalendario.php';
class ControladoCalendario {
    function mostrar_fechas() {
        $modelo_calendario = new ModeloCalendario();
        return $modelo_calendario->recuperar_fechas();
    }
}
