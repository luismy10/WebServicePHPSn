<?php

define('_MPDF_PATH', '/lib');
require('./lib/mpdf/vendor/autoload.php');
include('../src/GenerateCoinToLetters.php');
require_once("./lib/phpqrcode/qrlib.php");
require './../model/VentasADO.php';

$title = "RESUMEN DE INGRESOS";
$fechaIngreso = date("d-m-Y", strtotime($_GET["fechaInicial"])) . " al " . date("d-m-Y", strtotime($_GET["fechaFinal"]));

$result = VentasADO::ResumenIngresoPorFechas($_GET["fechaInicial"], $_GET["fechaFinal"]);
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
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
    <thead>
        <tr>
            <th width="5%" rowspan="2">N°</th>
            <th width="45%" rowspan="2">Concepto</th>
            <th width="20%" colspan="2">Resumen</th>
        </tr>
        <tr>
            <th>Ingresos</th>
            <th>Egresos</th>
        </tr>
    </thead>
    <tbody>';
?>

<?php
    $count = 0;
    $totalIngresos = 0;
    $totalEgresos = 0;

    $totalIngresoEfectivo = 0;
    $totalIngresoTarjeta = 0;

    $totalEgresoEfectivo = 0;
    $totalEgresosTarjeta = 0;

    foreach ($detalle as $value) {
        $count++;
        $totalIngresos += $value["TipoMovimiento"] == 5 || $value["TipoMovimiento"] == 6 ? 0 : $value["Ingresos"];
        $totalEgresos += $value["TipoMovimiento"] == 5 || $value["TipoMovimiento"] == 6  ? $value["Egresos"] : 0;

        $totalIngresoEfectivo += $value["TipoMovimiento"] == 1 || $value["TipoMovimiento"] == 2 || $value["TipoMovimiento"] == 4 ? $value["Ingresos"] : 0;
        $totalIngresoTarjeta += $value["TipoMovimiento"] == 3 ? $value["Ingresos"] : 0;

        $totalEgresoEfectivo += $value["TipoMovimiento"] == 5 ? $value["Egresos"] : 0;
        $totalEgresosTarjeta +=  $value["TipoMovimiento"] == 6 ? $value["Egresos"] : 0;

        $html .= '<tr>
        <td align="center">' . $count . '</td>
        <td>' . $value["Concepto"] . '</td>
        <td align="right">' . number_format(round($value["Ingresos"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        <td align="right">' . number_format(round($value["Egresos"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        </tr>';
    }
?>
    <?php

    $html .= '</tbody>
    <tfoot>
        <tr>
            <td align="center" colspan="2" style="border-left:1px solid white;border-bottom:1px solid white;"></td>
            <td align="right">' . number_format(round($totalIngresos, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
            <td align="right">' . number_format(round($totalEgresos, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
        </tr>
    </tfoot>
</table>
<br>
<div>
    <span style="font-size:10pt;font-weight:bold;">RESUMEN GENERAL</span>
</div>
<table class="items" width="50%" style="font-size: 9pt; border-collapse: collapse;" >
    <thead>        
        <tr>
            <th align="left" style="padding:8pt;font-weight:normal;">INGRESOS EN EFECTIVO:</th>
            <th align="right" style="padding:8pt;">' . number_format(round($totalIngresoEfectivo, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</th>
        </tr>
        <tr>
        <th align="left" style="padding:8pt;font-weight:normal;">INGRESOS CON TARJETA:</th>
        <th align="right" style="padding:8pt;">' . number_format(round($totalIngresoTarjeta, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</th>
        </tr>
        <tr>
            <th align="left" style="padding:8pt;font-weight:normal;">EGRESOS EN EFECTIVO:</th>
            <th align="right" style="padding:8pt;">-' . number_format(round($totalEgresoEfectivo, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</th>
        </tr>
        <tr>
            <th align="left" style="padding:8pt;font-weight:normal;">EGRESOS EN TARJETA:</th>
            <th align="right" style="padding:8pt;">-' . number_format(round($totalEgresosTarjeta, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</th>
        </tr>
        <tr>
            <th align="left" style="padding:8pt;font-weight:normal;">TOTAL:</th>
            <th align="right" style="padding:8pt;">' . number_format(round($totalIngresos - $totalEgresos, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</th>
        </tr>
    </thead>
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
        'orientation' => 'P'
    ]);

    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Resumen de Ingresos");
    $mpdf->SetAuthor("Syssoft Integra");
    $mpdf->SetWatermarkText((""));   // anulada
    $mpdf->showWatermarkText = true;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);

    // Output a PDF file directly to the browser
    $mpdf->Output("Resumen de Ingresos.pdf", 'I');
}
