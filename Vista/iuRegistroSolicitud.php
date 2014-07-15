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
	    <h1><a href="index.html">Granite<span>Glass</span></a></h1>		
	</div>
    
	<div id="body">
		<ul id="nav">
                    <li class="on"><a href="iuTecnico.php">Principal</a></li>
			
		</ul>
		<div id="content"><div>
			<div id="main">
				<h2>Registrar solicitud</h2>
                                <?php $id_usuario = $_SESSION['id_usuario'];
                                  echo $id_usuario;
                            ?>
				<ul>
                                        <?php echo "<form name='ingreso_sistema' method='post' action='../Controlador/ControladorRegistroSolicitud.php?iu=$id_usuario'>"; ?>
                        <div class="text_box">
                            <div class="login_form_row">
                            <span>Nombre del cliente:</span>
                            <br />
                            <input type="text" name="cliente" class="login_input" />
                            </div>
                            
                            <div class="login_form_row">
                            <span>Fecha:</span>
                            <br />
                            <input type="text" name="fecha" id="fecha_inicio" placeholder="Seleccione una fecha" required />
                            </div>       
                            <br />                              
                        <input type="submit" class="btn2" name="submit" value="Registrar" />                            
                        
                        </div>
                                        
				</ul>		
			</div>
			<div id="sub">
                            <h2>MENÚ</h2>
				<ul class="links">
                                    <li><a href="iuRegistroSolicitud.php">NUEVA SOLICITUD</a></li>
					<li><a href="#">PROYECTOS</a></li>
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
