<?php
require_once '../Modelo/ModeloProyecto.php';
$modelo_proyecto = new ModeloProyecto();

$funcion = $_GET['f'];
$tipo = $_GET['t_p'];
$id_proyecto = $_POST['cod_proyecto'];



switch ($funcion) {
    case 0:
        header("Location: ../Vista/iuRegistroEnsayos.php?i_p=$id_proyecto&f_t=1");
        echo "funcion".$funcion.$cod_proyecto;
        break;
    case 1:
        header("Location: ../Vista/iuRegistroMuestra.php?i_p=$id_proyecto");
        echo "funcion".$funcion.$cod_proyecto;
        break;
    case 2:
        header("Location: ../Vista/iuConfirmacionEnsayos.php?i_p=$id_proyecto");
        echo "funcion".$funcion.$cod_proyecto;
        break;
    case 3:
        header("Location: ../Vista/iuCrearAlcanceP1.php?i_p=$id_proyecto");
        echo "funcion".$funcion.$cod_proyecto;
        break;
    case 4:
        header("Location: ../Vista/iuInformacionAlcance.php?i_p=$id_proyecto&o=f");
        echo "funcion".$funcion.$cod_proyecto;
        break;
    case 5:
        header("Location: ../Vista/iuRegistroResultados.php?i_p=$id_proyecto&t_p=$tipo");
        echo "funcion".$funcion.$cod_proyecto;
        break;
    case 6:
        header("Location: ../Vista/iuRegistroCliente.php?i_p=$id_proyecto&t=$tipo");
        echo "funcion".$funcion.$cod_proyecto;
        break;
    case 7:
        header("Location: ../Vista/iuRegistroPago.php?i_p=$id_proyecto&t=$tipo");
        echo "funcion".$funcion.$cod_proyecto;
        break;
}