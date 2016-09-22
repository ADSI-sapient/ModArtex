<?php

$html = '<!DOCTYPE html>
<html>
<head>
    <title>Informe Cotizacion</title>
    <style>
        @media print {
         .firstrow {page-break-before:always}
         }
         tr    { page-break-inside:avoid; page-break-after:auto }
         table { page-break-inside:auto }
         
        *
        {
            margin:0;
            padding:0;
            font-family:Arial;
            font-size:10pt;
            color:#000;

        }

        body
        {
            width:100%;
            font-family:Arial;
            font-size:10pt;
            margin:0;
            padding:0;
        }
         
        p
        {
            margin:0;
            padding:0;
        }
         
        #wrapper
        {
            width:180mm;
            margin:0 15mm;
        }
         
        .page
        {
            height:297mm;
            width:210mm;
            page-break-after:always;
        }
 
        table
        {
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
             
            border-spacing:0;
            border-collapse: collapse;
        }
         
        table td 
        {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 2mm;
        }
         
        table.heading
        {
            height:50mm;
        }
         
        h1.heading
        {
            font-size:14pt;
            color:#000;
            font-weight:normal;
        }
         
        h2.heading
        {
            font-size:9pt;
            color:#000;
            font-weight:normal;
        }
         
        hr
        {
            color:#ccc;
            background:#ccc;
        }
         
        #invoice_body
        {
            height: 149mm;
        }
         
        #invoice_body , #invoice_total
        {   
            width:100%;
        }

        #invoice_body table , #invoice_total table
        {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
            
            border-spacing:0;
            border-collapse: collapse; 
             
            margin-top:5mm;

        }
         
        #invoice_body table td , #invoice_total table td
        {
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding:2mm 0;
        }
         
        #invoice_body table td.mono  , #invoice_total table td.mono
        {
            font-family:monospace;
            text-align:right;
            padding-right:3mm;
            font-size:10pt;
        }
         
        #footer
        {   
            width:180mm;
            margin:0 15mm;
            padding-bottom:3mm;
        }
        #footer table
        {
            width:100%;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
             
            background:#eee;
             
            border-spacing:0;
            border-collapse: collapse; 
        }
        #footer table td
        {
            width:25%;
            text-align:center;
            font-size:9pt;
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        #destacada 
        {
            width: 120px;
            height: 250px;
        }

        #fatu
        {
            font-family: "Brush Script MT";
            font-size: 24px;
            font-style: normal;
            font-variant: normal;
            font-weight: 500;
            line-height: 50.6px;
        }

        .titu
        {
            font-family: Arial;
            font-size: 30px;
            font-style: Arial;
            font-variant: normal;
            font-weight: 400;
            line-height: 45.1px;
            text-align:right;
            padding-top:5mm;
            margin-top:2%;
        }

        #img-reporte{
            width:200px; 
            position:absolute; 
            width:90%; 
            opacity:0.15;
            top:30%; 
            left:15%;
        }
        .marca-agua{
            background-image: url(' . RAIZ . DS . 'public' . DS .'img\Modartex.jpg);
            position:absolute;
            width:100%;
            height:100%;
            z-index:9;
            opacity:0.15;
            background-position-x: 20%;
            background-position-y: 35%;
        }

        #img-dos{

            position:absolute; 
            left: 8%;
            width:25%;
            height:2%;
        }

    </style>
</head>
<body>
<!-- <div class="marca-agua"></div> -->
<div id="wrapper"> 

    <br clear="left">


    <img src="' . RAIZ . DS . 'public' . DS .'img\modar.png" id="img-dos"/>
    <h1 class="titu">COTIZACIÓN</h1>


    <br />
    <table style="width:100%;">
        <tr>
            <td style="width:80mm;">
                <h1 class="heading">'.$factura[0]["Nombre"].' '.$factura[0]["Apellido"].'</h1>
                <br>
                <h2 class="heading">Tipo De Documento : '.$factura[0]["Tipo_Documento"] .'</h2>
                <h2 class="heading">Documento : '.$factura[0]["Num_Documento"] .'</h2>
                <h2 class="heading">Telefono : '. $factura[0]["Telefono"] .'</h2>
                <h2 class="heading">Direccion : '. $factura[0]["Direccion"] .'</h2>
                <h2 class="heading">Email : '. $factura[0]["Email"] .'</h2>
            </td>
            <td valign="top">
                <table class="" style="width:100%;">
                    <tr><td>Numero de Cotizacion : </td><td>'.$factura[0]["Id_Solicitud"] .'</td></tr>
                    <tr><td>Fecha Registro : </td><td>'.$factura[0]["Fecha_Registro"] .'</td></tr>
                    <tr><td>Fecha Vencimiento : </td><td>'.$factura[0]["Fecha_Vencimiento"].'</td></tr>
                </table>
            </td>
        </tr>
    </table>
         
    <div id="content">
        <div id="invoice_body">
            <table class="table">    
            <tr style="background:#eee;">
                <td style="width:15%;"><b>Referencia</b></td>
                <td style="width:15%;"><b>Color</b></td>
                <td style="width:15%;"><b>Cantidad</b></td>
                <td style="width:15%;"><b>Valor Del Producto</b></td>
                <td style="width:15%;"><b>Subtotal</b></td>
            </tr>';         
            
            foreach ($factura as $value):
            $html .=' <tr>

            <td class="mono" style="width:15%;">'.$value["Referencia"] .'</td>
            <td style="width:15%;" class="mono">'.$value["Nom"] .'</td>
            <td class="mono" style="width:15%;">'.$value["Cant_Cotizada"] .'</td>
            <td style="width:15%;" class="mono">$'.$value["Valor_Producto"] .'</td>
            <td style="width:15%;" class="mono">$'.$value["Subtotal"] .'</td>
            </tr>';

            endforeach; 
            $html .='
            <tr>
                <td style="background:#eee;" colspan="3"><b>Total</b></td>
                <td style="width:15%; " class="mono" colspan="2">$'.$factura[0]["Valor_Total"].'</td>
            </tr>
            </table>

        </div>
    </div>
</div> 
</body>
</html>';
         


// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Informe De La Cotizacion ".$factura[0]["Id_Solicitud"] , ["Attachment"=>0]);
?>