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
                            <?php $id_usuario = $_SESSION['id_usuario'];
                            ?>

				<h2>DIRECTOR</h2>
				<p>Posteriormente la informacion del director.</p>
				
							
			</div>
			<div id="sub">
                            <h2>MENÚ</h2>
				<ul class="links">
                            <li><a href='iuRegistroSolicitud.php'>NUEVA SOLICITUD</a></li>
                            <li><a href='iuFiltroReporte.php'>REPORTES</a></li>
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
