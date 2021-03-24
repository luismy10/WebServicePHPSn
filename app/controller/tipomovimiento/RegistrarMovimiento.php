<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/MovimientoADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Manejar petición GET
    $body = json_decode(file_get_contents("php://input"), true);
    //$search = $_GET['search'];
    $result = MovimientoADO::RegistrarMovimientoInventario($body);
    if($result === "inserted"){
        print json_encode(array(
            "estado" => 1,
            "mensaje" => "Registrado correctamente el movimiento."
        ));
    }else{
        print json_encode(array(
            "estado" => 2,
            "mensaje" => $result
        ));
    }   
    exit();
}
