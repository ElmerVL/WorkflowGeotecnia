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
                        <h2>Registro del cliente</h2>
                        <?php
                        $id_proyecto = $_GET['i_p'];
                        $t_p = $_GET['t'];
                        if ($t_p == 1) {
                            ?>


                            <ul>
                                <form method="post" action="<?php echo "../Controlador/ControladorRegistroCliente.php?i_p=$id_proyecto"; ?>" >

                                    <?php
                                    require_once '../Controlador/ControladorProyecto.php';
                                    $controlador_proyecto = new ControladorProyecto();
                                    $arreglo_datos = $controlador_proyecto->mostrar_datos_e_l($id_proyecto);

                                    require_once '../Controlador/ControladorMuestra.php';
                                    $controlador_muestra = new ControladorMuestra();
                                    $lista_datos = $controlador_muestra->mostrar_datos_muestra($id_proyecto);

                                    if (sizeof($lista_datos) <= 0) {
                                        $muestras_registrada = false;
                                    } else {
                                        $muestras_registrada = true;
                                    }

                                    require_once '../Controlador/ControladorEnsayoLaboratorio.php';
                                    $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
                                    $array_ensayos = $controlador_ensayo_laboratorio->mostrar_detalle_ensayos_registrados($id_proyecto);
                                    $precio = $controlador_ensayo_laboratorio->sumar_costo_ensayos($id_proyecto);

                                    require_once '../Controlador/ControladorCliente.php';
                                    $controlador_cliente = new ControladorCliente();
                                    if ($controlador_cliente->cliente_registrado($id_proyecto, $t_p)) {
                                        $cliente_registrado = true;
                                        $arreglo_datos_cliente = $controlador_cliente->ver_datos_cliente($id_proyecto, 1);
                                        ?>
                                        <div class="text_box">
                                            <br />
                                            <h3>Cliente registrado</h3>
                                            <br /><br />
                                            <h4>Nombre del proyecto:</h4>
                                            <h6><?php echo $arreglo_datos[0]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>Tipo de institucion:</h4>
                                            <h6><?php echo $t_institucion = $arreglo_datos_cliente[0]; ?></h6>
                                            <br /><br />
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
                                            <h4>CI de la persona de contacto:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[8]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>N° de telefono fijo:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[4]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>N° de telefono celular:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[5]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>Correo electrónico de contacto:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[6]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>Direccion fiscal:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[7]; ?></h6>
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
                                            <a type='button' class='btn2' name='submit' href="../Controlador/ControladorVerFormulario.php?i_p=<?php echo $id_proyecto;?>&t=<?php echo $t_p; ?>"> Ver formulario </a>
                                            <br /><br />
                                            <a type='button' class='btn2' name='submit' href="../Vista/iuRegistroPago.php?i_p=<?php echo $id_proyecto; ?>&t=<?php echo $t_p; ?>&t_i=<?php echo $t_institucion;?>"> Registrar pago </a>
                                            <br /><br />
                                        </div>        
                                        <?php
                                    }
                                    else {
                                        $cliente_registrado = false;
                                        $t_p = $arreglo_datos[2];
                                        ?>

                                        <div class="text_box">
                                            <br />
                                            <h4>Nombre del proyecto:</h4>
                                            <h6><?php echo $arreglo_datos[0]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>Tipo de institucion:</h4>
                                            <select name='cbox_tipo_institucion' id="f3" size=1> 
                                                <option value='privada'>Privada</option>
                                                <option value='estatal'>Estatal</option>
                                            </select>
                                            <br /><br />
                                            <h4>Facturación a nombre de:</h4>
                                            <input type="text" name="nombre_factura" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>N° de NIT o N° de CI:</h4>
                                            <input type="text" name="nit_ci" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>Nombre de la persona de contacto:</h4>
                                            <input type="text" name="nombre_contacto" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>CI de la persona de contacto:</h4>
                                            <input type="text" name="ci_contacto" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>N° de telefono fijo:</h4>
                                            <input type="text" name="telefono_fijo" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>N° de telefono celular:</h4>
                                            <input type="text" name="telefono_celular" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>Correo electrónico de contacto:</h4>
                                            <input type="text" name="correo" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>Direccion fiscal:</h4>
                                            <input type="text" name="direccion" class="login_input" required="required"/>
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
                                            <br />
                                            <input type="hidden" name="tipo_proyecto" value="<?php echo $t_p; ?>">
                                            <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                                            <br />
                                            <?php
                                            if ($precio > 10000) {
                                                echo "<h4>Formulario recibido: <input type='checkbox' name='f_recibido' style='height: 22px; width: 22px;'/> </h4> ";
                                            }
                                            ?>
                                            <input type='submit' class='btn2' value='   Registrar   ' />
                                        </div>
                                    <?php }
                                    ?>
                                    <br />

                                    <h4>Informacion de ensayos registrados:</h4>  
                                    <ul>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th scope="col">Cant.</th>
                                                    <th scope="col">Nombre del ensayo</th>
                                                    <th scope="col">Unit.</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $contador = 0;
                                                if (sizeof($array_ensayos) <= 0) {
                                                    $ensayos_registrados = false;
                                                } else {
                                                    $ensayos_registrados = true;
                                                    while ($contador <= sizeof($array_ensayos) - 1) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $array_ensayos[$contador + 4] ?></td>
                                                            <td><?php echo $array_ensayos[$contador + 3]; ?></td>
                                                            <td><?php echo $array_ensayos[$contador + 6]; ?></td>
                                                            <td><?php echo $array_ensayos[$contador + 5]; ?></td>
                                                        </tr>
                                                        <?php
                                                        $contador = $contador + 8;
                                                    }
                                                }
                                                ?>
                                            </tbody> 

                                        </table>
                                        <br /><br />
    <?php if ($muestras_registrada && $ensayos_registrados) { ?>
                                            COSTO TOTAL DEL PROYECTO:
                                            <br /><br />
                                            <h3><?php echo $precio; ?> bolivianos</h3>
                                            <br />
                                            TIEMPO TOTAL APROXIMADO DEL PROYECTO:
                                            <br /><br />
                                            <h3><?php echo $controlador_ensayo_laboratorio->calcular_tiempo_proximado_ensayos($id_proyecto); ?> días</h3>
                                        </ul>
                                        <br />
                                        <?php
                                    } else {
                                        echo "<br /><h3>FALTAN REGISTROS</h3><br />";
                                        echo "<br /><h3>Solicitar información al supervisor</h3><br />";
                                    }
                                    ?>

                                </form>
                                <?php
                            } elseif ($t_p == 2) {
                                ?>

                                <form method="post" action="<?php echo "../Controlador/ControladorRegistroCliente.php?i_p=$id_proyecto"; ?>" >
                                    <ul>
                                <?php
                                $id_trabajo = $_GET['i_p'];
                                require_once '../Controlador/ControladorProyecto.php';
                                    $controlador_proyecto = new ControladorProyecto();
                                    $arreglo_datos = $controlador_proyecto->mostrar_datos_t_c($id_trabajo);

                                    require_once '../Controlador/ControladorAlcance.php';
                                    $controlador_alcance = new ControladorAlcance();
                                    $array_datos_alcance = $controlador_alcance->mostrar_datos_alcance($id_trabajo);
                                    $precio = $array_datos_alcance[6];
                                    $dias = $array_datos_alcance[5];
                                    
                                    require_once '../Controlador/ControladorCliente.php';
                                    $controlador_cliente = new ControladorCliente();
                                    
                                    if ($controlador_cliente->cliente_registrado($id_proyecto, 2)) {
                                        $cliente_registrado = true;
                                        $arreglo_datos_cliente = $controlador_cliente->ver_datos_cliente($id_proyecto, 2);
                                        ?>
                                        <div class="text_box">
                                            <br />
                                            <h3>Cliente registrado</h3>
                                            <br /><br />
                                            <h4>Nombre del proyecto:</h4>
                                            <h6><?php echo $arreglo_datos[0]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>Tipo de institucion:</h4>
                                            <h6><?php echo $t_institucion = $arreglo_datos_cliente[0]; ?></h6>
                                            <br /><br />
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
                                            <h4>CI de la persona de contacto:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[8]; ?></h6>
                                            <br />
                                            <br />                                            
                                            <h4>N° de telefono fijo:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[4]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>N° de telefono celular:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[5]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>Correo electrónico de contacto:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[6]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>Direccion fiscal:</h4>
                                            <h6><?php echo $arreglo_datos_cliente[7]; ?></h6>
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
                                            <a type='button' class='btn2' name='submit' href="../Controlador/ControladorVerFormulario.php?i_p=<?php echo $id_proyecto;?>&t=<?php echo $t_p; ?>"> Ver formulario </a>
                                            <br /><br />
                                            <a type='button' class='btn2' name='submit' href="../Vista/iuRegistroPago.php?i_p=<?php echo $id_proyecto; ?>&t=<?php echo $t_p; ?>&t_i=<?php echo $t_institucion;?>"> Registrar pago </a>
                                            <br /><br />
                                        </div>        
                                        <?php
                                    }
                                    else {
                                        $cliente_registrado = false;
                                        $t_p = $arreglo_datos[2];
                                        ?>

                                        <div class="text_box">
                                            <br />
                                            <h4>Nombre del proyecto:</h4>
                                            <h6><?php echo $arreglo_datos[0]; ?></h6>
                                            <br />
                                            <br />
                                            <h4>Tipo de institucion:</h4>
                                            <select name='cbox_tipo_institucion' id="f3" size=1> 
                                                <option value='privada'>Privada</option>
                                                <option value='estatal'>Estatal</option>
                                            </select>
                                            <br /><br />
                                            <h4>Facturación a nombre de:</h4>
                                            <input type="text" name="nombre_factura" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>N° de NIT o N° de CI:</h4>
                                            <input type="text" name="nit_ci" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>Nombre de la persona de contacto:</h4>
                                            <input type="text" name="nombre_contacto" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>CI de la persona de contacto:</h4>
                                            <input type="text" name="ci_contacto" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>N° de telefono fijo:</h4>
                                            <input type="text" name="telefono_fijo" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>N° de telefono celular:</h4>
                                            <input type="text" name="telefono_celular" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>Correo electrónico de contacto:</h4>
                                            <input type="text" name="correo" class="login_input" required="required"/>
                                            <br />
                                            <br />
                                            <h4>Direccion fiscal:</h4>
                                            <input type="text" name="direccion" class="login_input" required="required"/>
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
                                            <br />
                                            <input type="hidden" name="tipo_proyecto" value="<?php echo $t_p; ?>">
                                            <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                                            <br />
                                            <input type='submit' class='btn2' value='   Registrar   ' />
                                        </div>
                                    <?php }
                                    ?>
                                    <br />
        
                                            COSTO TOTAL DEL PROYECTO:
                                            <br /><br />
                                            <h3>(<?php echo $precio; ?> bs.) + 13 &#37 = <?php echo $precio+$precio*0.13; ?> bolivianos</h3>
                                            <br />
                                            TIEMPO TOTAL APROXIMADO DEL PROYECTO:
                                            <br /><br />
                                            <h3><?php echo $dias; ?> días</h3>
                                        <br />
                                        <?php
                                    
                            }
                            ?>
                                </ul>		
                                </form>

                        
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
