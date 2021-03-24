<?php
// Require composer autoload
require_once __DIR__ . '/lib/mpdf/vendor/autoload.php';
//require_once ("lib/PDF417/vendor/autoload.php");
// Create an instance of the class:

// Write some HTML code:

$html .= '<html>
<head>
<style>
body {font-family: arial;
	font-size: 10pt;
	color:black;
}
p {	margin: 0pt; }
table.items {
	border: 1px solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0px solid #E11E1E;
}
table thead td { 
    background-color: #B4B6B4;
	text-align: center;
	border: 1px solid #000000;
	font-variant: small-caps;
}
table tbody td{
    text-align: center;
    border-left: 1px solid #000000;
    border-right: 1px solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	border: 1px solid #000000;
	background-color: #FFFFFF;
	border-top: 1px solid #000000;
	border-right: 1px solid #000000;
}
.items td.totals {
	text-align: right;
	border: 1px solid #000000;
}
.items td.simbolo{
    border-top: 1px solid #000000;
    border-bottom: 1px solid #000000;
    border-right: 0px solid #000000;
}
.items td.costt {
    border-top: 0px solid #000000;
    border-bottom: 0px solid #000000;
    border-left:0px solid #000000;
    border-right: 1px solid #000000;
    text-align: "." center;
    padding-right: 10px;
}
.items td.cost {
	border-top: 1px solid #000000;
    border-bottom: 1px solid #000000;
    border-left:0px solid #000000;
    border-right: 1px solid #000000;
    text-align: "." center;
    padding-right: 10px;
}
.items td.qr {
    border: 0px;
}
.items td.estado {
    border: 0px;
    text-align:center;
    font-size: 16px;
}

.detalle-compra{
    width: 100%;
}

.container-info{
    width: 100%;  height:100px;  margin-top: 6px;
}
.caja-one{
float: left;  width:100%;   height: 60px;  border-bottom: 2px solid #8E8E8E;
}
.caja-two{
display: block; float:left; width: 33%;   height: 110px;  padding-top: 10px;
}
.caja-three{
display: block; float:left; width: 33%;   height: 110px;  padding-top: 10px;
}
.caja-four{
display: block; float:left; width: 33%;   height: 110px; padding-top: 10px;
}
.cont-header { *display: inline-block; }

* html .cont-header { height: 1%; }
.cont-header:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; font-size: 0; }

</style>
</head>
<body>

<htmlpageheader name="myheader">
	<div class="cont-header">
	
	</div>
</htmlpageheader>

<div class="detalle-compra" >
<table class="items" width="100%" style="font-size: 9pt; border: 1px solid #000000; border-collapse: collapse;" cellpadding="6">
    <thead>
        <tr>
            <td width="4%">IT</td>
            <td width="5%">CANT</td>
            <td width="15%">CODIGO</td>
            <td width="53%">D E S C R I P C I O N</td>
            <td width="10%">P. UNIT</td>
            <td width="13%">P. VENTA</td>
        </tr>
    </thead>
    <tbody>
    
    </tbody>
</table>

</body>
</html>';

$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 10,
	'margin_right' => 10,
	'margin_top' => 40,
	'margin_bottom' => 50,
	'margin_header' => 10,
	'margin_footer' => 10,
	'mode' => 'utf-8', 
	'format' => 'A4',
	'orientation' => 'P'
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Factura electronica Peru");
$mpdf->SetAuthor("Acme Trading Co.");
$mpdf->SetWatermarkText("Pagada");   // anulada
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output();