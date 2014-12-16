<?php

require_once '../Controlador/ControladorAlcance.php';
require_once('../html2pdf_v4.03/html2pdf.class.php');

$id_proyecto = $_GET['i_p'];
$controlador_alcance = new ControladorAlcance();
$arreglo_datos_alcance = $controlador_alcance->mostrar_datos_alcance($id_proyecto);
ob_start();
?>

<page backtop="25mm" backbottom="20mm" backleft="20mm" backright="20mm" >
    <style>
        p{
            text-align: justify;
            font-size: 13pt;
        }
        h4{
            font-size: 14pt;
        }
    </style>
    <page_header>
        <table style="width: 100%; border: none;">
            <tr>
                <td style="text-align: left;    width: 33%"><img src="../Vista/img/fcyt.jpg" alt="An image" /></td>
                <td style="text-align: center;    width: 34%">UNIVERSIDAD MAYOR DE SAN SIMON<br />FACULTAD DE CIENCIAS Y TECNOLOGIA<br />
                                                                LABORATORIO DE GEOTECNIA</td>
                <td style="text-align: right;    width: 33%"><img src="../Vista/img/image_ll.png" alt="An image" /></td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; border: none;">
            <tr>
                <td style="text-align: left;    width: 33%">Av. Petrolera, Km. 4,2<br />Casilla 6760</td>
                <td style="text-align: right;    width: 34%">Cochabamba – Bolivia</td>
                <td style="text-align: right;    width: 34%">Teléfono/Fax : +/591/(0)4+4236858<br />e-mail: gtumss@fcyt.umss.edu.bo</td>
            </tr>
        </table>
    </page_footer>
    <h1 style="text-align: center;">ALCANCE DE TRABAJO</h1>
            <?php 
            $html = '<h4>1. Antecedente</h4>'.$arreglo_datos_alcance[0].'
<h4>2. Objetivo</h4><p>'.$arreglo_datos_alcance[1].'</p>
<h4>3. Trabajos a realizar</h4>';
$contador_trabajos = 1;
if ($arreglo_datos_alcance[2] != "no existe") {
    $html = $html.'<h4>3.'.$contador_trabajos++.' Trabajo de campo.</h4>';
    $html = $html.'<p>'.$arreglo_datos_alcance[2].'</p>';
}
if ($arreglo_datos_alcance[3] != "no existe") {
    $html = $html.'<h4>3.'.$contador_trabajos++.'. Trabajo de gabinete.</h4>';
    $html = $html.'<p>'.$arreglo_datos_alcance[3].'</p>';
}
if ($arreglo_datos_alcance[4] != "no existe") {
    $html = $html.'<h4>3.'.$contador_trabajos++.'. Trabajo de laboratorio.</h4>';
    $html = $html.'<p>'.$arreglo_datos_alcance[4].'</p>';
}
$html=$html.'<h4>4. Inicio y duración</h4>
<p>El inicio de los trabajos de campo será programado de acuerdo a la disponibilidad
de personal y equipo del Laboratorio de Geotecnia. El estudio tendrá una duración 
de '.$arreglo_datos_alcance[5].' calendario después de haber iniciado el trabajo de campo.</p>
<h4>5. Precio del estudio</h4>
<p>El precio total del trabajo descrito
es de Bs. '.$arreglo_datos_alcance[6].' que incluye los gastos de movilización, 
desmovilización, instalación del equipo, suministro de materiales y herramientas. 
El precio estipulado incluye los impuestos de ley.</p>
<h4>6. Forma de pago</h4>
<p>'.$arreglo_datos_alcance[7].'</p><h4>7. Requerimientos adicionales</h4>
'.$arreglo_datos_alcance[8].'';

echo $html;
?>

</page>
<?php
    $content = ob_get_clean();
    // convert in PDF
    
    try
    {
        $html2pdf = new HTML2PDF('P', 'Letter', 'fr', true, 'UTF-8', 3);
        $html2pdf->setDefaultFont("Times");
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        
        require_once '../Modelo/ModeloProyecto.php';
        $modelo_proyecto = new ModeloProyecto();
        $cod_solicitud = $modelo_proyecto->mostrar_cod_solicitud_tc($id_proyecto);
        $d = $destino = "../Archivos/TrabajoCampo/$cod_solicitud/Alcance/";
        $nombreArchivo = "alcance-$cod_solicitud";
        if (file_exists($d)) {
            $html2pdf->Output("../Archivos/TrabajoCampo/$cod_solicitud/Alcance/$nombreArchivo.pdf");
        } else {
            mkdir("../Archivos/TrabajoCampo/$cod_solicitud/Alcance/", 0777, true);
            $html2pdf->Output("../Archivos/TrabajoCampo/$cod_solicitud/Alcance/$nombreArchivo.pdf");
        }
        exit;
        
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }