<?php
session_start();
$rol = $_SESSION['rol'];
$i_u = $_SESSION['id_usuario'];
if (!$i_u) {
    header("Location: ../index.php");
} else {
    if ($rol != 2 && $rol !=3) {
        session_destroy();
        header("Location: ../index.php");
    }
}
?>
<!DOCTYPE html >
<head>
	<title>WORKFLOW</title>
    <link rel="shortcut icon" href="../Vista/img/icono">
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
                <?php
                if($rol == 1){
                ?>
                <li class="on"><a href="iuAdministrador.php">Principal</a></li>
                <?php
                }
                if($rol == 2){
                ?>
                <li class="on"><a href="iuDirector.php">Principal</a></li>
                <?php
                }
                if($rol == 3){
                ?>
                <li class="on"><a href="iuContador.php">Principal</a></li>
                <?php
                }
                if($rol == 4){
                ?>
                <li class="on"><a href="iuIngeniero.php">Principal</a></li>
                <?php
                }
                if($rol == 5){
                ?>
                <li class="on"><a href="iuAuxiliar.php">Principal</a></li>
                <?php
                }
                if($rol == 6){
                ?>
                <li class="on"><a href="iuTecnico.php">Principal</a></li>
                <?php
                }
                ?>
                <li class="on"><a href="iuCalendario.php">Calendario</a></li>
                <li class="on"><a href="iuWorkFlow.php">Workflow</a></li>
            </ul>
		<div id="content"><div>
			<div id="body">
				<h2>Lista de solicitudes</h2>
                                <?php $id_usuario = $_SESSION['id_usuario'];?>
				<ul>
                     
                        <div class="text_box">
                            <table style="max-width: 730px;">
			<thead>
				<tr>
                                    <th scope="col" style="width: 70px;">Código</th>
					<th scope="col" style="width: 150px;">Nombre del proyecto</th>
					<th scope="col" style="width: 150px;">Ubicación</th>
					<th scope="col" style="width: 140px;">Tipo de proyecto</th>
                                        <th scope="col" style="width: 50px;">Hab.</th>
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
                                        <td><a href='../Vista/iuInformacionSolicitud.php?i_s=<?php echo $lista[$contador]; ?>'><?php echo $lista[$contador+1]; ?></a></td>
                                        <td><?php echo $lista[$contador + 2]; ?></td>
                                        <td><?php echo $lista[$contador + 3]; ?></td>
                                        <td><?php echo $lista[$contador + 4]; ?></td>
                                        <td><?php 
                                        if($_SESSION['rol'] == 2){
                                            if($lista[$contador + 5] == 't'){
                                                echo $controlador_solicitud->mostrar_cod_proyecto($lista[$contador]);
                                            }else{
                                            ?>
                                            <a href="../Controlador/ControladorHabilitarSolicitudes.php?i_s=<?php echo $lista[$contador]; ?>">Habilitar</a>
                                            <?php
                                            }
                                        }else{
                                            if($lista[$contador + 5] == 't'){
                                                echo 'Habilitado';
                                            }else{
                                                echo 'No habili.';
                                            }
                                        }
                                        ?></td>
                                    </tr>

                                    <?php
                                    $contador = $contador + 6;
                                }
                                
                                    ?>
                                    
			</tbody>                           
		</table>
                        </div>       
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
