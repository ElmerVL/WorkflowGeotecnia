<?php
session_start();
$rol = $_SESSION['rol'];
$i_u = $_SESSION['id_usuario'];
if (!$i_u) {
    header("Location: ../index.php");
} else {
    if ($rol != 3) {
        session_destroy();
        header("Location: ../index.php");
    }
}
?>
<!DOCTYPE html >
<head>
    <title>WORKFLOW</title>
    <link rel="shortcut icon" href="../Vista/img/icono">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="copyright" content="" />	  
    <meta name="revisit-after" content="3 days" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="js/custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
    <link href="js/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="../Vista/js/jquery-1.3.2.min.js" type="text/javascript"></script>
        <script>
        setInterval(function() {
            $("#noticias").load(location.href+" #noticias>*","");
        }, 4000);
        </script>
</head>

<body>
    <ul class="hide"><li><a href="#body">Skip to content</a></li></ul>
    <div id="container">
        <div id="header">
            <h1><a href="iuAdministrador.php">Laboratorio de <span>Geotecnia</span></a></h1>		
        </div>

        <div id="body">
            <ul id="nav">
                <?php
                if($rol == 1){
                ?>
                <li class="on"><a href="iuAdministrador.php">Principal</a></li>
                <?php
                }
                if($rol == 2){
                ?>
                <li class="on"><a href="iuDirector.php">Principal</a></li>
                <?php
                }
                if($rol == 3){
                ?>
                <li class="on"><a href="iuContador.php">Principal</a></li>
                <?php
                }
                if($rol == 4){
                ?>
                <li class="on"><a href="iuIngeniero.php">Principal</a></li>
                <?php
                }
                if($rol == 5){
                ?>
                <li class="on"><a href="iuAuxiliar.php">Principal</a></li>
                <?php
                }
                if($rol == 6){
                ?>
                <li class="on"><a href="iuTecnico.php">Principal</a></li>
                <?php
                }
                ?>
                <li class="on"><a href="iuCalendario.php">Calendario</a></li>
                <li class="on"><a href="iuWorkFlow.php">Workflow</a></li>
            </ul>
            <div id="content"><div>
                    <div id="main">
                        <h2>Registro de pagos</h2>
                        <?php
                        $id_proyecto = $_GET['i_p'];
                        $tipo_proyecto = $_GET['t'];

                        require_once '../Controlador/ControladorCliente.php';
                        $controlador_cliente = new ControladorCliente();
                        $arreglo_datos_cliente = $controlador_cliente->ver_datos_cliente($id_proyecto, $tipo_proyecto);
                        
                        if(empty($arreglo_datos_cliente)){
                            echo "CLIENTE AUN NO REGISTRADO. <br /> REGISTRE AL CLIENTE.";
                        }else{
                        $tipo_institucion = $arreglo_datos_cliente[0];

                        require_once '../Controlador/ControladorProyecto.php';
                        $controlador_proyecto = new ControladorProyecto();
                        if($tipo_proyecto == 1){
                            $arreglo_datos = $controlador_proyecto->mostrar_datos_e_l($id_proyecto);
                            $habilitado = $controlador_proyecto->revisar_habilitado_el($id_proyecto);
                        }else{
                            $arreglo_datos = $controlador_proyecto->mostrar_datos_t_c($id_proyecto);
                            $habilitado = $controlador_proyecto->revisar_habilitado_tc($id_proyecto);
                        }
                        
                        if($habilitado == 't'){
                        ?>
                        <ul>
                            <form method="post" action="../Controlador/ControladorRegistroPagos.php?i_p=<?php echo $id_proyecto; ?>&t=<?php echo $tipo_proyecto; ?>" >
                                <div class="text_box">
                                    <br />
                                    <h4>Nombre del proyecto:</h4>
                                    <h6><?php echo $arreglo_datos[0]; ?></h6>
                                    <br />
                                    <br />
                                    <h4>Facturación a nombre de:</h4>
                                    <h6><?php echo $arreglo_datos_cliente[1]; ?></h6>
                                    <br />
                                    <br />
                                    <h4>N° de NIT o N° de CI:</h4>
                                    <h6><?php echo $arreglo_datos_cliente[2]; ?></h6>
                                    <br />
                                    <br />
                                    <h4>Nombre de la persona de contacto:</h4>
                                    <h6><?php echo $arreglo_datos_cliente[3]; ?></h6>
                                    <br />
                                    <br />
                                    <h4>Fecha de la solicitud:</h4>
                                    <?php
                                    $dia = date("d", strtotime($arreglo_datos[4]));
                                    $mes = date("F", strtotime($arreglo_datos[4]));
                                    if ($mes == "January")
                                        $mes = "Enero";
                                    if ($mes == "February")
                                        $mes = "Febrero";
                                    if ($mes == "March")
                                        $mes = "Marzo";
                                    if ($mes == "April")
                                        $mes = "Abril";
                                    if ($mes == "May")
                                        $mes = "Mayo";
                                    if ($mes == "June")
                                        $mes = "Junio";
                                    if ($mes == "July")
                                        $mes = "Julio";
                                    if ($mes == "August")
                                        $mes = "Agosto";
                                    if ($mes == "September")
                                        $mes = "Septiembre";
                                    if ($mes == "October")
                                        $mes = "Octubre";
                                    if ($mes == "November")
                                        $mes = "Noviembre";
                                    if ($mes == "December")
                                        $mes = "Diciembre";
                                    $anio = date("Y", strtotime($arreglo_datos[4]));
                                    ?>
                                    <h6><?php echo $dia . " de " . $mes . ", " . $anio ?></h6>
                                    <br /><br />
                                    <a type='button' class='btn2' name='submit' href="../Controlador/ControladorVerCompromisoPago.php?i_p=<?php echo $id_proyecto; ?>"> Ver formulario </a>
                                    <br />
                                    <br />
                                    
                                    <?php
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
                                    ?>
                                    
                                    COSTO TOTAL DEL PROYECTO:
                                    <br /><br />
                                    <h3><?php echo $precio; ?> bolivianos</h3>
                                    <br />
                                    
                                    <?php
                                    require_once '../Modelo/ModeloPago.php';
                                    $modelo_pago = new ModeloPago();
                                    
                                    if ($tipo_proyecto == 1) {
                                        require_once '../Controlador/ControladorEnsayoLaboratorio.php';
                                        $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
                                        $array_ensayos = $controlador_ensayo_laboratorio->mostrar_detalle_ensayos_registrados($id_proyecto);
                                        ?>

                                        <?php
                                        if ($precio <= 10000 && $tipo_institucion == 'privada') {
                                            if (!$modelo_pago->verificar_anticipo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución privada y el monto a cancelar es menor a 10000 bolivianos. Registrar el pago del 100% del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 100% <input type="text" name="nro_100_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 100% <input type="text" name="fac_100_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } else {
                                                ?>
                                                <br/><br/>
                                                <h3>CANCELADO</h3>
                                                <br/>
                                                <?php
                                            }
                                        } elseif ($precio > 10000 && $tipo_institucion == 'privada') {
                                            if (!$modelo_pago->verificar_anticipo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución privada y el monto a cancelar es mayor a 10000 bolivianos. Registrar el pago del 50% de anticipo del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 50% anticipo <input type="text" name="nro_50_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 50%  <input type="text" name="fac_50_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } elseif (!$modelo_pago->verificar_saldo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución privada y el monto a cancelar es mayor a 10000 bolivianos. Registrar el pago del 50% de saldo del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 50% saldo <input type="text" name="nro_50_saldo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 50%  <input type="text" name="fac_50_saldo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } else {
                                                ?>
                                                <br/><br/>
                                                <h3>CANCELADO</h3>
                                                <br/>
                                                <?php
                                            }
                                        } elseif ($precio <= 10000 && $tipo_institucion == 'estatal') {
                                            if (!$modelo_pago->verificar_anticipo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución estatal y el monto a cancelar es menor a 10000 bolivianos. Registrar el pago del 100% del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 100% <input type="text" name="nro_100_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 100% <input type="text" name="fac_100_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } else {
                                                ?>
                                                <br/><br/>
                                                <h3>CANCELADO</h3>
                                                <br/>
                                             <?php
                                            }
                                        } elseif ($precio > 10000 && $tipo_institucion == 'estatal') {
                                            if (!$modelo_pago->verificar_anticipo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución estatal y el monto a cancelar es mayor a 10000 bolivianos. Registrar el pago del 20% de anticipo del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 20% anticipo <input type="text" name="nro_20_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 20%  <input type="text" name="fac_20_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } elseif (!$modelo_pago->verificar_saldo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución estatal y el monto a cancelar es mayor a 10000 bolivianos. Registrar el pago del 80% de saldo del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 80% saldo <input type="text" name="nro_80_saldo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 20%  <input type="text" name="fac_80_saldo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } else {
                                                ?>
                                                <br/><br/>
                                                <h3>CANCELADO</h3>
                                                <br/>
                                                <?php
                                            }
                                        } 
                                    } elseif ($tipo_proyecto == 2) {
                                        if ($tipo_institucion == 'privada') {
                                            if (!$modelo_pago->verificar_anticipo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución privada y es un estudio geotécnico(trabajo de campo). Registrar el pago del 50% de anticipo del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 50% anticipo <input type="text" name="nro_50_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 50%  <input type="text" name="fac_50_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } elseif (!$modelo_pago->verificar_saldo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución privada y es un estudio geotécnico(trabajo de campo). Registrar el pago del 50% de saldo del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 50% saldo <input type="text" name="nro_50_saldo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 50%  <input type="text" name="fac_50_saldo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } else {
                                                ?>
                                                <br/><br/>
                                                <h3>CANCELADO</h3>
                                                <br/>
                                                <?php
                                            }
                                        } elseif ($tipo_institucion == 'estatal') {
                                            if (!$modelo_pago->verificar_anticipo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución estatal y es un estudio geotécnico(trabajo de campo). Registrar el pago del 20% de anticipo del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 20% anticipo <input type="text" name="nro_20_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 20%  <input type="text" name="fac_20_anticipo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } elseif (!$modelo_pago->verificar_saldo_pagado($id_proyecto, $tipo_proyecto)) {
                                                ?>
                                                <h6>Se trata de una institución estatal y es un estudio geotécnico(trabajo de campo). Registrar el pago del 80% de saldo del monto total.</h6>
                                                <br/><br/>
                                                <h4>Nro. de orden de pago - 80% saldo <input type="text" name="nro_80_saldo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <h4>Nro. de factura FCYT - 20%  <input type="text" name="fac_80_saldo" style="width: 72px; height: 22px; "/></h4>
                                                <br/>
                                                <input type='submit' class='btn2' value='   Registrar   ' />
                                                <?php
                                            } else {
                                                ?>
                                                <br/><br/>
                                                <h3>CANCELADO</h3>
                                                <br/>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </form>
                        </ul>
                        <?php 

                        }else{
                            echo "Proyecto No Habilitado por el Director";
                        }
                    }
                        ?>
                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
                            <?php
                            if ($rol == 3) {
                                ?>
                                <li><a href='iuRegistroSolicitud.php'>NUEVA SOLICITUD</a></li>
                                <?php
                            }
                            if ($rol == 2) {
                                ?>
                                <li><a href='iuFiltroReporte.php'>REPORTES</a></li>
                                <?php
                            }
                            ?>
                            <li><a href="iuTablaProyectos.php?f=0">PROYECTOS</a></li>
                            <li><a href="iuCalendario.php">CALENDARIO</a></li>
                            <li><a href="../Controlador/ControladorFinalizarSesion.php">CERRAR SESION</a></li>
                        </ul>
                    </div>
                    <div id="noticias" style="background-color: lightsalmon;">
                            <h2>ULTIMO</h2>
                            <?php
                                require_once '../Controlador/ControladorUltimo.php';
                                $controlador_ultimo = new ControladorUltimo();
                                $lista = $controlador_ultimo->mostrar_10_filas();
                                $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            echo $lista[$contador + 3]."</br>";
                                            $contador = $contador+4;
                                        }
                            ?>
			</div>
                </div></div>	
        </div>

        <div id="footer">
            <p class="left">&copy; 2014 Jimena Salazar Soto</p>
        </div>	
    </div>	
</body>
</html>
