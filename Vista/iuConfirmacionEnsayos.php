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
                    <div id="body">
                        <h2>Confirmar los ensayos de laboratorio para el proyecto</h2>
                        <form method='post'>
                        <ul>
                            <table style="max-width: 645px">
                                <thead>
                                    <tr>
                                        <th scope="col">Código</th>
                                        <th scope="col">Tipo </th>
                                        <th scope="col" style="width: 150px">Categoria</th>
                                        <th scope="col" style="width: 240px">Nombre del ensayo</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Pre. unit.</th>
                                        <th scope="col">Tiempo APROX.</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require_once '../Controlador/ControladorEnsayoLaboratorio.php';
                                    $id_proyecto = $_GET['i_p'];
                                    $controlador_ensayo_laboratorio = new ControladorEnsayoLaboratorio();
                                    $array_ensayos = $controlador_ensayo_laboratorio->mostrar_detalle_ensayos_registrados($id_proyecto);
                                    $contador = 0;
                                    while ($contador <= sizeof($array_ensayos) - 1) {
                                        ?>
                                        <tr>
                                            <td><?php echo $array_ensayos[$contador] ?></td>
                                            <td><?php echo $array_ensayos[$contador + 1]; ?></td>
                                            <td><?php echo $array_ensayos[$contador + 2]; ?></td>
                                            <td><?php echo $array_ensayos[$contador + 3]; ?></td>
                                            <td><?php echo $array_ensayos[$contador + 4]; ?></td>
                                            <td><?php echo $array_ensayos[$contador + 5]; ?></td>
                                            <td><?php echo $array_ensayos[$contador + 6]; ?></td>
                                            <td><?php echo $array_ensayos[$contador + 7]; ?></td>
                                            <?php echo "<td><a href='../Controlador/ControladorEliminarDetalleEnsayos.php?i_p=$id_proyecto&c_e=$array_ensayos[$contador]'>ELIMINAR</a></td>"; ?>
                                        </tr>
                                        <?php
                                        $contador = $contador + 8;
                                    }
                                    ?>
                                </tbody> 
                            </table>
                            <br /><br />
                            COSTO TOTAL DEL PROYECTO:
                            <br /><br />
                            <h3><?php echo $costo = $controlador_ensayo_laboratorio->sumar_costo_ensayos($id_proyecto);?> bolivianos</h3>
                            <br />
                            TIEMPO TOTAL APROXIMADO DEL PROYECTO:
                            <br /><br />
                            <h3><?php echo $controlador_ensayo_laboratorio->calcular_tiempo_proximado_ensayos($id_proyecto);?> días</h3>
                            </ul>
                            <br />
                            <?php 
                            
                            if ($rol == 2)
                                echo '<input type="button" class="btn2" name="submit" href="#" value="Director"/>';
                            elseif ($rol == 3){
                                if($costo<10000)
                                    echo "<a type='button' class='btn2' name='submit' href='iuCrearOrdenDePago.php?i_p=$id_proyecto'>Crear orden de pago</a><br /><br />";
                                else {
                                    echo "<a type='button' class='btn2' name='submit' href='iuCrearContrato.php?i_p=$id_proyecto'>Crear contrato</a><br /><br />";
                                }
                                echo "<a type='button' class='btn2' name='submit' href='iuInformacionProyecto.php?i_p=$id_proyecto&t=1'>Terminar</a><br /><br />"; 
                            }elseif ($rol == 4){
                                echo "<a type='button' class='btn2' name='submit' href='iuRegistroEnsayos.php?i_p=$id_proyecto&f_t=1'>Registrar Mas</a><br /><br />"; 
                                echo "<a type='button' class='btn2' name='submit' href='iuInformacionProyecto.php?i_p=$id_proyecto&t=1'>Terminar</a><br /><br />"; 
                            }elseif ($rol == 5)
                                echo '<input type="button" class="btn2" name="submit" href="#" value="Auxiliar"/>';
                            elseif ($rol == 6)
                                echo '<input type="button" class="btn2" name="submit" href="#" value="Tecnico"/>';
                                        
                            
                            
                            
                            ?>
                            <br />
                        </form>
                    </div>
                    
                </div></div>	
        </div>

        <div id="footer">
            <p class="left">&copy; 2014 Jimena Salazar Soto</p>
        </div>	
    </div>	
</body>
</html>
