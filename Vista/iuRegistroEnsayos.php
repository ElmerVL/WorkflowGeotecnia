<?php
require_once '../Controlador/ControladorEnsayoLaboratorio.php';
session_start();
$rol = $_SESSION['rol'];
$i_u = $_SESSION['id_usuario'];
if (!$i_u) {
    header("Location: ../index.php");
} else {
    if ($rol != 4) {
        session_destroy();
        header("Location: ../index.php");
    }
}

$id_proyecto = $_GET['i_p'];
$id_usuario = $_SESSION['id_usuario'];
$tipo_trabajo = $_GET['f_t'];
$controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
?>

<!DOCTYPE html >
<head>
    <title>WORKFLOW</title>
    <link rel="shortcut icon" href="../Vista/img/icono">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="copyright" content=""/>
    <meta name="revisit-after" content="3 days"/>
    <link href="css/style_1.css" rel="stylesheet" type="text/css"/>
    <script src="../Vista/js/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script>
        setInterval(function () {
            $("#noticias").load(location.href + " #noticias>*", "");
        }, 4000);
    </script>
</head>

<body>
<ul class="hide">
    <li><a href="#body">Skip to content</a></li>
</ul>
<div id="container">
    <div id="header">
        <h1><a href="iuAdministrador.php">Laboratorio de <span>Geotecnia</span></a></h1>
    </div>

    <div id="body">
        <ul id="nav">
            <?php
            if ($rol == 1) {
                ?>
                <li class="on"><a href="iuAdministrador.php">Principal</a></li>
                <?php
            }
            if ($rol == 2) {
                ?>
                <li class="on"><a href="iuDirector.php">Principal</a></li>
                <?php
            }
            if ($rol == 3) {
                ?>
                <li class="on"><a href="iuContador.php">Principal</a></li>
                <?php
            }
            if ($rol == 4) {
                ?>
                <li class="on"><a href="iuIngeniero.php">Principal</a></li>
                <?php
            }
            if ($rol == 5) {
                ?>
                <li class="on"><a href="iuAuxiliar.php">Principal</a></li>
                <?php
            }
            if ($rol == 6) {
                ?>
                <li class="on"><a href="iuTecnico.php">Principal</a></li>
                <?php
            }
            ?>
            <li class="on"><a href="iuCalendario.php">Calendario</a></li>
            <li class="on"><a href="iuWorkFlow.php">Workflow</a></li>
        </ul>
        <div id="content">
            <div>
                <div id="main">
                    <h2>Registrar ensayos de laboratorio para el proyecto</h2>
                    <h6 style="font-size: 1.05em;">Se pueden registrar ensayos de ambos tipos: suelo o roca. Debe usar
                        el filtro para seleccionarlos.</h6>
                    <br/>
                    <?php echo "<form name='ingreso_sistema' method='post' action='../Controlador/ControladorDiferenciadorEnsayos.php?i_p=$id_proyecto'>" ?>
                    <fieldset>
                        <label>Tipo de ensayo:</label>
                        <br/>
                        <br/>
                        <ul class="fieldlist">
                            <input type="radio" name="diferenciador" id="f41" value="1" checked/>
                            <label for="f41">Suelo</label>
                            <br>
                            <input type="radio" name="diferenciador" id="f43" value="2"/>
                            <label for="f43">Roca</label>
                            <br>
                            <input type="submit" value="Mostrar" class="btn"/>
                        </ul>
                    </fieldset>
                    </form>

                    <?php
                    if ($tipo_trabajo == '1') {
                        echo "<form method='post' action='../Controlador/ControladorRegistroEnsayos.php?i_u=$id_usuario&i_p=$id_proyecto'>";
                        ?>
                        <ul>

                                    <?php
                                    include_once '../Controlador/ControladorEnsayoLaboratorio.php';
                                    $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Caracterizacion');
                                    $contador = 0;
                                    if(sizeof($lista) > 0) {
                                    ?>
                                    <h4>Caracterización: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                <?php
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 50%;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                }
                                    ?>

                                </tbody>

                            </table>


                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Parámetros de deformacion');
                                    $contador = 0;
                                    if(sizeof($lista) > 0) {
                                    ?>
                                    <h4>Parametros de deformación: </h4>
                            <table style="width: 95%;">

                                <tbody>
                                    <?php
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>

                            <h4>Parametros de deformación en condición no drenada: </h4>
                            <table style="width: 95%;">

                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Param. de resistencia CND');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="min-width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="<?php echo "txt_cant_$lista[$contador]" ; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>

                                </tbody>
                            </table>

                            <h4>Parametros de resistencia en condición drenada: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Param. de resistencia CD');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>

                                </tbody>
                            </table>

                            <h4>Parametros de hidráulicos: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Parametros hidraulicos');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h4>Suelos no saturados: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Suelos no saturados');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h4>Suelos especiales: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Suelos especiales');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h4>Resistencia de agregados: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Resistencia de agregados');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <input type="submit" class="btn2" name="submit" value="Registrar" />

                        </ul>
                        </form>
                        <?php
                    } elseif ($tipo_trabajo == '2') {
                        echo "<form method='post' action='../Controlador/ControladorRegistroEnsayos.php?i_u=$id_usuario&i_p=$id_proyecto'>";
                        ?>
                        <ul>
                            <h4>Caracterización: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Caracterizacion');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h4>Durabilidad: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Durabilidad');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h4>Resistencia: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Resistencia');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </table>

                            <h4>Resistencia al corte: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Resistencia al corte');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h4>Tracción: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Traccion');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h4>Abrasión: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Abrasion');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h4>Extracción de nucleos: </h4>
                            <table style="width: 95%;">
                                <tbody>
                                    <?php
                                    $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Extraccion de núcleos');
                                    $contador = 0;
                                    while ($contador <= sizeof($lista) - 1) {
                                        ?>
                                        <tr>
                                            <td style="width: 70%;"><h7><?php echo $lista[$contador + 1] ?></h7></td>
                                            <th scope="row" style="width: 15%;"><h7><?php echo $lista[$contador]; ?></h7><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="ensayos[]" id="f1" /></th>
                                            <th scope="row" style="width: 15%;"><input type="text" value="1" name="txt_cant_<?php echo $lista[$contador]; ?>" style="width: 25px;"/></th>
                                        </tr>
                                        <?php
                                        $contador = $contador + 2;
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <input type="submit" class="btn2" name="submit" value="Registrar" />

                        </ul>
                        </form>
                        <?php
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
                        echo $lista[$contador + 3] . "</br>";
                        $contador = $contador + 4;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">
        <p class="left">&copy; 2014 Jimena Salazar Soto</p>
    </div>
</div>
</body>
</html>
