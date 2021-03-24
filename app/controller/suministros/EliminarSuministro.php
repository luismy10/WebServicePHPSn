<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/SuministrosADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result = SuministrosADO::EliminarProductoById($_POST["IdSuministro"]);
    if ($result === "eliminado") {
        print json_encode(array(
            "estado" => 1,
            "message" => "Se elimino correctamente el producto."
        ));
    } else if ($result === "kardex") {
        print json_encode(array(
            "estado" => 2,
            "message" => "No se puede eliminar el producto por que esta asociado a un movimiento de kardex."
        ));
    } else if ($result === "venta") {
        print json_encode(array(
            "estado" => 3,
            "message" => "No se puede eliminar el producto por que esta asociado a una venta."
        ));
    } else if ($result === "compra") {
        print json_encode(array(
            "estado" => 4,
            "message" => "No se puede eliminar el producto por que esta asociado a una compra."
        ));
    } else {
        print json_encode(array(
            "estado" => 0,
            "message" => $result,
        ));
    }
    exit();
}
