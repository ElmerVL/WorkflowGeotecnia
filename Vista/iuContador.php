<?php
session_start();
if (!$_SESSION['id_usuario']) {
    header("Location: ../index.php");
} else {
    if ($_SESSION['rol'] != 3) {
        session_destroy();
        header("Location: ../index.php");
    }
}
?>

<!DOCTYPE html >
<head>
	<title>CONTADOR</title>
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
	    <h1><a href="index.html">Granite<span>Glass</span></a></h1>		
	</div>
    
	<div id="body">
		<ul id="nav">
                    <li class="on"><a href="iuTecnico.php">Principal</a></li>
			
		</ul>
		<div id="content"><div>
			<div id="main">
				<h2>Consectetuer adipiscing</h2>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Cras suscipit. Vestibulum quis massa. 
				Suspendisse sed massa id diam aliquet.</p>
				
				<ul>
					<li><span>Duis sodales turpis vel nisl</span></li>
					<li><span>Sed accumsan diam lacus quis</span></li>
					<li><span>Posuere vitae, vehicula</span></li>
					<li><span>Consectetuer adipiscing elit</span></li>
				</ul>
				<p>Vestibulum molestie, nisl sed commodo pellentesque, risus justo sollicitudin nisl, sed accumsan 
				diam lacus quis augue.</p>			
			</div>
			<div id="sub">
                            <h2>MENÚ</h2>
				<ul class="links">
					<li><a href="#">PROYECTOS</a></li>
					<li><a href="../Controlador/ControladorFinalizarSesion.php">CERRAR SESION</a></li>					
				</ul>
		
			</div>
		</div></div>	
	</div>
	
	<div id="footer">
		<p class="left">&copy; 2008 Company name</p>
		<p class="right">Template by <a href="http://www.onedollartemplates.com">One Dollar Templates</a></p>
	</div>	
</div>	
</body>
</html>
