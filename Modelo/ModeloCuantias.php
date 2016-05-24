<?php
require_once '../Modelo/ModeloEnsayoLaboratorio.php';
require_once '../Modelo/ModeloCliente.php';
require_once '../Modelo/ModeloAlcance.php';

class ModeloCuantias {
    function imprimir_formulario($id_ensayo, $tipo_proyecto) {
        $modelo_cliente = new ModeloCliente();
        $array_datos_cliente = $modelo_cliente->mostrar_datos_cliente($id_ensayo, $tipo_proyecto);
        
        $tipo_institucion = $array_datos_cliente[0];
        echo $array_datos_cliente[1];
        echo $array_datos_cliente[2];
        echo $array_datos_cliente[3];
        echo $array_datos_cliente[4];
        echo $array_datos_cliente[5];
        echo $array_datos_cliente[6];
        echo $array_datos_cliente[7];
        if($tipo_proyecto == 1){
            $modelo_ensayo = new ModeloEnsayoLaboratorio();
            $precio = $modelo_ensayo->mostrar_suma_total_ensayos($id_ensayo);
        }else{
            $modelo_alcance = new ModeloAlcance();
            $array = $modelo_alcance->recuperar_datos_alcance($id_ensayo);
            $precio = $array[5];
        }
        $modelo_cuantias = new ModeloCuantias();
        if($precio <= 5000 && $tipo_institucion == 'privada' && $tipo_proyecto == 1){
            $modelo_cuantias->imprimir_compromiso_pago($id_ensayo, $tipo_proyecto);
        }elseif ($precio > 5000 && $tipo_institucion == 'privada' && $tipo_proyecto == 1) {
            $modelo_cuantias->imprimir_nota_aceptacion($id_ensayo, 50, $tipo_proyecto);
        }elseif($tipo_institucion == 'privada' && $tipo_proyecto == 2){
            $modelo_cuantias->imprimir_nota_aceptacion_tc($id_ensayo, 50, $tipo_proyecto);
        }elseif($precio <= 5000 && $tipo_institucion == 'estatal' && $tipo_proyecto == 1){
            $modelo_cuantias->imprimir_nota_aceptacion($id_ensayo, 20, $tipo_proyecto);
        }elseif ($precio > 5000 && $tipo_institucion == 'estatal' && $tipo_proyecto == 1) {
            $modelo_cuantias->imprimir_nota_aceptacion($id_ensayo, 20, $tipo_proyecto);
        }elseif ($tipo_institucion == 'estatal' && $tipo_proyecto == 2) {
            $modelo_cuantias->imprimir_nota_aceptacion_tc($id_ensayo, 20, $tipo_proyecto);
        }
        
    }
    
    function imprimir_compromiso_pago($id_ensayo, $tipo_proyecto) {
        
        require_once '../Modelo/ModeloCliente.php';
        $modelo_cliente = new ModeloCliente();
        $array_datos_cliente = $modelo_cliente->mostrar_datos_cliente($id_ensayo, $tipo_proyecto);
        
        echo $array_datos_cliente[0];
        echo $array_datos_cliente[1];
        echo $array_datos_cliente[2];
        echo $array_datos_cliente[3];
        echo $array_datos_cliente[4];
        echo $array_datos_cliente[5];
        echo $array_datos_cliente[6];
        echo $array_datos_cliente[7];
        
        require_once '../Controlador/ControladorProyecto.php';
        $controlador_proyecto = new ControladorProyecto();
        $arreglo_datos = $controlador_proyecto->mostrar_datos_e_l($id_ensayo);

        require_once '../Modelo/ModeloEnsayoLaboratorio.php';
        $modelo_ensayo = new ModeloEnsayoLaboratorio();
        $array_datos_ensayos = $modelo_ensayo->mostrar_detalle_ensayos_registrados($id_ensayo);
        $precio_total = $modelo_ensayo->mostrar_suma_total_ensayos($id_ensayo);
        
        
        require_once '../fpdf/fpdf.php';
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetMargins(15, 15);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->MultiCell(60, 7,' LABORATORIO DE GEOTECNIA' , 1, 'C', FALSE);
        $pdf->SetXY(70, 10);
        $pdf->SetFont('Times', 'B', 13);
        $pdf->MultiCell(110, 14,' SOLICITUD DE ENSAYOS DE LABORATORIO' , 1, 'C', FALSE);
        $pdf->SetXY(180, 10);
        $pdf->MultiCell(20, 14,'Nro.' , 1, 'C', FALSE);
        $pdf->SetFillColor(195, 195, 195);
        $pdf->SetXY(10, 25);
        $pdf->MultiCell(190, 9,utf8_decode('Datos del solicitante para coordinación y facturación') , 1, 'C', TRUE);
        $pdf->SetFont('Times', null, 12);
        $pdf->SetXY(10, 35);
        $pdf->MultiCell(70, 7,utf8_decode('Nombre del proyecto') , 1, 'L', FALSE);
        $pdf->SetXY(80, 35);
        $pdf->MultiCell(120, 7,utf8_decode("$arreglo_datos[0]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 42);
        $pdf->MultiCell(70, 6,utf8_decode('Facturación a nombre de (razón social de la empresa o nombre del particular):') , 1, 'L', FALSE);
        $pdf->SetXY(80, 42);
        $pdf->MultiCell(120, 12,utf8_decode("$array_datos_cliente[1]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 54);
        $pdf->MultiCell(70, 7,utf8_decode('Nro. de NIT o Nro. de CI:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 54);
        $pdf->MultiCell(120, 7,utf8_decode("$array_datos_cliente[2]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 61);
        $pdf->MultiCell(70, 7,utf8_decode('Nombre de la persona de contacto:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 61);
        $pdf->MultiCell(120, 7,utf8_decode("$array_datos_cliente[3]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 68);
        $pdf->MultiCell(70, 7,utf8_decode('Nro. de telefono fijo y celular:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 68);
        $pdf->MultiCell(120, 7,utf8_decode("$array_datos_cliente[4] - $array_datos_cliente[5]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 75);
        $pdf->MultiCell(70, 7,utf8_decode('Correo electrónico de contacto:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 75);
        $pdf->MultiCell(120, 7,utf8_decode("$array_datos_cliente[6]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 82);
        $pdf->MultiCell(70, 14,utf8_decode('Dirección fiscal:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 82);
        $pdf->MultiCell(120, 14,utf8_decode("$array_datos_cliente[7]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 96);
        $pdf->MultiCell(70, 7,utf8_decode('Fecha de la solicitud:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 96);
        
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
                                            
        $pdf->MultiCell(120, 7,utf8_decode("$dia de $mes, $anio") , 1, 'L', FALSE);
        $pdf->SetXY(10, 104);
        $pdf->SetFont('Times', 'B', 13);
        $pdf->MultiCell(190, 9,utf8_decode('Datos de ensayos de laboratorio') , 1, 'C', TRUE);
        $pdf->SetXY(10, 114);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(235,235,235);
        $pdf->MultiCell(30, 7,utf8_decode('Cantidad') , 1, 'C', TRUE);
        $pdf->SetXY(40, 114);
        $pdf->MultiCell(100, 7,utf8_decode('Descripción de ensayos') , 1, 'C', TRUE);
        $pdf->SetXY(140, 114);
        $pdf->MultiCell(30, 7,utf8_decode('Unit. (Bs.)') , 1, 'C', TRUE);
        $pdf->SetXY(170, 114);
        $pdf->MultiCell(30, 7,utf8_decode('Total. (Bs.)') , 1, 'C', TRUE);
        $pdf->SetFont('Times', NULL, 11);
        
        $ult_posic = 115;
        $contador = 0;
        while ($contador <= sizeof($array_datos_ensayos) - 1) {
            $ult_posic = $ult_posic +7;
            $pdf->SetXY(10, $ult_posic);
            $pdf->MultiCell(30, 7,utf8_decode($array_datos_ensayos[$contador+4]) , 1, 'C', FALSE);
            $pdf->SetXY(40, $ult_posic);
            $pdf->MultiCell(100, 7,utf8_decode($array_datos_ensayos[$contador+3]) , 1, 'C', FALSE);
            $pdf->SetXY(140, $ult_posic);
            $pdf->MultiCell(30, 7,utf8_decode($array_datos_ensayos[$contador+6]) , 1, 'C', FALSE);
            $pdf->SetXY(170, $ult_posic);
            $pdf->MultiCell(30, 7,utf8_decode($array_datos_ensayos[$contador+5]) , 1, 'C', FALSE);
            $contador = $contador + 8;
        }
        $pdf->SetFont('Times', 'B', 13);
        $pdf->SetXY(10, $ult_posic+8);
        $pdf->MultiCell(160, 7,"TOTAL", 1, 'C', TRUE);
        $pdf->SetXY(170, $ult_posic+8);
        $pdf->MultiCell(30, 7,utf8_decode($precio_total) , 1, 'C', TRUE);
        
        require_once '../Modelo/ModeloProyecto.php';
        $modelo_proyecto = new ModeloProyecto();
        $cod_solicitud = $modelo_proyecto->mostrar_cod_solicitud_el($id_ensayo);
        $d = $destino = "../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/";
        $nombreArchivo = "formulario-$cod_solicitud";
        if (file_exists($d)) {
            $pdf->Output("../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/".$nombreArchivo);
        } else {
            mkdir("../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/", 0777, true);
            $pdf->Output("../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/$nombreArchivo.pdf");
        }
        echo "<script language='javascript'>window.open('../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/$nombreArchivo.pdf','_self');</script>"; //para ver el archivo pdf generado
        exit;
        
    }
    
    function imprimir_nota_aceptacion($id_ensayo, $porcentaje, $tipo_proyecto) {
        require_once '../Modelo/ModeloCliente.php';
        $modelo_cliente = new ModeloCliente();
        $array_datos_cliente = $modelo_cliente->mostrar_datos_cliente($id_ensayo, $tipo_proyecto);
        
        $tipo_cliente = $array_datos_cliente[0];
            $nombre_factura = $array_datos_cliente[1];
            $nit_ci = $array_datos_cliente[2];
            $nombre_contacto = $array_datos_cliente[3];
            $telefono_fijo = $array_datos_cliente[4];
            $telefono_celular = $array_datos_cliente[5];
            $correo = $array_datos_cliente[6];
            $direccion_fiscal = $array_datos_cliente[7];
            $ci_contacto = $array_datos_cliente[8];

        require_once '../Controlador/ControladorProyecto.php';
        $controlador_proyecto = new ControladorProyecto();
        $arreglo_datos = $controlador_proyecto->mostrar_datos_e_l($id_ensayo);

        require_once '../Modelo/ModeloEnsayoLaboratorio.php';
        $modelo_ensayo = new ModeloEnsayoLaboratorio();
        $array_datos_ensayos = $modelo_ensayo->mostrar_detalle_ensayos_registrados($id_ensayo);
        $precio_total = $modelo_ensayo->mostrar_suma_total_ensayos($id_ensayo);
        
        $dia = date("d");
                                            $mes = date("F");
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
                                            $anio = date("Y");
        
        
        require_once 'fpdf/fpdf.php';
        $pdf = new FPDF();
        
        $pdf->AddPage();
        $pdf->SetMargins(25, 25);
        $pdf->Ln(12);
        $pdf->SetFont('Times', null, 12);
        $pdf->Cell(160, 2, "Cochabamba,".$dia." de ".$mes.", ".$anio , 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(160, 2, utf8_decode("Señor") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("Ing. Guido León Clavijo") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, "Director" , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, "Laboratorio de Geotecnia" , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, "Presente" , 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(160, 2, utf8_decode("De mi consideracion:") , 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('Times', 'U', 12);
        $pdf->Cell(160, 2, utf8_decode("Ref.: Aceptación de servicio de Ensayo de Laboratorio y solicitud de elaboración de contrato") , 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Times', null, 12);
        $pdf->Cell(160, 2, utf8_decode("Me dirijo a ud. a fin de establecer mi aceptación para la realización de los siguientes ensayos:") , 0, 1, 'C');
        $pdf->Ln(5);
        
        $pdf->SetY(95);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(235,235,235);
        $pdf->MultiCell(20, 7,utf8_decode('Cantidad') , 1, 'C', TRUE);
        $pdf->SetXY(45, 95);
        $pdf->MultiCell(90, 7,utf8_decode('Descripción de ensayos') , 1, 'C', TRUE);
        $pdf->SetXY(135, 95);
        $pdf->MultiCell(25, 7,utf8_decode('Unit. (Bs.)') , 1, 'C', TRUE);
        $pdf->SetXY(160, 95);
        $pdf->MultiCell(25, 7,utf8_decode('Total. (Bs.)') , 1, 'C', TRUE);
        
        $pdf->SetFont('Times', null, 11);
        $ult_posic = 95;
        $contador = 0;
        while ($contador <= sizeof($array_datos_ensayos) - 1) {
            $ult_posic = $ult_posic +7;
            $pdf->SetY($ult_posic);
            $pdf->MultiCell(20, 7,utf8_decode($array_datos_ensayos[$contador+4]) , 1, 'C', FALSE);
            $pdf->SetXY(45, $ult_posic);
            $pdf->MultiCell(90, 7,utf8_decode($array_datos_ensayos[$contador+3]) , 1, 'C', FALSE);
            $pdf->SetXY(135, $ult_posic);
            $pdf->MultiCell(25, 7,utf8_decode($array_datos_ensayos[$contador+6]) , 1, 'C', FALSE);
            $pdf->SetXY(160, $ult_posic);
            $pdf->MultiCell(25, 7,utf8_decode($array_datos_ensayos[$contador+5]) , 1, 'C', FALSE);
            $contador = $contador + 8;
        }
        $pdf->SetFont('Times', null, 12);
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("Cuyo monto total asciende a Bs. $precio_total ") , 0, 1, 'L');
        $pdf->Ln(7);
        $pdf->MultiCell(160, 6, utf8_decode("En consecuencia, solicito iniciar "
                . "el trámite del Contrato de Servicios para el cumplimiento de "
                . "partes, con los siguientes datos:"), 0, 'J', FALSE);
        $pdf->Ln(6);
        $pdf->Cell(160, 2, utf8_decode("a) Nombre de contacto: $nombre_contacto") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("b) CI del contacto: $ci_contacto") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("c) Nombre de la institucion: $nombre_factura") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("d) NIT / CI de la institucion: $nit_ci") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("e) Datos de contacto: $direccion_fiscal, $telefono_fijo, $telefono_celular") , 0, 1, 'L');
        $pdf->Ln(7);
        $pdf->MultiCell(160, 6, utf8_decode("Asimismo, solicito viabilizar una "
                . "primera Orden de pago por el anticipo del $porcentaje%, la cual "
                . "una vez pagada, se coordinara con la supervisión de su Laboratorio "
                . "para el inicio de los ensayos; "
                . "posteriormente, me comprometo a pagar el saldo del "
                .(100 - $porcentaje)."% del monto total para la fecha de entrega"
                . " del informe final. Los datos para las órdenes de pago y facturación"
                . " consiguiente son:"), 0, 'J', FALSE);
        $pdf->Ln(6);
        $pdf->Cell(160, 2, utf8_decode("a) Nombre de la factura: $nombre_factura") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("b) NIT / CI para la factura: $nit_ci") , 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(160, 2, utf8_decode("Con este particular, me despido atentamente.") , 0, 1, 'L');
        $pdf->Ln(20);
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode($nombre_contacto) , 0, 1, 'C');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode($ci_contacto) , 0, 1, 'C');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode($nombre_factura) , 0, 1, 'C');
        
        require_once '../Controlador/ControladorProyecto.php';
        $controlador_proyecto = new ControladorProyecto();
        $arreglo_datos = $controlador_proyecto->mostrar_datos_e_l($id_ensayo);

        require_once '../Modelo/ModeloEnsayoLaboratorio.php';
        $modelo_ensayo = new ModeloEnsayoLaboratorio();
        $array_datos_ensayos = $modelo_ensayo->mostrar_detalle_ensayos_registrados($id_ensayo);
        $precio_total = $modelo_ensayo->mostrar_suma_total_ensayos($id_ensayo);
        
        
        $pdf->AddPage();
        $pdf->SetMargins(15, 15);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetXY(10, 10);
        $pdf->MultiCell(60, 7,' LABORATORIO DE GEOTECNIA' , 1, 'C', FALSE);
        $pdf->SetXY(70, 10);
        $pdf->SetFont('Times', 'B', 13);
        $pdf->MultiCell(110, 14,' SOLICITUD DE ENSAYOS DE LABORATORIO' , 1, 'C', FALSE);
        $pdf->SetXY(180, 10);
        $pdf->MultiCell(20, 14,'Nro.' , 1, 'C', FALSE);
        $pdf->SetFillColor(195, 195, 195);
        $pdf->SetXY(10, 25);
        $pdf->MultiCell(190, 9,utf8_decode('Datos del solicitante para coordinación y facturación') , 1, 'C', TRUE);
        $pdf->SetFont('Times', null, 12);
        $pdf->SetXY(10, 35);
        $pdf->MultiCell(70, 7,utf8_decode('Nombre del proyecto') , 1, 'L', FALSE);
        $pdf->SetXY(80, 35);
        $pdf->MultiCell(120, 7,utf8_decode("$arreglo_datos[0]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 42);
        $pdf->MultiCell(70, 6,utf8_decode('Facturación a nombre de (razón social de la empresa o nombre del particular):') , 1, 'L', FALSE);
        $pdf->SetXY(80, 42);
        $pdf->MultiCell(120, 12,utf8_decode("$array_datos_cliente[1]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 54);
        $pdf->MultiCell(70, 7,utf8_decode('Nro. de NIT o Nro. de CI:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 54);
        $pdf->MultiCell(120, 7,utf8_decode("$array_datos_cliente[2]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 61);
        $pdf->MultiCell(70, 7,utf8_decode('Nombre de la persona de contacto:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 61);
        $pdf->MultiCell(120, 7,utf8_decode("$array_datos_cliente[3]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 68);
        $pdf->MultiCell(70, 7,utf8_decode('Nro. de telefono fijo y celular:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 68);
        $pdf->MultiCell(120, 7,utf8_decode("$array_datos_cliente[4] - $array_datos_cliente[5]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 75);
        $pdf->MultiCell(70, 7,utf8_decode('Correo electrónico de contacto:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 75);
        $pdf->MultiCell(120, 7,utf8_decode("$array_datos_cliente[6]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 82);
        $pdf->MultiCell(70, 14,utf8_decode('Dirección fiscal:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 82);
        $pdf->MultiCell(120, 14,utf8_decode("$array_datos_cliente[7]") , 1, 'L', FALSE);
        $pdf->SetXY(10, 96);
        $pdf->MultiCell(70, 7,utf8_decode('Fecha de la solicitud:') , 1, 'L', FALSE);
        $pdf->SetXY(80, 96);
        
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
                                            
        $pdf->MultiCell(120, 7,utf8_decode("$dia de $mes, $anio") , 1, 'L', FALSE);
        $pdf->SetXY(10, 104);
        $pdf->SetFont('Times', 'B', 13);
        $pdf->MultiCell(190, 9,utf8_decode('Datos de ensayos de laboratorio') , 1, 'C', TRUE);
        $pdf->SetXY(10, 114);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(235,235,235);
        $pdf->MultiCell(30, 7,utf8_decode('Cantidad') , 1, 'C', TRUE);
        $pdf->SetXY(40, 114);
        $pdf->MultiCell(100, 7,utf8_decode('Descripción de ensayos') , 1, 'C', TRUE);
        $pdf->SetXY(140, 114);
        $pdf->MultiCell(30, 7,utf8_decode('Unit. (Bs.)') , 1, 'C', TRUE);
        $pdf->SetXY(170, 114);
        $pdf->MultiCell(30, 7,utf8_decode('Total. (Bs.)') , 1, 'C', TRUE);
        $pdf->SetFont('Times', NULL, 11);
        
        $ult_posic = 115;
        $contador = 0;
        while ($contador <= sizeof($array_datos_ensayos) - 1) {
            $ult_posic = $ult_posic +7;
            $pdf->SetXY(10, $ult_posic);
            $pdf->MultiCell(30, 7,utf8_decode($array_datos_ensayos[$contador+4]) , 1, 'C', FALSE);
            $pdf->SetXY(40, $ult_posic);
            $pdf->MultiCell(100, 7,utf8_decode($array_datos_ensayos[$contador+3]) , 1, 'C', FALSE);
            $pdf->SetXY(140, $ult_posic);
            $pdf->MultiCell(30, 7,utf8_decode($array_datos_ensayos[$contador+6]) , 1, 'C', FALSE);
            $pdf->SetXY(170, $ult_posic);
            $pdf->MultiCell(30, 7,utf8_decode($array_datos_ensayos[$contador+5]) , 1, 'C', FALSE);
            $contador = $contador + 8;
        }
        $pdf->SetFont('Times', 'B', 13);
        $pdf->SetXY(10, $ult_posic+8);
        $pdf->MultiCell(160, 7,"TOTAL", 1, 'C', TRUE);
        $pdf->SetXY(170, $ult_posic+8);
        $pdf->MultiCell(30, 7,utf8_decode($precio_total) , 1, 'C', TRUE);
        
        require_once '../Modelo/ModeloProyecto.php';
        $modelo_proyecto = new ModeloProyecto();
        $cod_solicitud = $modelo_proyecto->mostrar_cod_solicitud_el($id_ensayo);
        $d = $destino = "../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/";
        $nombreArchivo = "formulario-$cod_solicitud";
        if (file_exists($d)) {
            $pdf->Output("../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/".$nombreArchivo);
        } else {
            mkdir("../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/", 0777, true);
            $pdf->Output("../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/$nombreArchivo.pdf");
        }
        echo "<script language='javascript'>window.open('../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/$nombreArchivo.pdf','_self');</script>"; //para ver el archivo pdf generado
        exit;
        
    }
    
    
    function imprimir_nota_aceptacion_tc($id_ensayo, $porcentaje, $tipo_proyecto) {
        require_once '../Modelo/ModeloCliente.php';
        $modelo_cliente = new ModeloCliente();
        $array_datos_cliente = $modelo_cliente->mostrar_datos_cliente($id_ensayo, $tipo_proyecto);
        
        $tipo_cliente = $array_datos_cliente[0];
        $nombre_factura = $array_datos_cliente[1];
        $nit_ci = $array_datos_cliente[2];
        $nombre_contacto = $array_datos_cliente[3];
        $telefono_fijo = $array_datos_cliente[4];
        $telefono_celular = $array_datos_cliente[5];
        $correo = $array_datos_cliente[6];
        $direccion_fiscal = $array_datos_cliente[7];
        $ci_contacto = $array_datos_cliente[8];

        require_once '../Controlador/ControladorProyecto.php';
        $controlador_proyecto = new ControladorProyecto();
        $arreglo_datos = $controlador_proyecto->mostrar_datos_t_c($id_ensayo);
        
        require_once '../Modelo/ModeloAlcance.php';
        $modelo_alcance = new ModeloAlcance();
        $array_alcance = $modelo_alcance->recuperar_datos_alcance($id_ensayo);
        $precio_total = $array_alcance[6];
        
        require_once '../Modelo/ModeloProyecto.php';
        $modelo_proyecto = new ModeloProyecto();
        $array_proyecto = $modelo_proyecto->mostrar_datos_proyecto_t_c($id_ensayo);
        $ubicacion_especifica = $array_proyecto[1];
        $nombre_proyecto = $array_proyecto[0];
        
        $dia = date("d");
                                            $mes = date("F");
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
                                            $anio = date("Y");
        
        
        require_once '../fpdf/fpdf.php';
        $pdf = new FPDF();
        
        $pdf->AddPage();
        $pdf->SetMargins(25, 25);
        $pdf->Ln(12);
        $pdf->SetFont('Times', null, 12);
        $pdf->Cell(160, 2, "Cochabamba,".$dia." de ".$mes.", ".$anio , 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(160, 2, utf8_decode("Señor") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("Ing. Guido León Clavijo") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, "Director" , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, "Laboratorio de Geotecnia" , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, "Presente" , 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(160, 2, utf8_decode("De mi consideracion:") , 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->SetFont('Times', 'U', 12);
        $pdf->Cell(160, 2, utf8_decode("Ref.: Aceptación de Alcance de trabajo y solicitud de elaboración de contrato") , 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Times', null, 12);
        $pdf->MultiCell(160, 6, utf8_decode("En base al análisis del Alcance de Trabajo, propuesto por el Laboratorio de Geotecnia, "
                . "cuyo monto asciende a Bs. $precio_total, establezco mi aceptación a todas las condiciones planteadas en este "
                . "alcance para la realización del estudio geotécnico en $ubicacion_especifica del estudio, incluyendo la "
                . "distancia en kilometros si estuviera fuera del área urbana, en el marco del Proyecto '$nombre_proyecto'."), 0, 'J', FALSE);
        $pdf->SetFont('Times', null, 12);
        $pdf->Ln(5);
        $pdf->MultiCell(160, 6, utf8_decode("En consecuencia, solicito iniciar "
                . "el trámite del Contrato de Servicios para el cumplimiento de "
                . "partes, con los siguientes datos:"), 0, 'J', FALSE);
        $pdf->Ln(6);
        $pdf->Cell(160, 2, utf8_decode("a) Nombre de contacto: $nombre_contacto") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("b) CI de contacto: $ci_contacto") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("c) Nombre para la factura: $nombre_factura") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("d)Nro. de NIT o Nro. de CI: $nit_ci") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("e) Datos de contacto: $direccion_fiscal, $telefono_fijo, $telefono_celular") , 0, 1, 'L');
        $pdf->Ln(7);
        $pdf->MultiCell(160, 6, utf8_decode("Asimismo, solicito viabilizar una "
                . "primera Orden de pago por el anticipo del $porcentaje%, la cual "
                . "una vez pagada, se coordinara con la supervisión de su Laboratorio "
                . "para el inicio de los ensayos; "
                . "posteriormente, me comprometo a pagar el saldo del "
                .(100 - $porcentaje)."% del monto total para la fecha de entrega"
                . " del informe final. Los datos para las órdenes de pago y facturación"
                . " consiguiente son:"), 0, 'J', FALSE);
        $pdf->Ln(6);
        $pdf->Cell(160, 2, utf8_decode("a) $nombre_factura") , 0, 1, 'L');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode("b) $nit_ci") , 0, 1, 'L');
        $pdf->Ln(10);
        $pdf->Cell(160, 2, utf8_decode("Con este particular, me despido atentamente.") , 0, 1, 'L');
        $pdf->Ln(20);
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode($nombre_contacto) , 0, 1, 'C');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode($ci_contacto) , 0, 1, 'C');
        $pdf->Ln(3);
        $pdf->Cell(160, 2, utf8_decode($nombre_factura) , 0, 1, 'C');
       
        $cod_solicitud = $modelo_proyecto->mostrar_cod_solicitud_tc($id_ensayo);
        $d = $destino = "../Archivos/EnsayoLaboratorio/$cod_solicitud/Documentos/";
        $nombreArchivo = "formulario-$cod_solicitud";
        if (file_exists($d)) {
            $pdf->Output("../Archivos/TrabajoCampo/$cod_solicitud/Documentos/".$nombreArchivo);
        } else {
            mkdir("../Archivos/TrabajoCampo/$cod_solicitud/Documentos/", 0777, true);
            $pdf->Output("../Archivos/TrabajoCampo/$cod_solicitud/Documentos/$nombreArchivo.pdf");
        }
        echo "<script language='javascript'>window.open('../Archivos/TrabajoCampo/$cod_solicitud/Documentos/$nombreArchivo.pdf','_self');</script>"; //para ver el archivo pdf generado
        exit;
        
    }
    
}
        