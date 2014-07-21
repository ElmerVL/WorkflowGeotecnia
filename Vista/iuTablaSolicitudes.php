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
            <h1><a href="iuDirector.php">Laboratorio de <span>Geotecnia</span></a></h1>		
	</div>
    
	<div id="body">
		<ul id="nav">
                    <li class="on"><a href="iuDirector.php">Principal</a></li>
			
		</ul>
		<div id="content"><div>
			<div id="main">
				<h2>Lista de proyectos</h2>
                                <?php $id_usuario = $_SESSION['id_usuario'];?>
				<ul>
                     
                        <div class="text_box">
                <table>
			<thead>
				<tr>
					<th scope="col">Codigo de la solicitud</th>
					<th scope="col">Cliente</th>
					<th scope="col">Ubicacion</th>
					<th scope="col">Tipo de proyecto</th>
                                        
				</tr>
			</thead>
			<tbody>
				<?php
                                include_once '../Controlador/ControladorSolicitud.php';
                                $controlador_solicitud = new ControladorSolicitud();
                                
                                $lista = $controlador_solicitud->mostrarTabla();
                                $contador = 0;
                                while ($contador <= sizeof($lista) - 1) {
                                    ?>
                                    <tr>
                                        <td><?php echo $lista[$contador] ?></td>
                                        <td><?php echo $lista[$contador + 1] ?></td>
                                        <td><?php echo $lista[$contador + 2] ?></td>
                                        <td><?php echo $lista[$contador + 3] ?></td>
                                        
                                    </tr>

                                    <?php
                                    $contador = $contador + 4;
                                }
                                
                                    ?>
                                    
			</tbody>                           
		</table>
                        </div>       
				</ul>		
			</div>
			<div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
                            <li><a href="iuRegistroSolicitud.php">NUEVA SOLICITUD</a></li>
                            <li><a href="iuTablaSolicitudes.php">PROYECTOS</a></li>
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
