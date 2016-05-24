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
    <link href="css/style_3.css" rel="stylesheet" type="text/css" />
    <link href="js/custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css" />
    <link href="js/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/jquery-ui-1.8.20.js"></script>
    <script src="textos2/ckeditor.js"></script>
    <link rel="stylesheet" href="textos2/samples/sample.css">
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
                        <h2>Alcance</h2>

                        <?php
                        $id_usuario = $_SESSION['id_usuario'];
                        $id_proyecto = $_GET['i_p'];
                        ?>
                        <ul>
                            <form method="post" action="../Controlador/ControladorVistaAlcance.php?i_p=<?php echo $id_proyecto;?>">

                                <br />
                                <?php
                                require_once '../Controlador/ControladorAlcance.php';
                                $controlador_alcance = new ControladorAlcance();
                                $arreglo_datos_alcance = $controlador_alcance->mostrar_datos_alcance($id_proyecto);
                                $arreglo_datos_alcance[0] = str_replace("<p>", "", $arreglo_datos_alcance[0]);
                                $arreglo_datos_alcance[0] = str_replace("</p>", "", $arreglo_datos_alcance[0]);
                                $arreglo_datos_alcance[2] = str_replace("<p>", "", $arreglo_datos_alcance[2]);
                                $arreglo_datos_alcance[2] = str_replace("</p>", "", $arreglo_datos_alcance[2]);
                                $arreglo_datos_alcance[3] = str_replace("<p>", "", $arreglo_datos_alcance[3]);
                                $arreglo_datos_alcance[3] = str_replace("</p>", "", $arreglo_datos_alcance[3]);
                                $arreglo_datos_alcance[4] = str_replace("<p>", "", $arreglo_datos_alcance[4]);
                                $arreglo_datos_alcance[4] = str_replace("</p>", "", $arreglo_datos_alcance[4]);
                                $arreglo_datos_alcance[8] = str_replace("<p>", "", $arreglo_datos_alcance[8]);
                                $arreglo_datos_alcance[8] = str_replace("</p>", "", $arreglo_datos_alcance[8]);
                                $arreglo_datos_alcance[9] = str_replace("<p>", "", $arreglo_datos_alcance[9]);
                                $arreglo_datos_alcance[9] = str_replace("</p>", "", $arreglo_datos_alcance[9]);
                                
                                ?>
                                <h4>1. Antecedente</h4>
                                <?php
                                echo "<h6>" . $arreglo_datos_alcance[0];
                                if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=0>Editar</a>";
                                }
                                ?>
                                </h6><br />
                                <h4>2. Objetivo</h4>
                                <?php
                                echo "<h6>" . $arreglo_datos_alcance[1];
                                if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=1>Editar</a>";
                                }
                                ?>
                                </h6><br />
                                <h4>3. Trabajos a realizar</h4>
                                <?php
                                if ($arreglo_datos_alcance[2] != "no existe") {
                                    echo "<h7>3.1. Trabajo de campo.</h7>";
                                    echo "<h6>" . $arreglo_datos_alcance[2];
                                    if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=2>Editar</a>";
                                }
                                }
                                if ($arreglo_datos_alcance[3] != "no existe") {
                                    echo "</h6><br /><h7>3.2. Trabajo de gabinete.</h7>";
                                    echo "<h6>" . $arreglo_datos_alcance[3];
                                    if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=3>Editar</a>";
                                }
                                }
                                if ($arreglo_datos_alcance[4] != "no existe") {
                                    echo "</h6><br /><h7>3.3. Trabajo de laboratorio.</h7>";
                                    echo "<h6>" . $arreglo_datos_alcance[4];
                                    if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=4>Editar</a>";
                                }
                                }
                                ?>
                                </h6><br />
                                <h4>4. Inicio y duración</h4>
                                <?php
                                echo "<h6> El inicio de los trabajos de campo "
                                . "será programado de acuerdo a la disponibilidad"
                                . " de personal y equipo del Laboratorio de Geotecnia."
                                . " El estudio tendrá una duración de " . $arreglo_datos_alcance[5] . ""
                                . " calendario después de haber iniciado el trabajo de campo. ";
                                if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=5>Editar</a>";
                                }
                                ?>
                                </h6><br />
                                <h4>5. Precio del estudio</h4>
                                <?php
                                echo "<h6> El precio total del trabajo descrito "
                                . "es de Bs." . $arreglo_datos_alcance[6] . " "
                                . "que incluye los gastos de movilización, desmovilización, "
                                . "instalación del equipo, suministro de materiales y herramientas."
                                . " El precio estipulado incluye los impuestos de ley. ";
                                if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=6>Editar</a>";
                                }
                                ?>
                                </h6><br />
                                <h4>6. Forma de pago</h4>
                                <?php
                                echo "<h6>" . $arreglo_datos_alcance[7];
                                if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=7>Editar</a>";
                                }
                                ?>
                                </h6><br />
                                <h4>7. Requerimientos adicionales</h4>
                                <?php
                                echo "<h6>" . $arreglo_datos_alcance[8];
                                if ($rol == 4) {
                                    echo " <a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=8>Editar</a>";
                                }
                                ?>
                                </h6><br />
                                <input type='submit' class='btn2' value='Ver documento' />
                                <br /><br />
                            </form>
                            <br />
                            <h4>OBERVACIONES.</h4>
                            <?php
                            $observacion_realizada = $controlador_alcance->observacion_registrada($id_proyecto);
                            if ($rol == 2) {
                                if($observacion_realizada){
                                    echo "<h6>$arreglo_datos_alcance[9]<a href = iuEdicionValorAlcance.php?i_p=$id_proyecto&i=9>Editar</a></h6>";
                                }else{
                                    echo "<form method='post' action = '../Controlador/ControladorObservacionesDirector.php?i_p=$id_proyecto'>";
                            ?>
                            <textarea class="ckeditor" cols="52,7" id="editor1" name="antecedente" rows="10"></textarea>    
                            </form>
                            <?php
                                }
                            }
                            elseif ($rol == 4) {
                                if($observacion_realizada){
                                    echo "<h3>$arreglo_datos_alcance[9]</h3>";
                                }else{
                                    echo "<h3> SIN OBSERVACIONES </h3>";
                            ?>
                            <?php
                                }
                            }
                            ?>
                            </form>
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