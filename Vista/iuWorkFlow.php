<?php
session_start();
$rol = $_SESSION['rol'];
$i_u = $_SESSION['id_usuario'];
?>
<!DOCTYPE html >
<hmtl>
<head>
<title>WORKFLOW</title>
    <link rel="shortcut icon" href="../Vista/img/icono" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="copyright" content="" />	  
    <meta name="revisit-after" content="3 days" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    
    <script src="js/jquery.min.js"></script>
    <script src="js/cytoscape.min.js"></script>
    <script src="js/jquery.qtip.min.js"></script>
    <link href="css/jquery.qtip.min.css" rel="stylesheet" type="text/css" />
    <script src="js/cytoscape-qtip.js"></script>
    <script src="code.js"></script>
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
                if ($rol == 1) {
                    ?>
                    <li class="on"><a href="iuAdministrador.php">Principal</a></li>
                    <?php
                }
                if ($rol == 2) {
                    ?>
                    <li class="on"><a href="iuDirector.php">Principal</a></li>
                    <?php
                }
                if ($rol == 3) {
                    ?>
                    <li class="on"><a href="iuContador.php">Principal</a></li>
                    <?php
                }
                if ($rol == 4) {
                    ?>
                    <li class="on"><a href="iuIngeniero.php">Principal</a></li>
                    <?php
                }
                if ($rol == 5) {
                    ?>
                    <li class="on"><a href="iuAuxiliar.php">Principal</a></li>
                    <?php
                }
                if ($rol == 6) {
                    ?>
                    <li class="on"><a href="iuTecnico.php">Principal</a></li>
                    <?php
                }
                ?>
                <li class="on"><a href="iuCalendario.php">Calendario</a></li>
                <li class="on"><a href="iuWorkFlow.php">Workflow</a></li>
            </ul>
            <div id="content">
                <div>
                    <div id="body">
                        <h2>Workflow del departamento de Geotecnia</h2>
                        <div id="cy" style=" 
                        position: absolute;
                        top: 270px;
                        width: 100%;
                        height: 100%;">
                            
                        </div>                       
                        <br /><br /><br /><br /><br /><br /><br />
                        <br /><br /><br /><br /><br /><br /><br />
                        <br /><br /><br /><br /><br /><br /><br />
                        <br /><br /><br /><br /><br /><br /><br />
                        <br /><br /><br /><br /><br /><br /><br />
                        <h5>Seguimiento de ensayos de laboratorio</h5>
                        <br />

                        <table style="min-width: 875px; max-width: 875px; max-height: 450px; font-size: 13px;">
                            <thead>
                                <tr>

                                    <th style="max-width: 75px;" scope="col">Cod. solic.</th>
                                    <th style="min-width: 90px;" scope="col">Fecha solicitud</th>
                                    <th style="min-width: 100px;" scope="col">Responsable</th>
                                    <th style="min-width: 100px;" scope="col">Nombre del proyecto</th>
                                    <th scope="col">Habil.</th>
                                    <th style="min-width: 75px;" scope="col">Cod. proy.</th>
                                    <th scope="col">Muestra Registrada</th>
                                    <th scope="col">Ensayos Registrados</th>
                                    <th scope="col">Ensayos</th><th scope="col">Antic. cancel.</th>
                                    <th scope="col">Resul. cargados</th>
                                    <th scope="col">Saldo cancel.</th>
                                    <th scope="col">Informe entregado</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                include_once '../Controlador/ControladorProyecto.php';
                                $controlador_proyecto = new ControladorProyecto();
                                $lista = $controlador_proyecto->mostrar_estado_ensayos_laboratorio();
                                $contador = 0;
                                while ($contador <= sizeof($lista) - 1) {
                                    ?>
                                    <tr>
                                        <td><?php echo $lista[$contador + 1]; ?></td>
                                        <td><?php echo $lista[$contador + 7]; ?></td>
                                        <td><?php echo $lista[$contador + 2]; ?></td>
                                        <td><?php echo $lista[$contador + 3]; ?></td>
                                        <td><?php echo $lista[$contador + 4]; ?></td>
                                        <td><?php echo $lista[$contador + 11]; ?></td>
                                        <td><?php echo $lista[$contador + 5]; ?></td>
                                        <td><?php echo $lista[$contador + 6]; ?></td>
                                        <td><?php
                                            if ($lista[$contador + 6] == 'SI') {
                                                $id_solicitud = $lista[$contador];
                                                $lista_ensayos = $controlador_proyecto->mostrar_codigos_ensayos($id_solicitud);
                                                $cont = 0;
                                                while ($cont <= sizeof($lista_ensayos) - 1) {
                                                    echo "- " . $lista_ensayos[$cont] . "</br>";
                                                    $cont = $cont + 1;
                                                }
                                            } else {
                                                echo 'Ninguno';
                                            }
                                            ?></td>
                                        <td><?php echo $lista[$contador + 8]; ?></td>
                                        <td></td>
                                        <td><?php echo $lista[$contador + 9]; ?></td>
                                        <td><?php echo $lista[$contador + 10]; ?></td>
                                    </tr>

                                    <?php
                                    $contador = $contador + 12;
                                }
                                ?>

                            </tbody>    
                        </table>

                        <h5>Seguimiento de trabajos de campo</h5>
                        <br />

                        <table style="min-width: 875px; max-height: 450px; font-size: 13px;">
                            <thead>
                                <tr>
                                    <th style="max-width: 75px;" scope="col">Cod. solic.</th>
                                    <th style="min-width: 90px;" scope="col">Fecha solicitud</th>
                                    <th style="min-width: 100px;" scope="col">Responsable</th>
                                    <th style="min-width: 100px;" scope="col">Nombre del proyecto</th>
                                    <th scope="col">Habil.</th>
                                    <th style="min-width: 75px;" scope="col">Cod. proy.</th>
                                    <th scope="col">Alcan. creado</th>
                                    <th scope="col">Antic. cancel.</th>
                                    <th scope="col">Resul. cargados</th>
                                    <th scope="col">Saldo cancel.</th>
                                    <th scope="col">Informe entregado</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                include_once '../Controlador/ControladorProyecto.php';
                                $controlador_proyecto = new ControladorProyecto();
                                $lista = $controlador_proyecto->mostrar_estado_trabajos_campo();
                                $contador = 0;
                                while ($contador <= sizeof($lista) - 1) {
                                    ?>
                                    <tr>
                                        <td><?php echo $lista[$contador + 1]; ?></td>
                                        <td><?php echo $lista[$contador + 8]; ?></td>
                                        <td><?php echo $lista[$contador + 2]; ?></td>
                                        <td><?php echo $lista[$contador + 3]; ?></td>
                                        <td><?php echo $lista[$contador + 4]; ?></td>
                                        <td><?php echo $lista[$contador + 5]; ?></td>
                                        <td><?php echo $lista[$contador + 6]; ?></td>
                                        <td><?php echo $lista[$contador + 7]; ?></td>
                                        <td><?php echo $lista[$contador + 9]; ?></td>
                                        <td><?php echo $lista[$contador + 11]; ?></td>
                                        <td></td>
                                    </tr>

                                    <?php
                                    $contador = $contador + 12;
                                }
                                ?>

                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>	
        </div>
        <div id="footer">        
            <p class="left">&copy; 2014 Jimena Salazar Soto</p>
        </div>	
    </div>	
</body>
</html>

<?php
require_once '../Controlador/ControladorWorkflow.php';
$controlador_workflow = new ControladorWorkflow();

$arreglo_nodo1 = $controlador_workflow->mostrar_solicitudes();
$cad1 = '';
$cont1 = 0;
while ($cont1 <= sizeof($arreglo_nodo1) - 1) {
    $cad1 = $cad1 . $arreglo_nodo1[$cont1] . '<br />';
    $cont1 = $cont1 + 1;
}

$arreglo_nodo2 = $controlador_workflow->mostrar_solicitudes();
$cad2 = '';
$cont2 = 0;
while ($cont2 <= sizeof($arreglo_nodo2) - 1) {
    $cad2 = $cad2 . $arreglo_nodo2[$cont2] . '<br />';
    $cont2 = $cont2 + 1;
}

$arreglo_nodo3 = $controlador_workflow->mostrar_solicitudes();
$cad3 = '';
$cont3 = 0;
while ($cont3 <= sizeof($arreglo_nodo3) - 1) {
    $cad3 = $cad3 . $arreglo_nodo3[$cont3] . '<br />';
    $cont3 = $cont3 + 1;
}

$arreglo_nodo4 = $controlador_workflow->mostrar_solicitudes();
$cad4 = '';
$cont4 = 0;
while ($cont4 <= sizeof($arreglo_nodo4) - 1) {
    $cad4 = $cad4 . $arreglo_nodo4[$cont4] . '<br />';
    $cont4 = $cont4 + 1;
}

$arreglo_nodo5 = $controlador_workflow->mostrar_alcances_NC();
$cad5 = '';
$cont5 = 0;
while ($cont5 <= sizeof($arreglo_nodo5) - 1) {
    $cad5 = $cad5 . $arreglo_nodo5[$cont5] . '<br />';
    $cont5 = $cont5 + 1;
}

$arreglo_nodo7 = $controlador_workflow->mostrar_solicitudes();
$cad7 = '';
$cont7 = 0;
while ($cont7 <= sizeof($arreglo_nodo7) - 1) {
    $cad7 = $cad7 . $arreglo_nodo7[$cont7] . '<br />';
    $cont7 = $cont7 + 1;
}

$arreglo_nodo8 = $controlador_workflow->mostrar_solicitudes();
$cad8 = '';
$cont8 = 0;
while ($cont8 <= sizeof($arreglo_nodo8) - 1) {
    $cad8 = $cad8 . $arreglo_nodo8[$cont8] . '<br />';
    $cont8 = $cont8 + 1;
}

$arreglo_nodo10 = $controlador_workflow->mostrar_solicitudes();
$cad10 = '';
$cont10 = 0;
while ($cont10 <= sizeof($arreglo_nodo10) - 1) {
    $cad10 = $cad10 . $arreglo_nodo10[$cont10] . '<br />';
    $cont10 = $cont10 + 1;
}

$arreglo_nodo11 = $controlador_workflow->mostrar_solicitudes();
$cad11 = '';
$cont11 = 0;
while ($cont11 <= sizeof($arreglo_nodo11) - 1) {
    $cad11 = $cad11 . $arreglo_nodo5[$cont11] . '<br />';
    $cont11 = $cont11 + 1;
}

$arreglo_nodo12 = $controlador_workflow->mostrar_solicitudes();
$cad12 = '';
$cont12 = 0;
while ($cont12 <= sizeof($arreglo_nodo12) - 1) {
    $cad12 = $cad12 . $arreglo_nodo12[$cont12] . '<br />';
    $cont12 = $cont12 + 1;
}
?>

<script>
    $(function() { // on dom ready

        $('#cy').cytoscape({
            layout: {
                name: 'grid'
            },
            style: cytoscape.stylesheet()
                    .selector('node')
                    .css({
                        'shape': 'data(faveShape)',
                        'width': 'mapData(weight, 40, 80, 20, 60)',
                        'content': 'data(name)',
                        'text-valign': 'center',
                        'text-outline-width': 0.2,
                        'text-outline-color': 'black',
                        'background-color': 'data(faveColor)',
                        'color': 'black',
                        'font-size': '12px'
                    })
                    .selector(':selected')
                    .css({
                        'border-width': 1.5,
                        'border-color': '#333'
                    })
                    .selector('edge')
                    .css({
                        'width': 'mapData(strength, 70, 100, 2, 6)',
                        'target-arrow-shape': 'triangle',
                        'source-arrow-shape': 'circle',
                        'line-color': 'data(faveColor)',
                        'source-arrow-color': 'data(faveColor)',
                        'target-arrow-color': 'data(faveColor)'
                    })
                    .selector('edge.questionable')
                    .css({
                        'line-style': 'dotted',
                        'target-arrow-shape': 'diamond'
                    })
                    .selector('.faded')
                    .css({
                        'opacity': 0.25,
                        'text-opacity': 1
                    }),
            elements: {
                nodes: [
                    {data: {id: '1', name: "Nueva Solicitud", weight: 50, faveColor: '#FAAC58', faveShape: 'ellipse'}},
                    {data: {id: '2', name: 'Recibir Solicitud', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '3', name: 'Asignar Supervisor', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '4', name: 'Definir Tipo', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '5', name: 'Habilitar proyecto', weight: 75, faveColor: '#FACC2E', faveShape: 'roundrectangle'}},
                    {data: {id: '6', name: 'Es trabajo de campo?', weight: 60, faveColor: '#2ECCFA', faveShape: 'hexagon'}},
                    {data: {id: '7', name: 'Elaborar alcance', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                    {data: {id: '8', name: 'Revisar alcance', weight: 75, faveColor: '#FACC2E', faveShape: 'roundrectangle'}},
                    {data: {id: '9', name: 'Alcance aprobado?', weight: 60, faveColor: '#FACC2E', faveShape: 'hexagon'}},
                    {data: {id: '10', name: 'Determinar costos', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '11', name: 'Registrar muestra', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                    {data: {id: '12', name: 'Determinar ensayos', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                    {data: {id: '13', name: 'Estimar tiempos', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                    {data: {id: '14', name: 'Costo>10000?', weight: 60, faveColor: '#2ECCFA', faveShape: 'hexagon'}},
                    {data: {id: '15', name: 'Nota de aceptacion', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '16', name: 'Compromiso de pago', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '17', name: 'Cobrar anticipo', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '18', name: 'Iniciar trabajo', weight: 75, faveColor: '#2EFE9A', faveShape: 'roundrectangle'}},
                    {data: {id: '19', name: 'Cargar resultados', weight: 75, faveColor: '#CC2EFA', faveShape: 'roundrectangle'}},
                    {data: {id: '20', name: 'Revisar resultados', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                    {data: {id: '21', name: 'Subir Informe', weight: 75, faveColor: '#9AFE2E', faveShape: 'roundrectangle'}},
                    {data: {id: '22', name: 'Revisar Informe', weight: 75, faveColor: '#FACC2E', faveShape: 'roundrectangle'}},
                    {data: {id: '23', name: 'Informe Aprobado?', weight: 60, faveColor: '#FACC2E', faveShape: 'hexagon'}},
                    {data: {id: '24', name: 'Cobrar saldo', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '25', name: 'Entregar Informe Final', weight: 75, faveColor: '#2ECCFA', faveShape: 'roundrectangle'}},
                    {data: {id: '26', name: 'Proyecto terminado', weight: 50, faveColor: '#FAAC58', faveShape: 'ellipse'}}
                ],
                edges: [
                    {data: {source: '1', target: '2', faveColor: '#099', strength: 60}},
                    {data: {source: '2', target: '3', faveColor: '#099', strength: 60}},
                    {data: {source: '3', target: '4', faveColor: '#099', strength: 60}},
                    {data: {source: '4', target: '5', faveColor: '#099', strength: 60}},
                    {data: {source: '4', target: '6', faveColor: '#099', strength: 60}},
                    {data: {source: '6', target: '7', faveColor: '#099', strength: 60}},
                    {data: {source: '7', target: '8', faveColor: '#099', strength: 60}},
                    {data: {source: '8', target: '9', faveColor: '#099', strength: 60}},
                    {data: {source: '6', target: '11', faveColor: '#099', strength: 60}},
                    {data: {source: '9', target: '10', faveColor: '#099', strength: 60}},
                    {data: {source: '11', target: '12', faveColor: '#099', strength: 60}},
                    {data: {source: '12', target: '13', faveColor: '#099', strength: 60}},
                    {data: {source: '13', target: '10', faveColor: '#099', strength: 60}},
                    {data: {source: '10', target: '14', faveColor: '#099', strength: 60}},
                    {data: {source: '14', target: '15', faveColor: '#099', strength: 60}},
                    {data: {source: '14', target: '16', faveColor: '#099', strength: 60}},
                    {data: {source: '15', target: '17', faveColor: '#099', strength: 60}},
                    {data: {source: '16', target: '17', faveColor: '#099', strength: 60}},
                    {data: {source: '5', target: '17', faveColor: '#099', strength: 60}},
                    {data: {source: '17', target: '18', faveColor: '#099', strength: 60}},
                    {data: {source: '18', target: '19', faveColor: '#099', strength: 60}},
                    {data: {source: '19', target: '20', faveColor: '#099', strength: 60}},
                    {data: {source: '20', target: '21', faveColor: '#099', strength: 60}},
                    {data: {source: '21', target: '22', faveColor: '#099', strength: 60}},
                    {data: {source: '22', target: '23', faveColor: '#099', strength: 60}},
                    {data: {source: '23', target: '24', faveColor: '#099', strength: 60}},
                    {data: {source: '24', target: '25', faveColor: '#099', strength: 60}},
                    {data: {source: '25', target: '26', faveColor: '#099', strength: 60}}
                    
                ]
            },
            ready: function() {
                window.cy = this;

                cy.$('#1').position({
                    x: 70,
                    y: 40
                });

                cy.$('#2').position({
                    x: 170,
                    y: 40
                });

                cy.$('#3').position({
                    x: 270,
                    y: 40
                });

                cy.$('#4').position({
                    x: 370,
                    y: 40
                });

                cy.$('#5').position({
                    x: 370,
                    y: 230
                });

                cy.$('#6').position({
                    x: 470,
                    y: 40
                });

                cy.$('#7').position({
                    x: 470,
                    y: 160
                });

                cy.$('#8').position({
                    x: 470,
                    y: 230
                });

                cy.$('#9').position({
                    x: 670,
                    y: 230
                });

                cy.$('#10').position({
                    x: 770,
                    y: 320
                });

                cy.$('#11').position({
                    x: 570,
                    y: 110
                });

                cy.$('#12').position({
                    x: 670,
                    y: 110
                });
                
                cy.$('#13').position({
                    x: 770,
                    y: 110
                });
                
                cy.$('#14').position({
                    x: 670,
                    y: 320
                });
                
                cy.$('#15').position({
                    x: 570,
                    y: 290
                });
                
                cy.$('#16').position({
                    x: 570,
                    y: 350
                });
                
                cy.$('#17').position({
                    x: 470,
                    y: 320
                });
                
                cy.$('#18').position({
                    x: 470,
                    y: 530
                });
                
                cy.$('#19').position({
                    x: 370,
                    y: 580
                });
                
                cy.$('#20').position({
                    x: 370,
                    y: 410
                });
                
                cy.$('#21').position({
                    x: 270,
                    y: 410
                });
                
                cy.$('#22').position({
                    x: 270,
                    y: 480
                });
                
                cy.$('#23').position({
                    x: 170,
                    y: 480
                });

                cy.$('#24').position({
                    x: 170,
                    y: 320
                });
                
                cy.$('#25').position({
                    x: 70,
                    y: 320
                });

                cy.$('#26').position({
                    x: 70,
                    y: 370
                });

                   //contenido de los globos de los nodos
                   
                cy.$('#1').qtip({
                    content: '<?php echo $cad1;?>',
                    style: {
                        classes: 'qtip-bootstrap',
                        tip: {
                            width: 16,
                            height: 8
                        }
                    }
                });
                
                cy.$('#2').qtip({
                    content: '<?php echo $cad2;?>',
                    style: {
                        classes: 'qtip-bootstrap',
                        tip: {
                            width: 16,
                            height: 8
                        }
                    }
                });
                
                cy.$('#3').qtip({
                    content: '<?php echo $cad3;?>',
                    style: {
                        classes: 'qtip-bootstrap',
                        tip: {
                            width: 16,
                            height: 8
                        }
                    }
                });
                
                cy.$('#4').qtip({
                    content: '<?php echo $cad4;?>',
                    style: {
                        classes: 'qtip-bootstrap',
                        tip: {
                            width: 16,
                            height: 8
                        }
                    }
                });
                
                cy.$('#5').qtip({
                    content: '<?php echo $cad5;?>',
                    style: {
                        classes: 'qtip-bootstrap',
                        tip: {
                            width: 16,
                            height: 8
                        }
                    }
                });
                
                cy.$('#7').qtip({
                    content: '<?php echo $cad7;?>',
                    style: {
                        classes: 'qtip-bootstrap',
                        tip: {
                            width: 16,
                            height: 8
                        }
                    }
                });
                // giddy up
            }
        });

    }); // on dom ready
</script>






