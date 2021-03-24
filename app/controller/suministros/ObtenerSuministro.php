<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/SuministrosADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $idSuministro = $_GET["idSuministro"];
    //$search = $_GET['search'];
    $suministro = SuministrosADO::ObtenerSuministroForMovimiento($idSuministro);
    if (!is_null($suministro)) {
         print json_encode(array(
            "estado" => 1,
            "data" => $suministro
        ));
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => $suministro
        ));
    }
    exit();
}