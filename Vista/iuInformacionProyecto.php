<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
$rol = $_SESSION['rol'];

?>

<!DOCTYPE html >
<head>
    <title>PROYECTO</title>
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
                        <h2>Información de la solicitud</h2>
                        <?php
                        $id_proyecto = $_GET['i_p'];
                        ?>
                        <ul>
                                <?php echo "<form name='ingreso_sistema' method='post'>"; ?>
                            <div class="text_box">
                                <?php
                                require_once '../Controlador/ControladorProyecto.php';
                                $controlador_proyecto = new ControladorProyecto();
                                if($_GET['t']==1)
                                    $arreglo_datos = $controlador_proyecto->mostrar_datos_e_l($id_proyecto);
                                elseif($_GET['t']==2)
                                    $arreglo_datos = $controlador_proyecto->mostrar_datos_t_c($id_proyecto);
                                ?>
                                
                                <br />
                                <h4>Nombre del cliente:</h4>
                                <h6><?php echo $arreglo_datos[0]; ?></h6>
                                <br />
                                <h4>Ubicación del proyecto:</h4>
                                <h6><?php echo $arreglo_datos[1]; ?></h6>
                                <br />
                                <h4>Tipo de proyecto:</h4>
                                <h6><?php echo $arreglo_datos[2]; ?></h6>
                                <br />
                                <h4>Responsable:</h4>
                                <?php
                                include_once '../Controlador/ControladorIngeniero.php';
                                $controlador_ingeniero = new ControladorIngeniero();
                                $lista = $controlador_ingeniero->lista_ingeniero_seleccionado();
                                $contador = 0;
                                while ($contador <= sizeof($lista) - 1) {
                                    if ($arreglo_datos[3] == $lista[$contador]) {
                                        ?>
                                <h6><?php echo $lista[$contador + 1] . " " . $lista[$contador + 2]; ?></h6>
                                <br />
                                        <?php
                                    }
                                    $contador = $contador + 3;
                                }
                                ?>
                                <h4>Fecha de la solicitud:</h4>
                                <?php
                                $dia = date("d", strtotime($arreglo_datos[4]));
                                $mes = date("F", strtotime($arreglo_datos[4]));
                                if ($mes == "January")   $mes = "Enero";
                                if ($mes == "February")  $mes = "Febrero";
                                if ($mes == "March")     $mes = "Marzo";
                                if ($mes == "April")     $mes = "Abril";
                                if ($mes == "May")       $mes = "Mayo";
                                if ($mes == "June")      $mes = "Junio";
                                if ($mes == "July")      $mes = "Julio";
                                if ($mes == "August")    $mes = "Agosto";
                                if ($mes == "September") $mes = "Septiembre";
                                if ($mes == "October")   $mes = "Octubre";
                                if ($mes == "November")  $mes = "Noviembre";
                                if ($mes == "December")  $mes = "Diciembre";
                                $anio = date("Y", strtotime($arreglo_datos[4]));
                                ?>
                                <h6><?php echo $dia." de ".$mes.", ".$anio ?></h6>
                                <br />
                                <br />                                
                                <?php 
                                if($rol==2)
                                    echo '<input type="button" class="btn2" name="submit" href="#" value="Director"/>';
                                    elseif ($rol==3)
                                        echo '<input type="button" class="btn2" name="submit" href="#" value="Contador"/>';
                                        elseif ($rol==4){
                                            if($arreglo_datos[2] == "ensayo de laboratorio"){
                                                echo "<a type='button' class='btn2' name='submit' href='iuRegistroMuestra.php?i_p=$id_proyecto'>Añadir datos de muestra</a><br /><br />";
                                                echo "<a type='button' class='btn2' name='submit' href=#>Registrar ensayos</a><br /><br />";
                                                
                                            }
                                            elseif($arreglo_datos[2] == "trabajo de campo")
                                                echo '<input type="button" class="btn2" name="submit" href="#" value="Registrar alcance"/>';
                                        }elseif ($rol==5)
                                                    echo '<input type="button" class="btn2" name="submit" href="#" value="Auxiliar"/>';
                                                        elseif ($rol==6)
                                                            echo '<input type="button" class="btn2" name="submit" href="#" value="Tecnico"/>';
                                ?>                           
                                
                            </div>
                            </form>

                        </ul>		
                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
                            <?php if ($rol == 2)
                                echo "<li><a href='iuRegistroSolicitud.php'>NUEVA SOLICITUD</a></li>";
                                ?>
                            
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
