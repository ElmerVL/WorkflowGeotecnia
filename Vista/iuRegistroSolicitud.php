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
    <script type="text/javascript" src="dynamicoptionlist.js"></script>
    <script>
        $(document).ready(function() {
            $("#fecha_inicio").datepicker({dateFormat: "yy/mm/dd", minDate: '0'});
            var endingDate = $(this).attr('endingDate');

        });
    </script>
</head>

<body onLoad="initDynamicOptionLists();">
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
                            <?php echo "<form name='ingreso_sistema' method='post' action='../Controlador/ControladorRegistroSolicitud.php?iu=$id_usuario&i_s=0'>"; ?>


                            <div class="text_box">
                                <br />
                                <h4>Nombre del cliente:</h4>
                                <input type="text" name="cliente" class="login_input" />
                                <br /><br />
                                <h4>Ubicación del proyecto:</h4>
                                <input type="text" name="ubicacion" class="login_input" />
                                <br /><br />
                                <h4>Tipo de proyecto:</h4>
                                <select name='cbox_tipo' id="f3" size=1> 
                                    <option value='ensayo de laboratorio'>Ensayo de Laboratorio</option>
                                    <option value='trabajo de campo'>Trabajo de campo</option>
                                </select>
                                <br /><br />
                                <h4>Responsable:</h4>
                                <select name='cbox_ingenieros' id="f3" size=1>
                                    <?php
                                    require_once '../Controlador/ControladorIngeniero.php';
                                    $controlador_ingeniero = new ControladorIngeniero();
                                    $controlador_ingeniero->lista_ingenieros();
                                    ?>
                                </select>
                                <br /><br />
                                <h4>Fecha:</h4>
                                <input type="text" name="fecha" id="fecha_inicio" placeholder="Seleccione una fecha" required />
                                <input type="submit" class="btn2" name="submit" value="Registrar" />                            

                            </div>
                            </form>

                        </ul>		
                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
                            <li><a href="iuRegistroSolicitud.php">NUEVA SOLICITUD</a></li>
                            <li><a href="iuFiltroTablaProyectos.php">PROYECTOS</a></li>
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
