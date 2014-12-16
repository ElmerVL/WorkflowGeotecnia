<?php

require_once '../Controlador/Conexion.php';

class ModeloReporte {
    function imprimir_reporte_solicitudes($año) {
        
        require_once 'fpdf/fpdf.php';
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetMargins(25, 25);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetXY(15, 10);
        $pdf->MultiCell(60, 7,' LABORATORIO DE GEOTECNIA' , 1, 'C', FALSE);
        $pdf->SetXY(75, 10);
        $pdf->SetFont('Times', 'B', 13);
        $pdf->MultiCell(80, 14,' LISTA DE SOLICITUDES' , 1, 'C', FALSE);
        $pdf->SetXY(155, 10);
        $pdf->MultiCell(40, 14,utf8_decode("AÑO: $año") , 1, 'C', FALSE);
        
        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetFillColor(235,235,235);
        $pdf->SetXY(15, 25);
        $pdf->MultiCell(20, 10,utf8_decode('Código') , 1, 'C', TRUE);
        $pdf->SetXY(35, 25);
        $pdf->MultiCell(45, 10,utf8_decode('Nombe del proyecto') , 1, 'C', TRUE);
        $pdf->SetXY(80, 25);
        $pdf->MultiCell(45, 10,utf8_decode('Responsable') , 1, 'C', TRUE);
        $pdf->SetXY(125, 25);
        $pdf->MultiCell(45, 10,utf8_decode('Tipo de la solicitud') , 1, 'C', TRUE);
        $pdf->SetXY(170, 25);
        $pdf->MultiCell(25, 5,utf8_decode('Fecha de la solicitud') , 1, 'C', TRUE);
        $pdf->SetFont('Times', NULL, 11);
        
        $ult_posic = 36;
        
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select idsolicitud, cliente, ubicacion, tipo, fecha_solicitud, nombres, apellidos, cod_solicitud
                              from solicitud, ingeniero
                              where ingeniero_idingeniero = idingeniero and date_part('year', fecha_solicitud) = $año
                              order by idsolicitud;");

        while ($f = pg_fetch_object($consulta)) {
            $id_solicitud = $f->idsolicitud;
            $cod_solicitud = $f->cod_solicitud;
            $cliente = $f->cliente;
            $responsable = $f->nombres." ".$f->apellidos;
            $ubicacion = $f->ubicacion;
            $tipo = $f->tipo;
            $fecha = $f->fecha_solicitud;
            
            $pdf->SetXY(15, $ult_posic);
            $pdf->MultiCell(20, 6,utf8_decode($cod_solicitud) , 1, 'C', FALSE);
            $pdf->SetXY(35, $ult_posic);
            $pdf->MultiCell(45, 6,utf8_decode($cliente) , 1, 'C', FALSE);
            $pdf->SetXY(80, $ult_posic);
            $pdf->MultiCell(45, 6,utf8_decode($responsable) , 1, 'C', FALSE);
            $pdf->SetXY(125, $ult_posic);
            $pdf->MultiCell(45, 6,utf8_decode($tipo) , 1, 'C', FALSE);
            $pdf->SetXY(170, $ult_posic);
            $pdf->MultiCell(25, 6,utf8_decode($fecha) , 1, 'C', FALSE);
            
            $ult_posic = $ult_posic+6;
        }
        
        pg_close($c);
        
        $pdf->Output("../prueba.pdf");
        echo "<script language='javascript'>window.open('../prueba.pdf','_self');</script>"; //para ver el archivo pdf generado
        exit;
    }
    
    function mostrar_lista_solicitudes() {
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select idsolicitud, cliente, ubicacion, tipo, fecha_solicitud, nombres, apellidos, cod_solicitud
                              from solicitud, ingeniero
                              where ingeniero_idingeniero = idingeniero
                              order by idsolicitud;");

        $array_solicitudes = array();
        while ($f = pg_fetch_object($consulta)) {

            $id_solicitud = $f->idsolicitud;
            $cod_solicitud = $f->cod_solicitud;
            $cliente = $f->cliente;
            $responsable = $f->nombres." ".$f->apellidos;
            $ubicacion = $f->ubicacion;
            $tipo = $f->tipo;
            $fecha = $f->fecha_solicitud;
            
            $array_solicitudes[] = $cod_solicitud;
            $array_solicitudes[] = $cliente;
            $array_solicitudes[] = $responsable;
            $array_solicitudes[] = $ubicacion;
            $array_solicitudes[] = $tipo;
            $array_solicitudes[] = $fecha;
            
        }
        return $array_solicitudes;
        pg_close($c);
    }
    
    function imprimir_reporte_ensayos($año) {
        
    }
    
    function imprimir_reporte_muestras($año) {
        
    }
    
    function imprimir_reporte_trabajos($año) {
        
    }
    
    function imprimir_todos_solicitudes() {
        require_once 'fpdf/fpdf.php';
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetMargins(25, 25);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetXY(15, 10);
        $pdf->MultiCell(60, 7,' LABORATORIO DE GEOTECNIA' , 1, 'C', FALSE);
        $pdf->SetXY(75, 10);
        $pdf->SetFont('Times', 'B', 13);
        $pdf->MultiCell(80, 14,' LISTA DE SOLICITUDES' , 1, 'C', FALSE);
        $pdf->SetXY(155, 10);
        $pdf->MultiCell(40, 7,utf8_decode("ULTIMOS 3 AÑOS") , 1, 'C', FALSE);
        
        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetFillColor(235,235,235);
        $pdf->SetXY(15, 25);
        $pdf->MultiCell(20, 10,utf8_decode('Código') , 1, 'C', TRUE);
        $pdf->SetXY(35, 25);
        $pdf->MultiCell(45, 10,utf8_decode('Nombe del proyecto') , 1, 'C', TRUE);
        $pdf->SetXY(80, 25);
        $pdf->MultiCell(45, 10,utf8_decode('Responsable') , 1, 'C', TRUE);
        $pdf->SetXY(125, 25);
        $pdf->MultiCell(45, 10,utf8_decode('Tipo de la solicitud') , 1, 'C', TRUE);
        $pdf->SetXY(170, 25);
        $pdf->MultiCell(25, 5,utf8_decode('Fecha de la solicitud') , 1, 'C', TRUE);
        $pdf->SetFont('Times', NULL, 11);
        
        $ult_posic = 36;
        
        $con = new Conexion();
        $c = $con->getConection();

        $consulta = pg_query($c, "select idsolicitud, cliente, ubicacion, tipo, fecha_solicitud, nombres, apellidos, cod_solicitud
                              from solicitud, ingeniero
                              where ingeniero_idingeniero = idingeniero
                              order by idsolicitud;");

        while ($f = pg_fetch_object($consulta)) {
            $id_solicitud = $f->idsolicitud;
            $cod_solicitud = $f->cod_solicitud;
            $cliente = $f->cliente;
            $responsable = $f->nombres." ".$f->apellidos;
            $ubicacion = $f->ubicacion;
            $tipo = $f->tipo;
            $fecha = $f->fecha_solicitud;
            
            $pdf->SetXY(15, $ult_posic);
            $pdf->MultiCell(20, 6,utf8_decode($cod_solicitud) , 1, 'C', FALSE);
            $pdf->SetXY(35, $ult_posic);
            $pdf->MultiCell(45, 6,utf8_decode($cliente) , 1, 'C', FALSE);
            $pdf->SetXY(80, $ult_posic);
            $pdf->MultiCell(45, 6,utf8_decode($responsable) , 1, 'C', FALSE);
            $pdf->SetXY(125, $ult_posic);
            $pdf->MultiCell(45, 6,utf8_decode($tipo) , 1, 'C', FALSE);
            $pdf->SetXY(170, $ult_posic);
            $pdf->MultiCell(25, 6,utf8_decode($fecha) , 1, 'C', FALSE);
            
            $ult_posic = $ult_posic+6;
        }
        
        pg_close($c);
        
        $pdf->Output("../prueba.pdf");
        echo "<script language='javascript'>window.open('../prueba.pdf','_self');</script>"; //para ver el archivo pdf generado
        exit;
    }
    
    function imprimir_todos_ensayos($año) {
        
    }
    
    function imprimir_todos_muestras($año) {
        
    }
    
    function imprimir_todos_trabajos($año) {
        
    }
}
