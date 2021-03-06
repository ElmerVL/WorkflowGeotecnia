<?php
session_start();
$rol = $_SESSION['rol'];
$i_u = $_SESSION['id_usuario'];
if (!$i_u) {
    header("Location: ../index.php");
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
                        <h2>Información de muestras</h2>
                        <?php
                        require_once '../Controlador/ControladorMuestra.php';
                        $id_proyecto = $_GET['i_p'];
                        $controlador_muestra = new ControladorMuestra();
                        $lista_datos = $controlador_muestra->mostrar_datos_muestra($id_proyecto);
                        $contador = 0;
                        while ($contador <= sizeof($lista_datos) - 1) {
                            ?>
                            <ul>
                                <?php echo "<form name='ingreso_sistema' method='post'>"; ?>
                                <div class="text_box">
                                    <br />
                                    <h3><?php echo $lista_datos[$contador]; ?></h3>
                                    <br />
                                    <h4>Responsable del proyecto:</h4>
                                    <h6><?php echo $lista_datos[$contador + 2]; ?></h6>
                                    <br />
                                    <h4>Tipo de ensayo para la muestra:</h4>
                                    <h6><?php echo $lista_datos[$contador + 3]; ?></h6>
                                    <br />
                                    <h4>Ubicación general:</h4>
                                    <h6><?php echo $lista_datos[$contador + 4]; ?></h6>
                                    <br />
                                    <h4>Ubicación especifica:</h4>
                                    <h6><?php echo $lista_datos[$contador + 5]; ?></h6>
                                    <br />
                                    <h4>Profundidad:</h4>
                                    <h6><?php echo $lista_datos[$contador + 6]; ?></h6>
                                    <br />
                                    <h4>Fecha de extracion de la muestra:</h4>
                                    <h6><?php echo $lista_datos[$contador + 7]; ?></h6>
                                    <br />
                                    <h4>Metodo de extracción:</h4>
                                    <h6><?php echo $lista_datos[$contador + 8]; ?></h6>
                                    <br />
                                    <h4>Punto de extracción:</h4>
                                    <h6><?php echo $lista_datos[$contador + 9]; ?></h6>
                                    <br />
                                    <h4>Descripción:</h4>
                                    <h6><?php echo $lista_datos[$contador + 10]; ?></h6>
                                    <br />
                                    <h6></h6>
                                    <br />
                                </div>
                                </form>

                            </ul>
                            
                            <?php
                            $contador = $contador + 11;
                        }
                        ?>
                    <?php
                            if ($rol == 2)
                                echo '<input type="button" class="btn2" name="submit" href="#" value="Director"/>';
                            elseif ($rol == 3)
                                echo '<input type="button" class="btn2" name="submit" href="#" value="Contador"/>';
                            elseif ($rol == 4) 
                                echo "<a type='button' class='btn2' name='submit' href='../Vista/iuInformacionProyecto.php?i_p=$id_proyecto&t=1'>Volver</a><br /><br />";
                            elseif ($rol == 5)
                                echo '<input type="button" class="btn2" name="submit" href="#" value="Auxiliar"/>';
                            elseif ($rol == 6)
                                echo '<input type="button" class="btn2" name="submit" href="#" value="Tecnico"/>';
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
