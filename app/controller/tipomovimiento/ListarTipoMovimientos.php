<?php
error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/MovimientoADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    //$search = $_GET['search'];
    $tipomovimientos = MovimientoADO::ListarInventario($_GET["ajuste"],$_GET["all"]);
    if (is_array($tipomovimientos)) {
         print json_encode(array(
            "estado" => 1,
            "data" => $tipomovimientos
        ));
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => $tipomovimientos
        ));
    }
    exit();
}