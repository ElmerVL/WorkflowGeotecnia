<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../index.php");
} else {
    if ($_SESSION['rol'] != 2) {
        session_destroy();
        header("Location: ../index.php");
    }
}
?>

<!DOCTYPE html >
<head>
    <title>DIRECTOR</title>
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
    <script>
        $(document).ready(function() {
            $("#fecha_inicio").datepicker({dateFormat: "yy/mm/dd", minDate: '0'});

            var endingDate = $(this).attr('endingDate');

        });
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
                <li class="on"><a href="iuAdministrador.php">Principal</a></li>

            </ul>
            <div id="content"><div>
                    <div id="main">
                        <h2>Registrar solicitud</h2>
                        <?php $id_usuario = $_SESSION['id_usuario']; ?>
                        <ul>
                            <?php echo "<form name='ingreso_sistema' method='post' action='../Controlador/ControladorRegistroSolicitud.php?iu=$id_usuario'>"; ?>
                            <div class="text_box">
                                <?php
                                require_once '../Controlador/ControladorSolicitud.php';
                                $id_solicitud = $_GET['i_s'];
                                $controlador_solicitud = new ControladorSolicitud();
                                $arreglo_datos = $controlador_solicitud->mostrar_datos($id_solicitud);
                                ?>
                                <span>Nombre del cliente:</span>
                                <br />
                                <input type="text" name="cliente" class="login_input" value = <?php echo $arreglo_datos[0]; ?> >
                                <br />

                                <span>Ubicación del proyecto:</span>
                                <br />
                                <input type="text" name="ubicacion" class="login_input" value = <?php echo $arreglo_datos[1]; ?>>
                                <br />
                                <span>Tipo de proyecto:</span>
                                <br />
                                <input type="text" name="ubicacion" class="login_input" value = <?php echo $arreglo_datos[2]; ?>>
                                <br />
                                <span>Responsable:</span>
                                <br />
                                <select name='cbox_ingenieros' id="f3" size=1>
                                <?php
                                include_once '../Controlador/ControladorIngeniero.php';
                                $controlador_ingeniero = new ControladorIngeniero();
                                
                                $lista = $controlador_ingeniero->ingeniero_seleccionado();
                                $contador = 0;
                                while ($contador <= sizeof($lista) - 1) {
                                    if ($arreglo_datos[3] == $lista[$contador]) {
                                    ?>
                                    <option selected="selected" value = <?php echo $lista[$contador];?> > <?php echo $lista[$contador+1]." ".$lista[$contador+2]; ?></option>
                                    <?php
                                    }else{?>
                                        <option value = <?php echo $lista[$contador];?> > <?php echo $lista[$contador+1]." ".$lista[$contador+2]; ?></option>
                                    <?php
                                    }
                                    $contador = $contador + 3;
                                }
                                
                                    ?>
                                </select>
                                <br />
                                <span>Fecha:</span>
                                <br />
                                <input value = <?php echo $arreglo_datos[4]; ?> type="text" name="fecha"  >

                                <br />
                                <input type="submit" class="btn2" name="submit" value="Actualizar" />                            

                            </div>
                            </form>

                        </ul>		
                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
                            <li><a href="iuRegistroSolicitud.php">NUEVA SOLICITUD</a></li>
                            <li><a href="iuTablaSolicitudes.php">PROYECTOS</a></li>
                            <li><a href="../Controlador/ControladorFinalizarSesion.php">CERRAR SESION</a></li>					
                        </ul>

                    </div>
                </div></div>	
        </div>

        <div id="footer">
            <p class="left">&copy; 2014 Jimena Salazar Soto</p>
        </div>	
    </div>	
</body>
</html>
