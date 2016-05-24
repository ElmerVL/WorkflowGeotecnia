<?php
echo $id_ensayo = $_GET['i_p'];
echo "<br />";
echo $tipo_proyecto = $_POST['tipo_proyecto'];
echo "<br />";
echo $tipo_institucion = $_POST['cbox_tipo_institucion'];
echo "<br />";
echo $nombre_factura = $_POST['nombre_factura'];
echo "<br />";
echo $nit_ci = $_POST["nit_ci"];
echo "<br />";
echo $nombre_contacto = $_POST["nombre_contacto"];
echo "<br />";
echo $ci_contacto = $_POST["ci_contacto"];
echo "<br />";
echo $telefono_fijo = $_POST["telefono_fijo"];
echo "<br />";
echo $telefono_celular = $_POST["telefono_celular"];
echo "<br />";
echo $correo = $_POST["correo"];
echo "<br />";
echo $direccion = $_POST["direccion"];
echo "<br />";
require_once 'ControladorCliente.php';
$controlador_cliente = new ControladorCliente();
if($tipo_proyecto == 'ensayo de laboratorio' && $controlador_cliente->cliente_registrado($id_ensayo, $tipo_proyecto)){
    $f_registrado = $_POST["f_recibido"];
    echo "<br />";
    if($f_registrado){
        header("Location: ../Vista/iuRegistroCliente.php?i_p=$id_ensayo");
    }
}
echo $precio = $_POST["precio"];

require_once '../Modelo/ModeloCliente.php';
$modelo_cliente = new ModeloCliente();
$modelo_cliente->ingresar_datos_cliente($id_ensayo, $nombre_factura, $nit_ci, $nombre_contacto, $telefono_fijo, $telefono_celular, $correo, $direccion, $tipo_institucion, $tipo_proyecto, $ci_contacto);

require_once '../Controlador/ControladorCuantias.php';
$controlador_cuantias = new ControladorCuantias();

if($precio <= 5000 && $tipo_institucion == 'privada' && $tipo_proyecto == 'ensayo de laboratorio'){
    $controlador_cuantias->generar_formulario($id_ensayo, 1);
}elseif ($precio > 5000 && $tipo_institucion == 'privada' && $tipo_proyecto == 'ensayo de laboratorio' && !$f_registrado) {
    $controlador_cuantias->generar_formulario($id_ensayo, 1);
}elseif($tipo_institucion == 'privada' && $tipo_proyecto == 'trabajo de campo'){
    $controlador_cuantias->generar_formulario($id_ensayo, 2);
}elseif($precio <= 5000 && $tipo_institucion == 'estatal' && $tipo_proyecto == 'ensayo de laboratorio' && !$f_registrado){
    $controlador_cuantias->generar_formulario($id_ensayo, 1);
}elseif ($precio > 5000 && $tipo_institucion == 'estatal' && $tipo_proyecto == 'ensayo de laboratorio' && !$f_registrado) {
    $controlador_cuantias->generar_formulario($id_ensayo, 1);
}elseif ($tipo_institucion == 'estatal' && $tipo_proyecto == 'trabajo de campo') {
    $controlador_cuantias->generar_formulario($id_ensayo, 2);
}
