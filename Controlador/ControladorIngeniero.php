<?php
require_once '../Modelo/ModeloIngeniero.php';
class ControladorIngeniero {
    function lista_ingenieros() {
        echo "entra aqui";
        $modelo_ingeniero = new ModeloIngeniero();
        $modelo_ingeniero->mostrar_lista_ingenieros();
    }
}
