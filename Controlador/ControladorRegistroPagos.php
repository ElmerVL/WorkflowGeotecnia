<?php
$id_proyecto = $_GET['i_p'];
$tipo_proyecto = $_GET['t'];

require_once '../Modelo/ModeloPago.php';
require_once '../Controlador/ControladorProyecto.php';
require_once '../Controlador/ControladorInicioCalendario.php';
if ($tipo_proyecto == 1) {
    require_once '../Controlador/ControladorEnsayoLaboratorio.php';
    $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
    $precio = $controlador_ensayo_laboratorio->sumar_costo_ensayos($id_proyecto);
} else {
    require_once '../Controlador/ControladorAlcance.php';
    $controlador_alcance = new ControladorAlcance();
    $array_datos_alcance = $controlador_alcance->mostrar_datos_alcance($id_proyecto);
    $precio = $array_datos_alcance[6];
    $precio = $precio + $precio * 0.13;
}

require_once '../Controlador/ControladorCliente.php';
$controlador_cliente = new ControladorCliente();
$arreglo_datos_cliente = $controlador_cliente->ver_datos_cliente($id_proyecto, $tipo_proyecto);
$tipo_institucion = $arreglo_datos_cliente[0];

$modelo_pago = new ModeloPago();

if(!$modelo_pago->verificar_anticipo_pagado($id_proyecto, $tipo_proyecto)) {
    if($precio <= 10000 && $tipo_institucion == 'privada' && $tipo_proyecto == 1){
        $nro_orden_pago = $_POST['nro_100_anticipo'];
        $nro_factura_pago = $_POST['fac_100_anticipo'];
        $modelo_pago->insertar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 100, $precio, 100, 0);
        $modelo_pago->actualizar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 0, 0);
    }elseif ($precio > 10000 && $tipo_institucion == 'privada' && $tipo_proyecto == 1) {
        $nro_orden_pago = $_POST['nro_50_anticipo'];
        $nro_factura_pago = $_POST['fac_50_anticipo'];
        $modelo_pago->insertar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 50, ($precio*0.5), 50, 50);
    }elseif($tipo_institucion == 'privada' && $tipo_proyecto == 2){
        $nro_orden_pago = $_POST['nro_50_anticipo'];
        $nro_factura_pago = $_POST['fac_50_anticipo'];
        $modelo_pago->insertar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 50, ($precio*0.5), 50, 50);
    }elseif($precio <= 10000 && $tipo_institucion == 'estatal' && $tipo_proyecto == 1){
        $nro_orden_pago = $_POST['nro_100_anticipo'];
        $nro_factura_pago = $_POST['fac_100_anticipo'];
        $modelo_pago->insertar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 100, $precio, 100, 0);
        $modelo_pago->actualizar_estado_pago($id_proyecto, $nro_orden_pago, $nro_factura_pago, 0, 0);
    }elseif ($precio > 10000 && $tipo_institucion == 'estatal' && $tipo_proyecto == 1) {
        $nro_orden_pago = $_POST['nro_20_anticipo'];
        $nro_factura_pago = $_POST['fac_20_anticipo'];
        $modelo_pago->insertar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 20, ($precio*0.2), 20, 80);
    }elseif ($tipo_institucion == 'estatal' && $tipo_proyecto == 2) {
        $nro_orden_pago = $_POST['nro_20_anticipo'];
        $nro_factura_pago = $_POST['fac_20_anticipo'];
        $modelo_pago->insertar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 20, ($precio*0.2), 20, 80);
    }
    $controlador_calendario = new ControladorInicioCalendario();
    $controlador_calendario->inicializar_calendario($id_proyecto, $tipo_proyecto);
    header("Location: ../Vista/iuRegistroPago.php?i_p=$id_proyecto&t=$tipo_proyecto&t_i=$tipo_institucion");
}else{
    if ($precio > 10000 && $tipo_institucion == 'privada' && $tipo_proyecto == 1) {
        echo $nro_orden_pago = $_POST['nro_50_saldo'];
        echo $nro_factura_pago = $_POST['fac_50_saldo'];
        $modelo_pago->actualizar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 50, ($precio*0.5));
    }elseif($tipo_institucion == 'privada' && $tipo_proyecto == 2){
        echo $nro_orden_pago = $_POST['nro_50_anticipo'];
        echo $nro_factura_pago = $_POST['fac_50_anticipo'];
        $modelo_pago->actualizar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 50, ($precio*0.5));
    }elseif ($precio > 10000 && $tipo_institucion == 'estatal' && $tipo_proyecto == 1) {
        echo $nro_orden_pago = $_POST['nro_20_anticipo'];
        echo $nro_factura_pago = $_POST['fac_20_anticipo'];
        $modelo_pago->actualizar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 80, ($precio*0.8));
    }elseif ($tipo_institucion == 'estatal' && $tipo_proyecto == 2) {
        echo $nro_orden_pago = $_POST['nro_20_anticipo'];
        echo $nro_factura_pago = $_POST['fac_20_anticipo'];
        $modelo_pago->actualizar_estado_pago($tipo_proyecto, $id_proyecto, $nro_orden_pago, $nro_factura_pago, 80, ($precio*0.8));
    }
    header("Location: ../Vista/iuRegistroPago.php?i_p=$id_proyecto&t=$tipo_proyecto&t_i=$tipo_institucion");
}