<?php

define('_MPDF_PATH', '/lib');
require('./lib/mpdf/vendor/autoload.php');
include('../src/GenerateCoinToLetters.php');
require_once("./lib/phpqrcode/qrlib.php");
require './../model/VentasADO.php';

$title = "RESUMEN GENERAL DE UTILIDADES";
$fechaIngreso = date("d/m/Y", strtotime($_GET["fechaInicial"])) . " al " . date("d/m/Y", strtotime($_GET["fechaFinal"]));

$result = VentasADO::ResumenUtilidadPorFecha($_GET["fechaInicial"], $_GET["fechaFinal"]);
if (!is_array($result)) {
    echo $result;
} else {

    $empresa = $result[0];
    $detalle = $result[1];

    $photo = $empresa->Image == "" ?  "<img src=\"./../../view/image/logo.png\" width=\"80\" />" : "<img src=\"data:image/jpg;base64, " . $empresa->Image . "\" width=\"80\" />";

    $html = '
<html>
<head>
<style>
    body {
        font-family: Arial;
        font-size: 10pt;
    }
    p {	
        font-family: Arial;
    }
    table.items {
        border: 0.1mm solid #000000;
    }
    td { 
        vertical-align: middle; 
    }
    table thead th {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
        border-top: 0.1mm solid #000000;
        border-bottom: 0.1mm solid #000000;
    }
    table tbody td {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
        border-top: 0.1mm solid #000000;
        border-bottom: 0.1mm solid #000000;
    }
    table tfoot td {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
        border-top: 0.1mm solid #000000;
        border-bottom: 0.1mm solid #000000;
    }
    table thead td { 
        background-color: #EEEEEE;
        text-align: center;
        border: 0.1mm solid #000000;
        font-variant: small-caps;
    }
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
    <table width="100%">
        <tr>
            <td width="50%" style="color:#969696; ">
                <span style="font-weight: bold; font-size: 9pt;">
                    ' . $empresa->NombreComercial . '
                </span>
            </td>
            <td width="50%" style="color:#969696;text-align: right;">
                <span style="font-weight: bold; font-size: 9pt;">
                    SysSoft Integra
                </span>
            </td>
        </tr>
    </table>
</htmlpageheader>
<htmlpagefooter name="myfooter">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Pagin {PAGENO} de {nb}
    </div>
</htmlpagefooter>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<table width="100%" style="font-family: serif;" cellpadding="10">
    <tr>
        <td width="15%" style="border: 0mm solid #888888;text-align: center;">
            ' . $photo . '
            <div>
                <p>' . $empresa->NombreComercial . '</p>
            </div>
        </td>
        <td width="85%" style="border: 0mm solid #888888;text-align: center;vertical-align: middle;">
            <span style="font-size: 14pt; color: black; font-family: sans;">
                <b>' . $title . ' </b>
            </span>
            <br>
            <span style="font-size: 10pt; color: black; font-family: sans;">
                FECHA: ' . $fechaIngreso . ' 
        </span>
        </td>
    </tr>
</table>
<br />
<table class="items" width="100%" style="font-size: 14pt; border-collapse: collapse; " cellpadding="8">
    <thead>
        <tr>
            <th width="5%">N°</th>
            <th width="45%">Producto</th>
            <th width="20%">Cantidad</th>
            <th width="20%">Costo</th>
            <th width="20%">Costo Total</th>
            <th width="20%">Precio</th>
            <th width="20%">Precio Total</th>
            <th width="20%">Utilidad</th>
        </tr>
    </thead>
    <tbody>';
?>

    <?php

    $count = 0;
    $newarray = array();
    $totalCosto = 0;
    $totalPrecio = 0;

    foreach ($detalle as $value) {
        $count++;
        $totalCosto += $value["CostoTotal"];
        $totalPrecio += $value["PrecioTotal"];

        $html .= '<tr>
        <td>' . $count . '</td>
        <td>' . $value["Clave"] . '<br>' . $value["NombreMarca"] . '</td>
        <td>' . number_format(round($value["Cantidad"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . ' ' . $value["UnidadCompraNombre"] . '</td>
        <td align="right">' . number_format(round($value["Costo"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        <td align="right">' . number_format(round($value["CostoTotal"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        <td align="right">' . number_format(round($value["Precio"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        <td align="right">' . number_format(round($value["PrecioTotal"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        <td align="right">' . number_format(round($value["Utilidad"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        </tr>';
    }

    ?>
    <?php
    $html .= '</tbody>
</table>
<br />
<br />
<table class="items" width="25%" style="font-size: 8pt; border-collapse: collapse; " cellpadding="8">
    <thead>
        <tr>
            <th width="40%">Costo Total</th>
            <th width="40%">Precio Total</th>
            <th width="40%">Utilidad Total</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">' . number_format(round($totalCosto, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
            <td align="center">' . number_format(round($totalPrecio, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
            <td align="center">' . number_format(round($totalPrecio - $totalCosto, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        </tr>
    </tbody>
</table>
</body>
</html>
';


    $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 18,
        'margin_bottom' => 25,
        'margin_header' => 10,
        'margin_footer' => 10,
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'L'
    ]);

    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Utilidad Generada");
    $mpdf->SetAuthor("Syssoft Integra");
    $mpdf->SetWatermarkText((""));   // anulada
    $mpdf->showWatermarkText = true;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);

    // Output a PDF file directly to the browser
    $mpdf->Output("Utilidad Generada.pdf", 'I');
}
