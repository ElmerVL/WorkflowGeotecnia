<?php
session_start();
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
    <link href="css/style_3.css" rel="stylesheet" type="text/css" />
    <link href="js/custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
    <link href="js/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/jquery-ui-1.8.20.js"></script>
    <script src="textos2/ckeditor.js"></script>
    <link rel="stylesheet" href="textos2/samples/sample.css">
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
                        <h2>Alcance</h2>
                        <?php
                         $id_usuario = $_SESSION['id_usuario']; 
                         $id_proyecto = $_GET['i_p'];
                        ?>
                        <ul>
                            <form name="" method="post" action='../Vista/iuCrearAlcanceP2.php?i_p=<?php echo $id_proyecto; ?>'>
                                <div id="textos">
                                    <br />
                                    <h4>1. ANTECEDENTES:</h4>
                                    <textarea class="ckeditor" cols="52,7" id="editor1" name="antecedente" rows="10"></textarea>
                                    <br /><br />
                                    <h4>2. OBJETIVO:</h4>
                                    <textarea cols="52,7" id="editor1" name="objetivo" rows="5" ></textarea>
                                    <br /><br />
                                    <h4>3. TRABAJOS A REALIZAR:</h4>
                                    <h6>Trabajo de campo<input type="checkbox" value="Trabajo_de_campo" name="trabajos[]" id="f1"></h6>
                                    <h6>Trabajo de laboratorio<input type="checkbox" value="Trabajo_de_laboratorio" name="trabajos[]" id="f1"></h6>
                                    <h6>Trabajo de gabinete<input type="checkbox" value="Trabajo_de_gabinete" name="trabajos[]" id="f1"></h6>
                                    <br />
                                </div>
                                <input type="submit" class="btn2" name="submit" value="Siguiente" />                            
                            </form>

                        </ul>		
                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
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