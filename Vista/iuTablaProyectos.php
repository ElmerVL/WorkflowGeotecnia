<?php
session_start();
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
