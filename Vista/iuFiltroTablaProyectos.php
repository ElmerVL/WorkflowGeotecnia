<?php
session_start();

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
                       
                        <h2>Ver proyectos</h2>

                        <ul>
                            <form name='ingreso_sistema' method='post' action='../Controlador/ControladorFiltroProyectos.php'>
                                <fieldset>
                                    <p><label>Seleccione proyectos:</label></p>
                                    <br />
                                    <ul class="fieldlist">
                                        <li><input type="radio" name="filtro" id="f41" value="0" checked /> 
                                            <label for="f41">Todos</label></li>
                                        <li><input type="radio" name="filtro" id="f43" value="1" /> 
                                            <label for="f43">Ensayos de laboratorio</label></li>
                                        <li><input type="radio" name="filtro" id="f42" value="2" /> 
                                            <label for="f42">Estudios geotecnicos</label></li>
                                    </ul>
                                    <p><label>&nbsp;</label> <input type="submit" value="Mostrar" class="btn" /></p>
                                </fieldset>
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
