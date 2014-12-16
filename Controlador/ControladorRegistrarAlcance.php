<?php
$id_proyecto = $_GET['i_p'];
$antecedente = $_POST['antecedente'];
$objetivo = $_POST['objetivo'];
$inicio_duracion = $_POST['inicio_duracion'];
$precio = $_POST['precio'];
$forma_pago = $_POST['forma_pago'];
$r_adicionales = $_POST['r_adicionales'];

$array = $_POST['array'];
function array_recibe($url_array) {
    $tmp = stripslashes($url_array);
    $tmp = urldecode($tmp);
    $tmp = unserialize($tmp);

    return $tmp;
}
$array = array_recibe($array);

$trabajo_campo = "no existe";
$trabajo_gabinete = "no existe";
$trabajo_laboratorio = "no existe";
foreach ($array as $indice => $valor) {
    if($valor == "Trabajo_de_campo")
        $trabajo_campo = $_POST["$valor"];
    elseif($valor == "Trabajo_de_gabinete")
        $trabajo_gabinete = $_POST["$valor"];
    elseif($valor == "Trabajo_de_laboratorio")
        $trabajo_laboratorio = $_POST["$valor"];
}

echo $antecedente = str_replace("\xc2\xa0", ' ', $antecedente);
echo $objetivo = str_replace("\xc2\xa0", ' ', $objetivo);
echo $inicio_duracion = str_replace("\xc2\xa0", ' ', $inicio_duracion);
echo $precio = str_replace("\xc2\xa0", ' ', $precio);
echo $forma_pago = str_replace("\xc2\xa0", ' ', $forma_pago);
echo $r_adicionales = str_replace("\xc2\xa0", ' ', $r_adicionales);

require_once '../Modelo/ModeloAlcance.php';
$modelo_alcance = new ModeloAlcance();
$modelo_alcance->registrar_alcance($id_proyecto, $antecedente, $objetivo, $trabajo_campo, $trabajo_gabinete, $trabajo_laboratorio, $inicio_duracion, $precio, $forma_pago, $r_adicionales);


header("Location: ../Vista/iuInformacionAlcance.php?i_p=$id_proyecto&o=f");




/*
$encabezado = "<h1>UNIVERSIDAD MAYOR DE SAN SIMON<br />
FACULTAD DE CIENCIAS Y TECNOLOGIA<br />
LABORATORIO DE GEOTECNIA
</h1>";

$estilo = "
<style>
body {
  margin: 75.5px 94.5px 75.5px 75.5px;
}

* {
  font-family: 'Times New Roman';
}

p {
  text-align: justify;
  
  margin: 0.5em;
}
h4{
    font-size: 14px;
    
}
h6{
    font-size: 13px;   
}
h1{
    font-size: 14px;
    color: #666666;
    text-align: center;
}
</style>";

require_once ("../dompdf/dompdf_config.inc.php"); 
 
$dompdf = new DOMPDF(); 
$dompdf->load_html($encabezado."<hr style='color: #0056b2;' />".$html_c.$estilo);  
$dompdf->render(); 
$dompdf->stream("formulario.pdf", array("Attachment" => 0)); 
$pdf = $dompdf->output (); 
$nombre_archivo="prueba.pdf"; 
file_put_contents($nombre_archivo, $pdf); 

?>
*/

