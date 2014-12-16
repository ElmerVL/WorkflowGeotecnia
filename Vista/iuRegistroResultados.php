<?php
session_start();
$id_usuario = $_SESSION['id_usuario'];
$rol = $_SESSION['rol'];
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
                        <h2>Registro de resultados - Ensayos de laboratorio</h2>
                        <?php
                        $id_proyecto = $_GET['i_p'];
                        ?>
                        <ul>
                            <?php
                            require_once '../Controlador/ControladorProyecto.php';
                            $controlador_proyecto = new ControladorProyecto();
                            if ($_GET['t_p'] == 1) {
                                require_once '../Controlador/ControladorProyecto.php';
                                $controlador_proyecto = new ControladorProyecto();
                                $cod_solicitud = $controlador_proyecto->conseguir_cod_solicitud_el($id_proyecto);
                                ?>

                                <br />
                                <h4>Ensayos realizados:</h4>  

                                <?php
                                require_once '../Controlador/ControladorEnsayoLaboratorio.php';
                                $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
                                $array_ensayos = $controlador_ensayo_laboratorio->mostrar_detalle_ensayos_registrados_resumido($id_proyecto);
                                $contador = 0;
                                if (sizeof($array_ensayos) <= 0) {
                                    
                                } else {
                                    while ($contador <= sizeof($array_ensayos) - 1) {
                                        
                                        ?>
                                        <div id="ContainerPanel" class="ContainerPanel">
                                            <div id="header" class="collapsePanelHeader">
                                                <div id="dvHeaderText" class="HeaderContent"><?php echo $array_ensayos[$contador] . " - " . $array_ensayos[$contador + 3]; ?></div>
                                                <div id="dvArrow" class="ArrowExpand" style="background-image: url(CollapsiblePanel/images/27936.png);"></div>
                                            </div>
                                            <div id="dvContent" class="Content" style="display:none">
                                                <form method="post" action="../Controlador/ControladorSubirArchivo.php?i_p=<?php echo $id_proyecto; ?>&e_l=<?php echo $array_ensayos[$contador]; ?>" enctype='multipart/form-data'>
                                                    <br />
                                                    <h4>Archivo con resultado:</h4>  
                                                    Archivos subidos:
                                                    <br />
                                                    <?php
                                                    $dir = (isset($_GET['dir'])) ? $_GET['dir'] : "../Archivos/EnsayoLaboratorio/$cod_solicitud/$array_ensayos[$contador]/";
                                                    if (file_exists($dir)) {
                                                        $directorio = opendir($dir);
                                                        while ($archivo = readdir($directorio)) {
                                                            $carpetas = split("/", $dir);
                                                            $dir2 = join("/", $carpetas);
                                                            if ($archivo != "..") {
                                                                if ($archivo != ".") {
                                                                    echo "<a href=\"?dir=$dir2\">$archivo</a><br>";
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
                                                    <input type="submit" class="btn2" name="submit" value="Subir archivo" /> 
                                                    <br /><br />
                                                    <a type='button' class='btn2' name='submit' href='#'>Terminar</a>
                                                    <br /><br />
                                                </form>
                                            </div>
                                        </div>
                                        <br />      

                                        <?php
                                        $contador = $contador + 4;
                                    }
                                }
                                ?>
                                <br />
                                <?php
                                if ($rol == 5)
                                    echo "<a type='button' class='btn2' name='submit' href='#'>Registrar Resultados</a><br /><br />";
                                ?>
                                <?php
                            }
                            elseif ($_GET['t_p'] == 2) {
                                
                                require_once '../Controlador/ControladorProyecto.php';
                                $controlador_proyecto = new ControladorProyecto();
                                $cod_solicitud = $controlador_proyecto->conseguir_cod_solicitud_tc($id_proyecto);
                                
                                require_once '../Controlador/ControladorAlcance.php';
                                $controlador_alcance = new ControladorAlcance();
                                $alcance_creado = $controlador_alcance->alcance_registrado($id_proyecto);

                                $arreglo_datos_alcance = $controlador_alcance->mostrar_datos_alcance($id_proyecto);
                                $arreglo_datos_alcance[2] = str_replace("<p>", "", $arreglo_datos_alcance[2]);
                                $arreglo_datos_alcance[2] = str_replace("</p>", "", $arreglo_datos_alcance[2]);
                                $arreglo_datos_alcance[3] = str_replace("<p>", "", $arreglo_datos_alcance[3]);
                                $arreglo_datos_alcance[3] = str_replace("</p>", "", $arreglo_datos_alcance[3]);
                                $arreglo_datos_alcance[4] = str_replace("<p>", "", $arreglo_datos_alcance[4]);
                                $arreglo_datos_alcance[4] = str_replace("</p>", "", $arreglo_datos_alcance[4]);
                                if ($alcance_creado) {
                                    ?>
                                    
                                        <?php
                                        if ($arreglo_datos_alcance[2] != "no existe") {
                                            ?>
                                <div id="ContainerPanel" class="ContainerPanel">
                                            <div id="header" class="collapsePanelHeader">
                                                <div id="dvHeaderText" class="HeaderContent">Trabajo de Campo</div>
                                                <div id="dvArrow" class="ArrowExpand" style="background-image: url(CollapsiblePanel/images/27936.png);"></div>
                                            </div>
                                            <div id="dvContent" class="Content" style="display:none">
                                                <form method="post" action="../Controlador/ControladorSubirArchivoTC.php?i_p=<?php echo $id_proyecto; ?>&t_r=1" enctype='multipart/form-data'>
                                                    <br />
                                                    <h4>Archivo con resultado:</h4>  
                                                    Archivos subidos:
                                                    <br />
                                                    <?php
                                                    $dir = (isset($_GET['dir'])) ? $_GET['dir'] : "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_campo/";
                                                    if (file_exists($dir)) {
                                                        $directorio = opendir($dir);
                                                        while ($archivo = readdir($directorio)) {
                                                            $carpetas = split("/", $dir);
                                                            $dir2 = join("/", $carpetas);
                                                            if ($archivo != "..") {
                                                                if ($archivo != ".") {
                                                                    echo "<a href=\"?dir=$dir2\">$archivo</a><br>";
                                                                }
                                                            }
                                                        }
                                                        closedir($directorio);
                                                    } else {
                                                        echo "No existen archivos subidos";
                                                    }
                                                    ?>
                                                    <br />
                                                    Archivo: 
                                                    <input name ='archivo' type='file'  size='37' required='' />
                                                    <br /><br />
                                                    Descripción: 
                                                    <textarea cols="30" id="editor1" name="descripcion" rows="2" style="resize: none;"></textarea>
                                                    <br /><br />
                                                    <input type="submit" class="btn2" name="submit" value="Subir archivo" /> 
                                                    <br /><br />
                                                </form>
                                            </div>
                                    </div>
                                </br>
                                            <?php
                                        }
                                        if ($arreglo_datos_alcance[3] != "no existe") {
                                            ?>
                                <div id="ContainerPanel" class="ContainerPanel">
                                            <div id="header" class="collapsePanelHeader">
                                                <div id="dvHeaderText" class="HeaderContent">Trabajo de Gabinete</div>
                                                <div id="dvArrow" class="ArrowExpand" style="background-image: url(CollapsiblePanel/images/27936.png);"></div>
                                            </div>
                                            <div id="dvContent" class="Content" style="display:none">
                                                <form method="post" action="../Controlador/ControladorSubirArchivoTC.php?i_p=<?php echo $id_proyecto; ?>&t_r=2" enctype='multipart/form-data'>
                                                    <br />
                                                    <h4>Archivo con resultado:</h4>  
                                                    Archivos subidos:
                                                    <br />
                                                    <?php
                                                    $dir = (isset($_GET['dir'])) ? $_GET['dir'] : "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_gabinete/";
                                                    if (file_exists($dir)) {
                                                        $directorio = opendir($dir);
                                                        while ($archivo = readdir($directorio)) {
                                                            $carpetas = split("/", $dir);
                                                            $dir2 = join("/", $carpetas);
                                                            if ($archivo != "..") {
                                                                if ($archivo != ".") {
                                                                    echo "<a href=\"?dir=$dir2\">$archivo</a><br>";
                                                                }
                                                            }
                                                        }
                                                        closedir($directorio);
                                                    } else {
                                                        echo "No existen archivos subidos";
                                                    }
                                                    ?>
                                                    <br />
                                                    Archivo: 
                                                    <input name ='archivo' type='file'  size='37' required='' />
                                                    <br /><br />
                                                    Descripción: 
                                                    <textarea cols="30" id="editor1" name="descripcion" rows="2" style="resize: none;"></textarea>
                                                    <br /><br />
                                                    <input type="submit" class="btn2" name="submit" value="Subir archivo" /> 
                                                    <br /><br />
                                                </form>
                                            </div>
                                    </div>
                                </br>
                                            <?php
                                        }
                                        if ($arreglo_datos_alcance[4] != "no existe") {
                                            ?>
                                <div id="ContainerPanel" class="ContainerPanel">
                                            <div id="header" class="collapsePanelHeader">
                                                <div id="dvHeaderText" class="HeaderContent">Trabajo de Laboratorio</div>
                                                <div id="dvArrow" class="ArrowExpand" style="background-image: url(CollapsiblePanel/images/27936.png);"></div>
                                            </div>
                                            <div id="dvContent" class="Content" style="display:none">
                                                <form method="post" action="../Controlador/ControladorSubirArchivoTC.php?i_p=<?php echo $id_proyecto; ?>&t_r=3" enctype='multipart/form-data'>
                                                    <br />
                                                    <h4>Archivo con resultado:</h4>  
                                                    Archivos subidos:
                                                    <br />
                                                    <?php
                                                    $dir = (isset($_GET['dir'])) ? $_GET['dir'] : "../Archivos/TrabajoCampo/$cod_solicitud/trabajo_de_laboratorio/";
                                                    if (file_exists($dir)) {
                                                        $directorio = opendir($dir);
                                                        while ($archivo = readdir($directorio)) {
                                                            $carpetas = split("/", $dir);
                                                            $dir2 = join("/", $carpetas);
                                                            if ($archivo != "..") {
                                                                if ($archivo != ".") {
                                                                    echo "<a href=\"?dir=$dir2\">$archivo</a><br>";
                                                                }
                                                            }
                                                        }
                                                        closedir($directorio);
                                                    } else {
                                                        echo "No existen archivos subidos";
                                                    }
                                                    ?>
                                                    <br />
                                                    Archivo: 
                                                    <input name ='archivo' type='file'  size='37' required='' />
                                                    <br /><br />
                                                    Descripción: 
                                                    <textarea cols="30" id="editor1" name="descripcion" rows="2" style="resize: none;"></textarea>
                                                    <br /><br />
                                                    <input type="submit" class="btn2" name="submit" value="Subir archivo" /> 
                                                    <br /><br />
                                                </form>
                                            </div>
                                    </div>
                                </br>
                                            <?php
                                        }
                                        ?>

                                    <?php
                                } else {
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
                            if ($rol == 2)
                                echo "<li><a href='iuRegistroSolicitud.php'>NUEVA SOLICITUD</a></li>";
                            ?>

                            <li><a href="iuTablaProyectos.php?f=0">PROYECTOS</a></li>
                            <li><a href="../Vista/iuCalendario.php">CALENDARIO</a></li>
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