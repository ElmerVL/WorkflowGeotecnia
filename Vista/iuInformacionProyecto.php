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
    <script src="js/jquery-1.7.2.min.js"></script>
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
            <h1><a href="iuAdministrador.php">Laboratorio de <span>Geotecnia</span></a></h1>		
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
                        <h2>Información del proyecto</h2>
                        <?php
                        $id_proyecto = $_GET['i_p'];
                        ?>
                        <ul>
                            <form>
                                <div class="text_box">
                                    <?php
                                    require_once '../Controlador/ControladorProyecto.php';
                                    $controlador_proyecto = new ControladorProyecto();
                                    if ($_GET['t'] == 1)
                                        $arreglo_datos = $controlador_proyecto->mostrar_datos_e_l($id_proyecto);
                                    elseif ($_GET['t'] == 2)
                                        $arreglo_datos = $controlador_proyecto->mostrar_datos_t_c($id_proyecto);
                                    ?>

                                    <br />
                                    <h4>Nombre del proyecto:</h4>
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
                                    require_once '../Controlador/ControladorIngeniero.php';
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
                                    if ($mes == "January")
                                        $mes = "Enero";
                                    if ($mes == "February")
                                        $mes = "Febrero";
                                    if ($mes == "March")
                                        $mes = "Marzo";
                                    if ($mes == "April")
                                        $mes = "Abril";
                                    if ($mes == "May")
                                        $mes = "Mayo";
                                    if ($mes == "June")
                                        $mes = "Junio";
                                    if ($mes == "July")
                                        $mes = "Julio";
                                    if ($mes == "August")
                                        $mes = "Agosto";
                                    if ($mes == "September")
                                        $mes = "Septiembre";
                                    if ($mes == "October")
                                        $mes = "Octubre";
                                    if ($mes == "November")
                                        $mes = "Noviembre";
                                    if ($mes == "December")
                                        $mes = "Diciembre";
                                    $anio = date("Y", strtotime($arreglo_datos[4]));
                                    ?>
                                    <h6><?php echo $dia . " de " . $mes . ", " . $anio ?></h6>
                                    <br />
                                    <br />                                

                                </div>
                            </form>


                            <?php
                            if ($arreglo_datos[2] == "ensayo de laboratorio") {
                                ?>

                                <form name='ingreso_sistema' method='post'>
                                    <div class="text_box">
                                        <br />
                                        <h4>Informacion de ensayos registrados:</h4>  
                                        <ul>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Código</th>
                                                        <th scope="col">Tipo </th>
                                                        <th scope="col">Categoria</th>
                                                        <th scope="col">Nombre del ensayo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    require_once '../Controlador/ControladorEnsayoLaboratorio.php';
                                                    $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
                                                    $array_ensayos = $controlador_ensayo_laboratorio->mostrar_detalle_ensayos_registrados_resumido($id_proyecto);
                                                    $contador = 0;
                                                    if (sizeof($array_ensayos) <= 0) {
                                                    } else {
                                                        while ($contador <= sizeof($array_ensayos) - 1) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $array_ensayos[$contador] ?></td>
                                                                <td><?php echo $array_ensayos[$contador + 1]; ?></td>
                                                                <td><?php echo $array_ensayos[$contador + 2]; ?></td>
                                                                <td><?php echo $array_ensayos[$contador + 3]; ?></td>

                                                            </tr>
                                                            <?php
                                                            $contador = $contador + 4;
                                                        }
                                                    }
                                                    ?>
                                                </tbody> 

                                            </table>
                                        </ul>
                                        <br />
                                        <?php
                                        if ($rol == 2)
                                            echo "<a type='button' class='btn2' name='submit' href='iuConfirmacionEnsayos.php?i_p=$id_proyecto' >Ver detalle</a><br /><br />";
                                        elseif ($rol == 3)
                                            echo "<a type='button' class='btn2' name='submit' href='iuRegistroCliente.php?i_p=$id_proyecto&t=".$_GET['t']."'>Registrar cliente</a><br /><br />";
                                        elseif ($rol == 4)
                                            echo "<a type='button' class='btn2' name='submit' href='iuRegistroEnsayos.php?i_p=$id_proyecto&f_t=1'>Registrar Ensayo</a><br /><br />";
                                        elseif ($rol == 5)
                                            echo "<a type='button' class='btn2' name='submit' href='iuRegistroResultados.php?i_p=$id_proyecto&t_p=1'>Registrar Resultados</a><br /><br />";
                                        
                                        ?>
                                    </div>
                                </form>            
                            
                                <form name='ingreso_sistema' method='post'>
                                    <div class="text_box">
                                        <br />
                                        <h4>Informacion de muestras registradas:</h4>

                                        <?php
                                        require_once '../Controlador/ControladorMuestra.php';
                                        $controlador_muestra = new ControladorMuestra();
                                        $lista_datos = $controlador_muestra->mostrar_datos_muestra($id_proyecto);
                                        $contador = 0;
                                        if (sizeof($lista_datos) <= 0) {
                                            ?>
                                            <br />
                                            <h3>NO EXISTEN MUESTRAS REGISTRADAS</h3>
                                            <br />
                                            <?php
                                        } else {
                                            while ($contador <= sizeof($lista_datos) - 1) {
                                                ?>
                                                <br>
                                                <h3><?php echo $lista_datos[$contador]; ?></h3>
                                                <br>
                                                <h4>Ubicación general:</h4>
                                                <h6><?php echo $lista_datos[$contador + 4]; ?></h6>
                                                <br>
                                                <h4>Ubicación especifica:</h4>
                                                <h6><?php echo $lista_datos[$contador + 5]; ?></h6>
                                                <br>
                                                <h4>Fecha de extracion de la muestra:</h4>
                                                <h6><?php echo $lista_datos[$contador + 7]; ?></h6>
                                                <br>
                                                <?php
                                                $contador = $contador + 11;
                                            }
                                        }

                                        if ($rol == 4)
                                            echo "<a type='button' class='btn2' name='submit' href='iuRegistroMuestra.php?i_p=$id_proyecto'>Añadir muestra</a><br /><br />";
                                        ?>
                                    </div>
                                </form>

                            
                                <?php
                            }
                            elseif ($arreglo_datos[2] == "trabajo de campo"){
                                require_once '../Controlador/ControladorAlcance.php';
                                $controlador_alcance = new ControladorAlcance();
                                $alcance_creado = $controlador_alcance->alcance_registrado($id_proyecto);
                                
                                if ($alcance_creado) {
                                    if ($rol == 2)
                                        echo "<a type='button' class='btn2' name='submit' href='iuInformacionAlcance.php?i_p=$id_proyecto&o=f'>Ver alcance</a>";
                                    elseif ($rol == 3){
                                        echo "<a type='button' class='btn2' name='submit' href='iuInformacionAlcance.php?i_p=$id_proyecto&o=f'>Ver alcance</a><br /><br />";
                                        echo "<a type='button' class='btn2' name='submit' href='iuRegistroCliente.php?i_p=$id_proyecto&t=".$_GET['t']."'>Registrar cliente</a><br /><br />";
                                    }elseif ($rol == 4)
                                        echo "<a type='button' class='btn2' name='submit' href='iuInformacionAlcance.php?i_p=$id_proyecto&o=f'>Ver alcance</a>";
                                    elseif ($rol == 5){
                                        echo "<a type='button' class='btn2' name='submit' href='iuInformacionAlcance.php?i_p=$id_proyecto&o=f'>Ver alcance</a>";
                                        echo "</br></br><a type='button' class='btn2' name='submit' href='iuRegistroResultados.php?i_p=$id_proyecto&t_p=2'>Registrar Resultados</a><br /><br />";
                                    } elseif ($rol == 6)
                                        echo "<a type='button' class='btn2' name='submit' href='iuInformacionAlcance.php?i_p=$id_proyecto&o=f'>Ver alcance</a>";
                                    
                                }else{
                                    if ($rol == 2)
                                        echo "NO EXISTE ALCANCE";
                                    elseif ($rol == 3)
                                        echo "NO EXISTE ALCANCE";
                                    elseif ($rol == 4)
                                        echo "<a type='button' class='btn2' name='submit' href='iuCrearAlcanceP1.php?i_p=$id_proyecto'>Crear alcance</a>";
                                    elseif ($rol == 5)
                                        echo "NO EXISTE ALCANCE";
                                    elseif ($rol == 6)
                                        echo "NO EXISTE ALCANCE";
                                }
                            }
                                    ?>   


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
