<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/SuministrosADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //$search = $_GET['search'];
    $suministro = SuministrosADO::ListarSuministroNegativos();
    if (is_array($suministro)) {
         print json_encode(array(
            "estado" => 1,
            "suministros" => $suministro
        ));
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => $suministro
        ));
    }
    exit();
}