<?php
session_start();
$rol = $_SESSION['rol'];
$i_u = $_SESSION['id_usuario'];
if (!$i_u) {
    header("Location: ../index.php");
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
    <script src="../Vista/js/jquery-1.3.2.min.js" type="text/javascript"></script>
        <script>
        setInterval(function() {
            $("#noticias").load(location.href+" #noticias>*","");
        }, 4000);
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
                    <div id="main">
                        
                        <h2>Lista de proyectos</h2>
                        <?php echo "<form name='ingreso_sistema' method='post' action='../Controlador/ControladorFiltroProyectos.php'>"?>
                                <br />
                        <h6>Seleccione proyectos:</h6>
                                    <br /><br />
                                    <ul class="fieldlist">
                                        <li><input type="radio" name="filtro" id="f41" value="0" checked /> 
                                            <label for="f41">Todos</label></li>
                                        <li><input type="radio" name="filtro" id="f43" value="1" /> 
                                            <label for="f43">Ensayos de laboratorio</label></li>
                                        <li><input type="radio" name="filtro" id="f42" value="2" /> 
                                            <label for="f42">Estudios geotecnicos</label></li>
                                    </ul>
                                    <p><label>&nbsp;</label> <input type="submit" value="Mostrar" class="btn" /></p>
                                
                            </form>
                        
                        <?php
                        $id_usuario = $_SESSION['id_usuario'];
                        $rol = $_SESSION['rol'];
                        $filtro = $_GET['f'];
                        ?>
                        <ul>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;" scope="col">Código</th>
                                            <th style="width: 120px;" scope="col">Responsable</th>
                                            <th style="width: 130px;" scope="col">Nombre del proyecto</th>
                                            <th style="width: 170px;" scope="col">Tipo de proyecto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once '../Controlador/ControladorProyecto.php';
                                        $controlador_proyecto = new ControladorProyecto();
                                        if ($rol == 4) {
                                            $lista = $controlador_proyecto->mostrar_tabla_ingeniero($filtro, $id_usuario);
                                        } else {
                                            $lista = $controlador_proyecto->mostrar_tabla($filtro);
                                        }
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
                                            $contador = $contador + 5;
                                        }
                                        ?>

                                    </tbody>                           
                                </table>
                        </ul>		
                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
                            <?php
                            if ($rol == 3) {
                                ?>
                                <li><a href='iuRegistroSolicitud.php'>NUEVA SOLICITUD</a></li>
                                <?php
                            }
                            if ($rol == 2) {
                                ?>
                                <li><a href='iuFiltroReporte.php'>REPORTES</a></li>
                                <?php
                            }
                            ?>
                            <li><a href="iuTablaProyectos.php?f=0">PROYECTOS</a></li>
                            <li><a href="iuCalendario.php">CALENDARIO</a></li>
                            <li><a href="../Controlador/ControladorFinalizarSesion.php">CERRAR SESION</a></li>
                        </ul>
                    </div>
                    <div id="noticias" style="background-color: lightsalmon;">
                            <h2>ULTIMO</h2>
                            <?php
                                require_once '../Controlador/ControladorUltimo.php';
                                $controlador_ultimo = new ControladorUltimo();
                                $lista = $controlador_ultimo->mostrar_10_filas();
                                $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            echo $lista[$contador + 3]."</br>";
                                            $contador = $contador+4;
                                        }
                            ?>
			</div>
                </div></div>	
        </div>

        <div id="footer">
            <p class="left">&copy; 2014 Jimena Salazar Soto</p>
        </div>	
    </div>	
</body>
</html>
