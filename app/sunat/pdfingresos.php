<?php

define('_MPDF_PATH', '/lib');
require('./lib/mpdf/vendor/autoload.php');
include('../src/GenerateCoinToLetters.php');
require_once("./lib/phpqrcode/qrlib.php");
require './../model/VentasADO.php';

$ventaDatos = VentasADO::ListVentaDetalle($_GET["idVenta"]);

if (is_array($ventaDatos)) {
    $venta = $ventaDatos[0];
    $detalleVenta = $ventaDatos[1];
    $empresa = $ventaDatos[2];

    //$logo = ($empresa->Image == "" ? './../../view/image/logo.png':"data:image/png;base64,".$empresa->Image);
    $photo = $empresa->Image == "" ?  "<img src=\"./../../view/image/logo.png\"/>" :"<img src=\"data:image/jpg;base64, ".$empresa->Image."\"/>";

    $gcl = new GenerateCoinToLetters();

    $textoCodBar =
        '|' . $empresa->NumeroDocumento
        . '|' . $venta->CodigoAlterno
        . '|' . $venta->Serie
        . '|' . $venta->Numeracion
        . '|' . number_format(round($venta->Total, 2, PHP_ROUND_HALF_UP), 2, '.', '')
        . '|' . number_format(round($venta->Impuesto, 2, PHP_ROUND_HALF_UP), 2, '.', '')
        . '|' . $venta->FechaVenta
        . '|' . $venta->IdAuxiliar
        . '|' . $venta->NumeroDocumento
        . '|';

    $qrCode = QrCode::png($textoCodBar, 'codbar.png', 'L', 4, 2);

    $html .= '<html>
        <head>
            <style>
                body {
                    font-family: "Arial";
                    font-size: 10pt;
                    color:#000000;
                }
                .cont-header{
                    width: 100%;
                }
                .caja-info-tres{
                    float:left;
                    width:6%;
                    height:130px;
                    text-align: center;
                }
                .caja-info-tres-top{
                    height:90px;
                    background: #576767;
               }
                .caja-info-tres-bottom{
                    height:40px;
                    background: #b5b5b5;
               }
                .caja-info-uno{
                    background: rgb(2,2,3);
                    color: white;
                    float:left;
                    width:57%;
                    height:130px;
               }
                .caja-info-dos{
                    background: #fe3152;
                    font-size: 15px;
                    float:right; 
                    color: white;
                    width: 37%;
                    height:130px;
                    text-align: center
                }
                .logo{
                    width: 28%;
                    height:120px;
                    float: left;   
                    padding:10px 0px 0px 5px;                 
                }
                .texto{
                    float: right;
                    width: 70%;
                    text-align:center;
                    padding: 15px 0px 0px 0px;          
                }
                .container-info{
                    color: white;
                    width: 100%;  
                    height:100px;
                }
                .caja-one{
                    float: left;  width:100%;
                }
                .caja-two{
                    display: block; 
                    float:left; 
                    width: 100%;   
                    height: 110px;  
                    padding-top: 5px;
               }
                .caja-three{
                    display: block; float:left; width: 33%;   height: 110px;  padding-top: 10px;
               }
                .caja-four{
                    display: block; float:left; width: 33%;   height: 110px; padding-top: 10px;
                }
                .detalle-compra{
                    width: 100%;
                    height: 55%;
                    border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-bottom: 1px solid black;
                }
                p {	
                    margin: 0pt; 
                }
                table.items {
                }
                td { 
                    vertical-align: center; 
                }
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
	                font-variant: small-caps;
               }
                .items td.blanktotal {
                    border: 1px solid #000000;
                    background-color: #FFFFFF;
                    border-top: 1px solid #000000;
                    border-right: 1px solid #000000;
               }
                .items td.totals {
                    float: left;
                    color: white;
                    background: rgb(2,2,3);;
                    padding: 6px;
               }
                .items td.cost {           
                    text-align: right;
                    padding: 6px;
                    border-bottom: 1px solid black;
               }
                .items td.qr {
                    border: 0px;
                }
                .items td.estado {
                    border: 0px;
                    text-align:center;
                    font-size: 16px;
               }
                .footer{
                    border: 1px solid black;
               }
                .footer-top{
                    width: 100%;
                    height:auto;
                }
                .footer-left{
                    height:auto;
                    float:left;
                    padding-left:10px;
                    display:flex;
                    flex-wrapper: wrapper;
                    width:18%;
               }
                .footer-center{
                    float:left;
                    width:45%;
                }       
                .footer-right{
                    width:35%;
                    float:right;
                }
                .footer-bottom{
                    padding-top: 10px;
                    whidth:100%;
                }
            </style>
        </head>
        <body>

            <!--#####################cabecera###################################-->
            <div class="cont-header">
                <div class="caja-info-uno">
                    <div class="logo" alt="">
                        '. $photo.'
                    </div>
                    <div class="texto">
                        <p style="font-size:11pt; line-height: 15px">' . $empresa->RazonSocial . '</p><br>                
                        <p style="font-size:8pt; line-height: 0px">' . $empresa->Domicilio . '</p>
                        <p style="font-size:8pt; line-height: 0px">EMAIL: ' . $empresa->Email . '</p>
                        <p style="font-size:8pt; line-height: 0px">TELÉFONO: ' . $empresa->Telefono . ' CELULAR: ' . $empresa->Celular . '</p>
                    </div>
                </div>
                <div class="caja-info-tres">
                    <div class="caja-info-tres-top"></div>
                    <div class="caja-info-tres-bottom"></div>
                </div>
                <div class="caja-info-dos">
                    <p style="line-height: 35px; padding-top:10px;">R.U.C.: ' . $empresa->NumeroDocumento . '</p>
                    <p style="line-height: 35px;">'.$venta->Comprobante.' ELECTRÓNICO</p>
                    <p style="line-height: 35px;">' . $venta->Serie . '-' . $venta->Numeracion . '</p>         
                </div>
            </div>
            <!--#########################Fin de la cabecera###################################-->
                
            <!--#####este es el contenedor donde se encuentra toda la informacion correspondiente del cliente########-->
            <div class="container-info">
                
                <table  style="font-family: arial; font-size:8pt;color:white; border-collapse: collapse; width:100%">
                    <tr>
                        <td style="background: rgb(2,2,3);border: 1px solid black;padding:6px;" width="15%"><p>D.N.I./R.U.C.:</p></td>
                        <td colspan="3" style="background: white;border: 1px solid black; color: black; width:65%;padding:6px;"><p>' . $venta->NumeroDocumento . '</p></td>
                        <td style="background: rgb(2,2,3);border: 1px solid black; width:10%; text-align:center;padding:6px;"><p>Fecha de Venta</p></td>
                    </tr>
                    <tr>
                        <td style=" background: rgb(2,2,3);border: 1px solid black;padding:6px;"><p>Nombre:</p></td>
                        <td colspan="3" style="width:27%; border: 1px solid black; color: black;padding:6px;"><p>' . $venta->Informacion . '</p></td>
                        <td style="width:20%; border-right: 1px solid black; color: black; text-align:center;border: 1px solid black;padding:6px;"><p>' . $venta->FechaVenta . '</p></td>
                    </tr>    
                    <tr>
                        <td style=" background: rgb(2,2,3);border: 1px solid black;padding:6px;"><p>Dirección:</p></td>
                        <td colspan="3" style=" width:65%; color: black;border: 1px solid black;padding:6px;"><p>' . $venta->Direccion . '</p></td>                        
                        <td style="background: rgb(2,2,3); width:20%; text-align:center;border: 1px solid black;padding:6px;"><p></p>Moneda</td>
                    </tr>    
                    <tr>
                        <td style="background: rgb(2,2,3);border: 1px solid black;padding:6px;"><p>Celular:</p></td>
                        <td style="color: black;border: 1px solid black;padding:6px;;"><p>' . $venta->Celular . '  ' . $venta->Telefono . '</p></td>
                        <td style="background: rgb(2,2,3);border: 1px solid black;padding:6px;" width="15%"><p>Email:</p></td>
                        <td style="color: black;border: 1px solid black;padding:6px;"><p></p>' . $venta->Email . '</td>
                        <td style="border: 1px solid black; color: black; text-align:center;padding:6px;"><p>' . $venta->Nombre . ' - ' . $venta->Abreviado . '</p></td>
                    </tr>            
                </table>
            </div>
            <!--#####################Fin de la caja de informacion del cliente###################################-->

            <!--##################### Inicio detalle de la compra ###################################-->
            <div class="detalle-compra" >
                <table  width="100%" style="font-family:Arial;  border-collapse: collapse;" cellpadding="6">
                    <thead>
                        <tr>
                            <td width="5%" style="border: none;color:white; background:rgb(2,2,3);font-size: 8pt;">Ítem</td>                    
                            <td width="11%" style="border: none;color:white; background:rgb(2,2,3);font-size: 8pt;">Cantidad</td>
                            <td width="10%" style="border: none;color:white; background:rgb(2,2,3);font-size: 8pt;">Unidad</td>                    
                            <td width="46%" style="border: none;color:white; background:rgb(2,2,3);font-size: 8pt;">Descripcion</td>
                            <td width="11%" style="border: none;color:white; background:rgb(2,2,3);font-size: 8pt;">Prec. Unit.</td>
                            <td width="11%" style="border: none;color:white; background:rgb(2,2,3);font-size: 8pt;">Importe</td>
                        </tr>
                    </thead>
                    <tbody>';
?>
                    <?php
                    // number_format(round($totales['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), 2, '.', '') 
                    foreach ($detalleVenta as $value) {

                        $html .= '<tr>
                        <td style="text-align: center;font-size: 7pt;">' . $value["id"] . '</td>
                        <td style="text-align: center;font-size: 7pt;">' . $value["Cantidad"] . '</td>
                        <td style="text-align: left;font-size: 7pt;">' . $value["UnidadCompra"] . '</td>
                        <td style="text-align: left;font-size: 7pt;">' . $value["NombreMarca"] . '</td>
                        <td style="text-align: right;font-size: 7pt;">' . number_format(round($value["PrecioVenta"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
                        <td style="text-align: right;font-size: 7pt;">' . number_format(round($value["PrecioVenta"] * $value["Cantidad"], 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
                        </tr>';
                    }
                    ?>
                    <?php
                    $html  .= '</tbody>
                </table>
                <div style="font-style: italic;font-weight: bold;padding:5px 0px;"></div>
            </div>
            <!--##################### Fin del detalle de la compra ###################################-->

            <!--##################### Inicio del pie de factura ###################################-->
            <div style="border-left: 1px solid #000000; border-right: 1px solid #000000">
                <p style="padding:7px 10px;font-size: 9pt;"><b>SON: ' . $gcl->getResult(round($venta->Total, 2, PHP_ROUND_HALF_UP), "SOLES") . '</b></p>
            </div>
            <div class="footer">
                <div class="footer-top">
                    <div class="footer-left">
                        <div style="width:100px; height:100px; padding-top: 20px; ">
                            <img src="codbar.png" />
                        </div>
                    </div>
                    <div class="footer-center">
                        <div width="100%" height="2%" style="text-align: center; padding-top:20px;">CANCELADO</div>
                        <div width="100%" height="2%" style="display:inline-block; padding-top:10px;">
                            <table>
                                <tr>
                                    <td style="width: 27%; border-bottom: 1px solid black;"> </td>
                                    <td style="width: 8%"> DE </td>
                                    <td style="width: 27%; border-bottom: 1px solid black;"> </td>
                                    <td style="width: 8%"> DEL </td>
                                    <td style="width: 27%; border-bottom: 1px solid black;"> </td>
                                </tr>
                            </table>
                        </div>
                        <div width="100%" height="2%" style="padding-top:10px; padding-top:20px; font-size:8pt; text-align:center;">
                            Cta. Ahorros Scotiabank: 1670143096<br>
                            CTa. Ahorros BCP: 191-38640771080 <br>
                            CTa. Corriente BCP: 191-2412-5720-13<br>
                        </div>
                    </div>
                    <div class="footer-right">
                        <table class="items" style="font-family:Arial; font-size: 9pt; border-collapse: collapse;" width="100%">
                            <tr>
                                <td class="totals" width="55%" >IMPORTE BRUTO:</td>
                                <td class="cost"  width="45%">S/ ' . number_format(round(($venta->SubTotal), 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
                            </tr>  
                            <tr>
                                <td class="totals" width="55%">DESCUENTO TOTAL: </td>
                                <td class="cost" width="45%">S/ -' . number_format(round(($venta->Descuento), 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
                            </tr>
                            <tr>
                                <td class="totals" width="55%">SUB IMPORTE: </td>
                                <td class="cost" width="45%">S/ ' . number_format(round(($venta->SubTotal - $venta->Descuento), 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
                            </tr>
                            <tr>
                                <td class="totals" width="55%">IGV(18%). </td>
                                <td class="cost" width="45%">S/ ' . number_format(round(($venta->Impuesto), 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
                            </tr>
                            <tr>
                                <td class="totals" width="55%">IMPORTE NETO :</td>
                                <td class="cost" width="45%">S/ ' . number_format(round($venta->Total, 2, PHP_ROUND_HALF_UP), 2, '.', '') . '</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="footer-bottom">
                    <table style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <td width="45%" style="font-size:7pt; padding-left: 5px;">
                                <p>Representación impresa de la Facturación Electrónica.</p>
                                <p>Para consultar el Documento ingrese a: www.sunat.pe.</p>
                            </td>
                            <td width="5%" style="background: #b5b5b5;"></td>
                            <td width="49%" rowspan="2" style="background: #fe3152; color:white; font-size:12pt; vertical-align: middle; text-align: center;">Gracias por su preferencia.</td>
                        </tr>                
                        <tr>
                            <td width="45%" style="background: rgb(2,2,3); color: white; vertical-align:middle; ">
                                <table style="border-collapse: collapse; width:100%; color: white;">
                                    <tr>
                                        <td width="10%"><img width="20px" src="./../../view/image/icon.png"></td>
                                        <td width="99%" style="vertical-align: middle; text-align: center;">Generado por SysSoft Integra</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="5%" style="background: #576767"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <footer>     
            </footer>
        </body>
        </html>';



                    $mpdf = new \Mpdf\Mpdf([
                        'margin_left' => 5,
                        'margin_right' => 5,
                        'margin_top' => 5,
                        'margin_bottom' => 5,
                        'margin_header' => 5,
                        'margin_footer' => 5,
                        'mode' => 'utf-8',
                        'format' => 'A4',
                        'orientation' => 'P'
                    ]);

                    $mpdf->SetProtection(array('print'));
                    $mpdf->SetTitle("Syssoft Integra");
                    $mpdf->SetAuthor("Syssoft Integra");
                    $mpdf->SetWatermarkText(("PAGADO"));   // anulada
                    $mpdf->showWatermarkText = true;
                    $mpdf->watermark_font = 'DejaVuSansCondensed';
                    $mpdf->watermarkTextAlpha = 0.1;
                    $mpdf->SetDisplayMode('fullpage');
                    $mpdf->WriteHTML($html);

                    // Output a PDF file directly to the browser
                    $mpdf->Output("SysSoft Integra.pdf", 'I');
                } else {
                    echo "Error la verga";
                }
