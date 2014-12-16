<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../index.php");
} else {
    if ($rol=$_SESSION['rol'] != 1) {
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
                            <form name='ingreso_sistema' method='post' action='../Controlador/ControladorRegistroUsuario.php'>
                                <br />
                                <h4>Tipo de usuario:</h4>
                                <select name = 'cbox_rol'>
                                    <option value="2">Director</option>
                                    <option value="3">Contador</option>
                                    <option value="4">Ingeniero</option>
                                    <option value="5">Auxiliar</option>
                                </select>
                                <br />
                                <br />
                                <?php 
                                $mensaje = $_GET['m'];
                                if($mensaje==1)
                                    $mensaje = "Nombre de usuario no disponible";
                                ?>
                                <h4>Nombre de usuario:</h4>
                                <input type="text" name="nombre_usuario" id ='nombre_usuario' required="required"/><h7><?php echo $mensaje; ?></h7>
                                <br />
                                <br />
                                <h4>Contraseña:</h4>
                                <input type="password" name="contrasenia" id="contrasenia" required="required"/>
                                <br />
                                <br />
                                <h4>Nombres:</h4>
                                <input type="text" name="nombres" id="nombres" required="required"/>
                                <br />
                                <br />
                                <h4>Apellidos:</h4>
                                <input type="text" name="apellidos" id="apellidos" required="required"/>
                                <br />
                                <br />
                                <input type="submit" class="btn2" name="submit" value="Registrar" />     
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
