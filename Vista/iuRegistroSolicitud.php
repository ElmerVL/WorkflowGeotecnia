<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../index.php");
} else {
    if ($rol=$_SESSION['rol'] != 2) {
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
    <script type="text/javascript" src="dynamicoptionlist.js"></script>
    <script>
        $(document).ready(function() {
            $("#fecha_inicio").datepicker({dateFormat: "yy/mm/dd", minDate: '0'});
            var endingDate = $(this).attr('endingDate');

        });
    </script>
</head>

<body onLoad="initDynamicOptionLists();">



    <script type="text/javascript">
        var regionState = new DynamicOptionList();
        regionState.addDependentFields("cbox_tipo", "cbox_ingenieros");
            <?php
            require_once '../Controlador/ControladorIngeniero.php';
            $controlador_ingeniero = new ControladorIngeniero();
            $arreglo_ingenieros_laboratorio = $controlador_ingeniero->lista_ingenieros("superv. laboratorio");
            $contador = 0;
            while ($contador <= sizeof($arreglo_ingenieros_laboratorio) - 1) {
                ?>
                    regionState.forValue("ensayo de laboratorio").addOptionsTextValue("<?php echo $arreglo_ingenieros_laboratorio[$contador + 1] . " " . $arreglo_ingenieros_laboratorio[$contador + 2]; ?>", "<?php echo $arreglo_ingenieros_laboratorio[$contador]; ?>");
                <?php
                $contador = $contador + 3;
            }
            $arreglo_ingenieros_campo = $controlador_ingeniero->lista_ingenieros("superv. campo");


            $contador = 0;
            while ($contador <= sizeof($arreglo_ingenieros_campo) - 1) {
                ?>
                    regionState.forValue("trabajo de campo").addOptionsTextValue("<?php echo $arreglo_ingenieros_campo[$contador + 1] . " " . $arreglo_ingenieros_campo[$contador + 2]; ?>", "<?php echo $arreglo_ingenieros_campo[$contador]; ?>");
                <?php
                $contador = $contador + 3;
            }
            ?>
    </script>


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
                                <h4>Nombre del proyecto:</h4>
                                <h6 style="font-size: 1.05em;">Este nombre sera usado durante todo el tratamiento del proyecto</h6>
                                <br />
                                <input type="text" name="cliente" class="login_input" required="required" pattern="^[a-zA-Z0-9]{1,20}$"/>
                                <br /><br />
                                <h4>Ubicación del proyecto:</h4>
                                <h6 style="font-size: 1.05em;">Ubicación general del proyecto</h6>
                                <br />
                                <input type="text" name="ubicacion" class="login_input" required="required" pattern="^[a-zA-Z0-9]{1,20}$"/>
                                <br /><br />
                                <h4>Tipo de proyecto:</h4>
                                <h6 style="font-size: 1.05em;">Solo puede ser de un tipo</h6>
                                <br />
                                <select name='cbox_tipo' id="f3" size=1> 
                                    <option value='ensayo de laboratorio'>Ensayo de Laboratorio</option>
                                    <option value='trabajo de campo'>Trabajo de campo</option>
                                </select>
                                <br /><br />
                                <h4>Responsable:</h4>
                                <h6 style="font-size: 1.05em;">Solo puede tener un supervisor</h6>
                                <br />
                                <select name='cbox_ingenieros' id="f3" size=1>
                                </select>
                                <br /><br />
                                <h4>Fecha:</h4>
                                <input type="text" name="fecha" id="fecha_inicio" placeholder="Seleccione una fecha" required="required" />
                                <input type="submit" class="btn2" name="submit" value="Registrar" />                            

                            </div>


                            <br />   

                            </form>

                        </ul>		
                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
                            <?php
                            if ($rol == 2)
                                echo "<li><a href='iuRegistroSolicitud.php'>NUEVA SOLICITUD</a></li>";
                            ?>

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
