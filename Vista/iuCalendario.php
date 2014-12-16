<!DOCTYPE html>
<html>
    <head>

        <title>WORKFLOW</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="copyright" content="" />	  
        <meta name="revisit-after" content="3 days" />
        <link href="css/style_2.css" rel="stylesheet" type="text/css" />

        <meta charset='utf-8' />
        <link href='calendario/fullcalendar.css' rel='stylesheet' />
        <link href='calendario/fullcalendar.print.css' rel='stylesheet' media='print' />
        <script src='calendario/lib/moment.min.js'></script>
        <script src='calendario/lib/jquery.min.js'></script>
        <script src='calendario/lib/jquery-ui.custom.min.js'></script>
        <script src='calendario/fullcalendar.min.js'></script>
        
        <?php
        require_once '../Controlador/ControladoCalendario.php';
        $controlador_calendario = new ControladoCalendario();
        $arreglo_fechas = $controlador_calendario->mostrar_fechas();
        ?>
        
        <script>
            $(document).ready(function() {

                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    defaultDate: '<?php echo date('Y-m-d');?>',
                    editable: false,
                    events: [
                        {
                            title: 'Long Event',
                            url: 'iuInformacionProyecto.php?i_p=<?php echo "3"; ?>&t=<?php echo "1"; ?>',
                            start: '2014-06-07',
                            end: '2014-06-10'
                        },
                        <?php
                        $contador = 0;
                        while ($contador <= sizeof($arreglo_fechas) - 1) {
                            ?>
                        {
                            title: 'Proyecto: <?php echo $arreglo_fechas[$contador+2]; ?> - <?php echo $arreglo_fechas[$contador+3]; ?>',
                            url: 'iuInformacionProyecto.php?i_p=<?php echo $arreglo_fechas[$contador+4]; ?>&t=1',
                            start: '<?php echo $arreglo_fechas[$contador]; ?>',
                            end: '<?php echo $arreglo_fechas[$contador+1]; ?>'
                        },
                        <?php
                            $contador = $contador + 5;
                        }
                        ?>
                        {
                            title: 'Click for Google',
                                    url: 'http://google.com/',
                            start: '2014-06-28'
                        }
                    ]
                });

            });

        </script>

        <style>

            body {
                margin: 0;
                padding: 0;
                font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
                font-size: 14px;
            }

            #calendar {
                width: 650px;
                margin: 40px auto;
            }

        </style>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><a href="iuAdministrador.php">Laboratorio de <span>Geotecnia</span></a></h1>		
            </div>

            <div id="body">
                <ul id="nav">
                    <li class="on"><a href="iuAdministrador.php">WorkFlow</a></li>

                </ul>
                <div id="content">
                    <div>
                        <div id="body">
                            <div id='calendar'></div>
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
