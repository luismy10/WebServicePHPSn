<?php

define('_MPDF_PATH', '/lib');
    require('./lib/mpdf/vendor/autoload.php');
    include('../src/GenerateCoinToLetters.php');
    require_once("./lib/phpqrcode/qrlib.php");
    require './../model/VentasADO.php';

    $ventaDatos = VentasADO::ListVentaDetalle($_GET["idVenta"]);
    if(is_array($ventaDatos)){
        $venta = $ventaDatos[0];
        $detalleVenta = $ventaDatos[1];
        $empresa = $ventaDatos[2];
    
    }