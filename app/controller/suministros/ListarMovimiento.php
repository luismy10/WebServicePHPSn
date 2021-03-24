<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/SuministrosADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $init = $_GET["init"];
    $opcion = $_GET["opcion"];
    $movimiento = $_GET["movimiento"];
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
    $posicionPagina = $_GET['posicionPagina'];
    $filasPorPagina = $_GET['filasPorPagina'];
    $listarMovimiento = SuministrosADO::ListarMoviminentos($init, $opcion, $movimiento, $fechaInicial, $fechaFinal,intval($posicionPagina),intval($filasPorPagina));
    if (is_array($listarMovimiento)) {
        print json_encode(array(
            "estado" => 1,
            "data" => $listarMovimiento[0],
            "total" =>$listarMovimiento[1]
        ));
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => $listarMovimiento
        ));
    }
    exit();
}