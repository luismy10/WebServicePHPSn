<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/SuministrosADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents("php://input"), true);

    $result = SuministrosADO::RegistrarSuministro($body);
    if ($result === "registrado") {
        print json_encode(array(
            "estado" => 1,
            "message" => "Se registró correctamente el producto."
        ));
    } else if ($result === "duplicate") {
        print json_encode(array(
            "estado" => 2,
            "message" => "No se puede haber 2 producto con la misma clave."
        ));
    } else if ($result === "duplicatename") {
        print json_encode(array(
            "estado" => 3,
            "message" => "No se puede haber 2 producto con el mismo nombre."
        ));
    } else {
        print json_encode(array(
            "estado" => 0,
            "message" => $result,
        ));
    }
}
