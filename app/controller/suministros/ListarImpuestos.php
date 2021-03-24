<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/SuministrosADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    //$search = $_GET['search'];
    if ($_GET["type"] === "impuestos") {
        $impuestos = SuministrosADO::ListarImpuesto();
        if (is_array($impuestos)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $impuestos
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $impuestos
            ));
        }
        exit();
    } else if ($_GET["type"] === "detalles") {
        $detalle = SuministrosADO::ObtenerDetalleId("4", $_GET["mantenimiento"], $_GET["nombre"]);
        if (is_array($detalle)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $detalle
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $detalle
            ));
        }
        exit();
    }
}
