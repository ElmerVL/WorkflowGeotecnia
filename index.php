<!DOCTYPE html >
<head>
	<title>Workflow Geotecnia</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<meta name="revisit-after" content="3 days" />
        <link href="Vista/css/style.css" rel="stylesheet" type="text/css" />
	<!--[if IE]><link href="css/ie-transparency.css" rel="stylesheet" type="text/css" /><![endif]-->    
</head>

<body id="home">
<ul class="hide"><li><a href="#body">Skip to content</a></li></ul>
<div id="container">
	<div id="header">
	    <h1><a href="index.html">Laboratorio de <span>Geotecnia</span></a></h1>		
	</div>
    
	<div id="body">
		<ul id="nav">
			<li class="on first"><a href="index.php">PRINCIPAL</a></li>
		</ul>
		<div id="content"><div>
			<div id="main">
				<h2>INGRESAR AL SISTEMA: </h2>
				<form id="ingreso_sistema" name="ingreso_sistema" method="post" action="Controlador/ControladorAccesoUsuarios.php">
                        <div class="text_box">
                            <div class="login_form_row">
                            <label class="login_label">Nombre de usuario:</label>
                            <br />
                            <input type="text" name="name" class="login_input" required = "required" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" />
                            </div>
                            
                            <div class="login_form_row">
                            <label class="login_label">Contrasenia:</label>
                            <br />
                            <input type="password" name="pass" class="login_input" />
                            </div>                                     
                        <input type="submit" class="btn" name="submit" value="Entrar" />                            
                        
                        </div>
        </form>
				<ul>
					<!--li><span>Capacitar estudiantes en los 
                                                niveles de pregrado y posgrado 
                                                en el campo de la geotecnia.</span></li-->
					<!--li><span>Impulsar y ejecutar proyectos 
                                                de investigación y difundir los 
                                                resultados obtenidos a nivel 
                                                nacional e internacional.</span></li-->
					<li><span>Prestar servicios geotécnicos 
                                                tanto a empresas públicas como 
                                                privadas, nacionales o extranjeras, 
                                                contribuyendo al desarrollo 
                                                sostenible de la región y del país.</span></li>
				</ul>
				<p>	
El Laboratorio de Geotecnia de la Universidad Mayor de San Simón, nació el 19 de
septiembre de 1996, con el apoyo técnico de la cooperación belga dentro del plan
de mejoramiento de la educación e investigación en el campo de la geotecnia.</p>			
			</div>
			<div id="sub">
                            <p><img src="Vista/img/image_l.gif" alt="An image" /></p>
			</div>
		</div></div>	
	</div>
	
	<div id="footer">
		<p class="left">&copy; 2014 Jimena Salazar Soto</p>
		
	</div>	
</div>	
</body>
</html>
