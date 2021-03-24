<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/VentasADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    $result = VentasADO::RegistrarNotaCredito($body);
    if ($result == "registrado") {
        print json_encode(array(
            "estado" => 1,
            "message" => "Se registro correctamente la nota de crédito."
        ));
    } else {
        print json_encode(array(
            "estado" => 0,
            "message" => $result
        ));
    }
}
