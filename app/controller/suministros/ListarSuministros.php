<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/SuministrosADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    if ($_GET["type"] == "modalproductos") {
        $tipo = $_GET["tipo"];
        $value = $_GET["value"];
        $posicionPagina = $_GET["posicionPagina"];
        $filasPorPagina = $_GET["filasPorPagina"];
        //$search = $_GET['search'];
        $suministros = SuministrosADO::ListarSuministroView($tipo, $value, $posicionPagina, $filasPorPagina);
        if (is_array($suministros)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $suministros[0],
                "total" => $suministros[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "mensaje" => $suministros
            ));
        }
        exit();
    } else if ($_GET["type"] === "listaproductos") {
        $opcion = $_GET["opcion"];
        $clave = $_GET["clave"];
        $nombre = $_GET["nombre"];
        $posicionPagina = $_GET["posicionPagina"];
        $filasPorPagina = $_GET["filasPorPagina"];
        $suministros = SuministrosADO::ListarSuministros(intval($opcion), $clave, $nombre, 0, 0, intval($posicionPagina), intval($filasPorPagina));
        if (is_array($suministros)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $suministros[0],
                "total" => $suministros[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $suministros
            ));
        }
        exit();
    } else if ($_GET["type"] == "getproducto") {
        $producto = SuministrosADO::ObtenerSuministroById($_GET["idSuministro"]);
        if (is_array($producto)) {
            print json_encode(array(
                "estado" => 1,
                "suministro" => $producto[0],
                "precios" => $producto[1],
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $producto
            ));
        }
        exit();
    } else if ($_GET["type"] == "kardexlista") {
        $kardex = SuministrosADO::KardexSuministroById(0,$_GET["idSuministro"],"","");
        if(is_array($kardex)){
            print json_encode(array(
                "estado" => 1,
                "kardex" => $kardex[0],
                "cantidad" => $kardex[1],
                "saldo" => $kardex[2],
            ));
        }else{
            print json_encode(array(
                "estado" => 2,
                "message" => $producto
            ));
        }
    }
}
