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
    <script src="js/jquery-ui-1.8.20.js"></script>
    <script src="../Vista/js/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#fecha_inicio").datepicker({dateFormat: "yy/mm/dd", minDate: '0'});

            var endingDate = $(this).attr('endingDate');

        });
    </script>
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
                        <h2>Editar solicitud</h2>
                        <?php $id_usuario = $_SESSION['id_usuario'];
                        $id_solicitud = $_GET['i_s'];
                        ?>
                        <ul>
                                <?php echo "<form name='ingreso_sistema' method='post' action='../Controlador/ControladoresFormularios/ControladorRegistroSolicitud.php?iu=$id_usuario&i_s=$id_solicitud'>"; ?>
                            <div class="text_box">
                                <?php
                                require_once '../Controlador/ControladorSolicitud.php';
                                $controlador_solicitud = new ControladorSolicitud();
                                $arreglo_datos = $controlador_solicitud->mostrar_datos($id_solicitud);
                                ?>
                                <h4>Nombre del cliente:</h4>
                                <input type="text" name="cliente" class="login_input" value = "<?php echo $arreglo_datos[0]; ?>" />
                                <br /><br />
                                <h4>Ubicación del proyecto:</h4>
                                <input type="text" name="ubicacion" class="login_input" value = "<?php echo $arreglo_datos[1]; ?>" />
                                <br /><br />
                                <h4>Tipo de proyecto:</h4>
                                <input type="text" name="cbox_tipo" class="login_input" value = "<?php echo $arreglo_datos[2]; ?>" />
                                <br /><br />
                                <h4>Responsable:</h4>
                                <select name='cbox_ingenieros' id="f3" size=1
                                <?php
                                include_once '../Controlador/ControladorIngeniero.php';
                                $controlador_ingeniero = new ControladorIngeniero();

                                $lista = $controlador_ingeniero->lista_ingeniero_seleccionado();
                                $contador = 0;
                                while ($contador <= sizeof($lista) - 1) {
                                    if ($arreglo_datos[3] == $lista[$contador]) {
                                        ?>
                                                <option selected="selected" value = <?php echo $lista[$contador]; ?> > <?php echo $lista[$contador + 1] . " " . $lista[$contador + 2]; ?></option>
                                                    <?php } else {
                                                    ?>
                                            <option value = <?php echo $lista[$contador]; ?> > <?php echo $lista[$contador + 1] . " " . $lista[$contador + 2]; ?></option>
                                            <?php
                                        }
                                        $contador = $contador + 3;
                                    }
                                    ?>
                                </select>
                                <br /><br />
                                <h4>Fecha:</h4>
                                <input type="text" name="fecha" id="fecha_inicio" value = "<?php echo date("Y/m/d", strtotime($arreglo_datos[4])); ?>" required />

                                <input type="submit" class="btn2" name="submit" value="Actualizar" />                            

                            </div>
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
