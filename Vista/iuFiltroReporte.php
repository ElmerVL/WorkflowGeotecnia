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
    <title>WORKFLOW</title>
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
            <h1><a href="iuDirector.php">Laboratorio de <span>Geotecnia</span></a></h1>		
        </div>

        <div id="body">
            <ul id="nav">
                <li class="on"><a href="iuDirector.php">Principal</a></li>

            </ul>
            <div id="content"><div>
                    <div id="main">
                        <h2>Lista de solicitudes</h2>
                        <?php $id_usuario = $_SESSION['id_usuario']; ?>

                        <form method="post" action="../Controlador/ControladorReporte.php">
                            <ul>
                                <div class="text_box">
                                    <h5>Reporte</h5>
                                    <select name='tipo_reporte' id="f3" size=1> 
                                        <option value='solicitudes'>Solicitudes</option>
                                        <option value='ensayos de laboratorio'>Ensayos de Laboratorio</option>
                                        <option value='muestras'>Muestras</option>
                                        <option value='trabajos de campo'>Trabajos de campo</option>
                                    </select>

                                    <h5>Año para el reporte</h5>
                                    <select name='cbox_anio_reporte' id="f3" size=1> 
                                        <option value='todos'>TODOS</option>
                                        <option value='<?php echo date("Y"); ?>'><?php echo date("Y"); ?></option>
                                        <option value='<?php echo date("Y") - 1; ?>'><?php echo date("Y") - 1; ?></option>
                                        <option value='<?php echo date("Y") - 2; ?>'><?php echo date("Y") - 2; ?></option>
                                    </select>
                                </div>       
                            </ul>
                            <input type='submit' class='btn2' value='   OK   ' />
                            <br />
                        </form>

                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
                            <li><a href='iuRegistroSolicitud.php'>NUEVA SOLICITUD</a></li>
                            <li><a href="iuTablaProyectos.php?f=0">PROYECTOS</a></li>
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
