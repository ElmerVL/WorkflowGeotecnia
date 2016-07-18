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
                    <h2>Registro de resultados - Ensayos de laboratorio</h2>
                    <?php
                    require_once '../Controlador/ControladorProyecto.php';
                    $controlador_proyecto = new ControladorProyecto();
                    $id_proyecto = $_GET['i_p'];
                    $t_proy = $_GET['t_p'];
                    if($t_proy == 1){
                        $tipo_proyecto = 'EnsayoLaboratorio';
                        $cod_proyecto = $controlador_proyecto->conseguir_cod_proyecto_el($id_proyecto);
                    }else if($t_proy == 2){
                        $tipo_proyecto = 'TrabajoCampo';
                        $cod_proyecto = $controlador_proyecto->conseguir_cod_proyecto_tc($id_proyecto);
                    }
                    ?>
                    <ul>

                        <br />
                        <div id="dvContent" class="Content">
                            <form method="post" action="../Controlador/ControladorSubirArchivo.php?i_p=<?php echo $id_proyecto; ?>&t_p=<?php echo $t_proy; ?>&i_f=1" enctype='multipart/form-data'>
                                <br />
                                <h4>Archivo con resultado:</h4>
                                Archivos subidos:
                                <br />
                                <?php
                                $dir = (isset($_GET['dir'])) ? $_GET['dir'] : "../Archivos/$tipo_proyecto/$cod_proyecto/InformeFinal/";

                                if (file_exists($dir)) {
                                    $directorio = opendir($dir);
                                    while ($archivo = readdir($directorio)) {
                                        $carpetas = split("/", $dir);
                                        $dir2 = join("/", $carpetas);
                                        if ($archivo != "..") {
                                            if ($archivo != ".") {
                                                echo "<a href=\"?dir=$dir2\">$archivo </a> <a href=../Controlador/ControladorEliminarArchivo.php?d=$dir&n=$archivo&ip=$id_proyecto&tp=$t_proy&i_f=1> | ELIMINAR</a> <br>";
                                            }
                                        }
                                    }
                                    closedir($directorio);
                                } else {
                                    echo "no existe archivos subidos";
                                }
                                ?>
                                <br />
                                Archivo:
                                <input name ='archivo' type='file'  size='37' required='' />
                                <br /><br />
                                Descripción:
                                <textarea cols="30" id="editor1" name="descripcion" rows="2" style="resize: none;"></textarea>
                                <br /><br />
                                <br />
                                <?php
                                if($controlador_proyecto->verificar_informe_aprobado($id_proyecto, $t_proy) == 't') {
                                    echo "<h3>INFORME APROBADO</h3>";
                                } else {
                                    ?>
                                    <input type="submit" class="btn2" name="submit" value="Subir archivo" />
                                    <?php
                                }
                                ?>

                                <br /><br />
                            </form>
                        </div>


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
<style>
    /*CollapsiblePanel*/
    .ContainerPanel
    {
        width:400px;
        border:1px;
        border-color:#1052a0;
        border-style:double double double double;
    }
    .collapsePanelHeader
    {
        width:400px;
        height:30px;
        background-repeat:repeat-x;
        color:#000000;
        font-weight:bold;
    }
    .HeaderContent
    {
        float:left;
        padding-left:5px;
    }
    .Content
    {
        margin-top:-35px;
        margin-bottom: -20px;
        margin-right:5px;
        margin-left:5px;
    }
    .ArrowExpand
    {
        background-image: url(../CollapsiblePanel/images/expand_blue.jpg);
        width:13px;
        height:13px;
        float:right;
        margin-top:7px;
        margin-right:5px;
    }
    .ArrowExpand:hover
    {
        cursor:hand;
    }
    .ArrowClose
    {
        background-image: url(../CollapsiblePanel/images/collapse_blue.jpg);
        width:13px;
        height:13px;
        float:right;
        margin-top:7px;
        margin-right:5px;
    }
    .ArrowClose:hover
    {
        cursor:hand;
    }
</style>

<script src="CollapsiblePanel/_scripts/jquery-1.2.6.js" type="text/javascript"></script>
<script language="javascript">
    $(document).ready(function() {
        $("DIV.ContainerPanel > DIV.collapsePanelHeader > DIV.ArrowExpand").toggle(
            function() {
                $(this).parent().next("div.Content").show("fast");
                $(this).attr("class", "ArrowClose");
            },
            function() {
                $(this).parent().next("div.Content").hide("fast");
                $(this).attr("class", "ArrowExpand");
            });

    });
</script>