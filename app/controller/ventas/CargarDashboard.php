<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/VentasADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "global") {
        $data = VentasADO::LoadDashboard($_GET["fechaActual"]);
        $productoAgotados = VentasADO::LoadProductosAgotados(intval($_GET["posicionPaginaAgotados"]), intval($_GET["filasPorPaginaAgotados"]));
        $productosPorAgotarse = VentasADO::LoadProductosPorAgotarse(intval($_GET["posicionPaginaPorAgotarse"]), intval($_GET["filasPorPaginaPorAgotarse"]));
        if (is_array($data) && is_array($productoAgotados) && is_array($productosPorAgotarse)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $data,
                "productosAgotadosLista" => $productoAgotados[0],
                "productosAgotadosTotal" => $productoAgotados[1],
                "productoPorAgotarseLista" => $productosPorAgotarse[0],
                "productoPorAgotarseTotal" => $productosPorAgotarse[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $data,
            ));
        }
    } else if ($_GET["type"] == "productosAgotados") {
        $productoAgotados = VentasADO::LoadProductosAgotados(intval($_GET["posicionPaginaAgotados"]), intval($_GET["filasPorPaginaAgotados"]));
        if (is_array($productoAgotados)) {
            print json_encode(array(
                "estado" => 1,
                "productosAgotadosLista" => $productoAgotados[0],
                "productosAgotadosTotal" => $productoAgotados[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $productoAgotados,
            ));
        }
    } else if ($_GET["type"] == "productosPorAgotarse") {
        $productosPorAgotarse = VentasADO::LoadProductosPorAgotarse(intval($_GET["posicionPaginaPorAgotarse"]), intval($_GET["filasPorPaginaPorAgotarse"]));
        if (is_array($productosPorAgotarse)) {
            print json_encode(array(
                "estado" => 1,
                "productoPorAgotarseLista" => $productosPorAgotarse[0],
                "productoPorAgotarseTotal" => $productosPorAgotarse[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 0,
                "message" => $productoAgotados,
            ));
        }
    }

    exit();
}
