<?php
session_start();
?>

<!DOCTYPE html >
<head>
    <title>INGENIERO</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="copyright" content="" />	  
    <meta name="revisit-after" content="3 days" />
    <link href="css/style_1.css" rel="stylesheet" type="text/css" />
    
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
                        <h2>Registrar ensayos de laboratorio para el proyecto</h2>
                        <?php
                        require_once '../Controlador/ControladorEnsayoLaboratorio.php';
                        $id_usuario = $_SESSION['id_usuario'];
                        $id_proyecto = $_GET['i_p'];
                        $tipo_trabajo = $_GET['f_t'];
                        $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
                        if ($tipo_trabajo == '1') {
                            echo "<form method='post' action='../Controlador/ControladorRegistroEnsayos.php?i_u=$id_usuario&i_p=$id_proyecto'>";
                            ?>
                            <ul>
                                <h4>Caracterización: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        include_once '../Controlador/ControladorEnsayoLaboratorio.php';
                                        $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'caracterizacion');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador]; ?><input type="checkbox" value="<?php echo $lista[$contador]; ?>" name="caracterizacion[]" id="f1" /></th>
                                                
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>

                                    </tbody> 

                                </table>

                                <h4>Parametros de deformación: </h4>
                                <table>
                                    
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Parametros de deformación');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>

                                    </tbody>
                                </table>

                                <table>
                                    
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Param. de resistencia CD');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>

                                    </tbody>                           
                                </table>

                                <h4>Parametros de resistencia en condición no drenada: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Param. de resistencia CND');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>

                                    </tbody>  
                                </table>

                                <h4>Parametros de hidráulicos: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Parametros hidráulicos');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <h4>Suelos no saturados: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Suelos no saturados');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody>                         
                                </table>

                                <h4>Suelos especiales: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Suelos especiales');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <h4>Resistencia de agregados: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('suelo', 'Resistencia de agregados');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <input type="submit" class="btn2" name="submit" value="Registrar" />                            

                            </ul>	
                            </form>
                            <?php
                        } elseif ($tipo_trabajo == '2') {
                            echo "<form name='ingreso_sistema' method='post' action='../Controlador/ControladorRegistroMuestra.php?i_u=$id_usuario&i_p=$id_proyecto'>";
                            ?>
                            <ul>
                                <h4>Caracterización: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Caracterizacion');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <h4>Durabilidad: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Durabilidad');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <h4>Resistencia: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Resistencia');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>
                                </table>

                                <h4>Resistencia al corte: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Resistencia al corte');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <h4>Tracción: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Tracción');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <h4>Abrasión: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Abrasión');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <h4>Extracción de nucleos: </h4>
                                <table>
                                    <tbody>
                                        <?php
                                        $lista = $controlador_ensayo_laboratorio->mostrar_tabla_ensayo_categoria('roca', 'Extracción de nucleos');
                                        $contador = 0;
                                        while ($contador <= sizeof($lista) - 1) {
                                            ?>
                                            <tr>
                                                <td><?php echo $lista[$contador + 1] ?></td>
                                                <th scope="row"><?php echo $lista[$contador] ?><input type="checkbox" value="cell" name="caracterizacion" id="f1" /></th>
                                            </tr>
                                            <?php
                                            $contador = $contador + 2;
                                        }
                                        ?>
                                    </tbody> 
                                </table>

                                <input type="submit" class="btn2" name="submit" value="Registrar" />                            

                            </ul>	
                            </form>
                            <?php
                        }
                        ?>

                    </div>
                    <div id="sub">
                        <h2>MENÚ</h2>
                        <ul class="links">
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
