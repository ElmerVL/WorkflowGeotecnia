<?php
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
    <link href="css/style_3.css" rel="stylesheet" type="text/css" />
    <link href="js/custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
    <link href="js/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/jquery-ui-1.8.20.js"></script>
    <script src="textos2/ckeditor.js"></script>
    <link rel="stylesheet" href="textos2/samples/sample.css">
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
                        <h2>Alcance</h2>

                        <?php
                        $id_usuario = $_SESSION['id_usuario'];
                        $id_proyecto = $_GET['i_p'];
                        $posicion = $_GET['i'];
                        ?>
                        <ul>
                            <form method="post" action="../Controlador/ControladorEdicionesAlcance.php?i_p=<?php echo $id_proyecto; ?>&i=<?php echo $posicion; ?>">
                                <?php
                                switch ($posicion) {
                                    case 0:
                                        ?>
                                        <br />
                                        <h4>1. Antecedente</h4>
                                        <textarea class="ckeditor" cols="52,7" id="editor1" name="valor_actualizado" rows="10"></textarea>
                                        <?php
                                        break;
                                    case 1:
                                        ?>
                                        <br />
                                        <h4>2. Objetivo</h4>
                                        <textarea cols="52,7" id="editor1" name="valor_actualizado" rows="5" ></textarea>
                                        <?php
                                        break;
                                    case 2:
                                        ?>
                                        <br />
                                        <h7>Trabajo de campo.</h7>
                                        <textarea class="ckeditor" cols="52,7" id="editor1" name="valor_actualizado" rows="10"></textarea>
                                        <?php
                                        break;
                                    case 3:
                                        ?>
                                        <br />
                                        <h7>Trabajo de gabinete.</h7>
                                        <textarea class="ckeditor" cols="52,7" id="editor1" name="valor_actualizado" rows="10"></textarea>
                                        <?php
                                        break;
                                    case 4:
                                        ?>
                                        <br />
                                        <h7>Trabajo de laboratorio.</h7>
                                        <textarea class="ckeditor" cols="52,7" id="editor1" name="valor_actualizado" rows="10"></textarea>
                                        <?php
                                        break;
                                    case 5:
                                        ?>
                                        <br />
                                        <h4>4. Inicio y duración</h4>
                                        <textarea cols="10" id="editor1" name="valor_actualizado" rows="2" ></textarea> días
                                        <?php
                                        break;
                                    case 6:
                                        ?>
                                        <br />
                                        <h4>5. Precio del estudio</h4>
                                        <textarea cols="10" id="editor1" name="valor_actualizado" rows="2" ></textarea> bolivianos
                                        <?php
                                        break;
                                    case 7:
                                        ?>
                                        <br />
                                        <h4>6. Forma de pago</h4>
                                        <textarea cols="52,7" id="editor1" name="valor_actualizado" rows="4" ></textarea>
                                        <?php
                                        break;
                                    case 8:
                                        ?>
                                        <br />
                                        <h4>7. Requerimientos adicionales</h4>
                                        <textarea class="ckeditor" cols="52,7" id="editor1" name="valor_actualizado" rows="10"></textarea>
                                        <?php
                                        break;
                                    case 9:
                                        ?>
                                        <br />
                                        <h4>OBERVACIONES.</h4>
                                        <textarea class="ckeditor" cols="52,7" id="editor1" name="valor_actualizado" rows="10"></textarea>
                                        <?php
                                        break;
                                }
                                ?>
                                <input type='submit' class='btn2' value='Listo' />
                            </form>
                        </ul>		
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