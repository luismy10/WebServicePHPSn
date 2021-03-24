<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');
require '../../model/VentasADO.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "venta") {
        $opcion = $_GET['opcion'];
        $busqueda = $_GET['busqueda'];
        $fechaInicial = $_GET['fechaInicial'];
        $fechaFinal = $_GET['fechaFinal'];
        $empleado = $_GET['empleado'];
        $posicionPagina = $_GET['posicionPagina'];
        $filasPorPagina = $_GET['filasPorPagina'];
        $ventas = VentasADO::ListVentas($opcion, $busqueda, $fechaInicial, $fechaFinal, 0, 0, $empleado, $posicionPagina, $filasPorPagina, '');
        if (is_array($ventas)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $ventas[0],
                "total" => $ventas[1],
                "suma" => $ventas[2]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $ventas
            ));
        }
        exit();
    } else if ($_GET["type"] == "allventa") {
        $detallle = VentasADO::ListVentaDetalle($_GET['idVenta']);
        if (is_array($detallle)) {
            print json_encode(array(
                "estado" => 1,
                "venta" => $detallle[0],
                "ventadetalle" => $detallle[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $detallle
            ));
        }
    } else if ($_GET["type"] == "getventanotacredito") {
        $result = VentasADO::ListarComprobanteParaNotaCredito($_GET['comprobante']);
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "notaCredito" => $result[0],
                "monedas" => $result[1],
                "tipoComprobante" => $result[2],
                "motivoAnulacion" => $result[3],
                "tipoDocumento" => $result[4],
                "venta" => $result[5],
                "detalle" => $result[6]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $result
            ));
        }
    } else if ($_GET["type"] == "listaNotaCredito") {
        $opcion = $_GET["opcion"];
        $buscar = $_GET["search"];
        $fechaInicio = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
        $posicionPagina = $_GET["posicionPagina"];
        $filasPorPagina = $_GET["filasPorPagina"];
        $notacredito = VentasADO::ListaNotaCredito($opcion, $buscar, $fechaInicio, $fechaFinal, $posicionPagina, $filasPorPagina);
        if (is_array($notacredito)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $notacredito[0],
                "total" => $notacredito[1]
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $notacredito
            ));
        }
    } else if ($_GET["type"] == "listarNotificaciones") {
        $result = VentasADO::ListarNotificaciones();
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $result
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $result
            ));
        }
    } else if ($_GET["type"] == "getproductosvendidos") {
        $producto = VentasADO::ResumenProductoVendidos($_GET["fechaInicio"], $_GET["fechaFinal"], intval($_GET["marca"]), intval($_GET["categoria"]));
        if (is_array($producto)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $producto
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $producto
            ));
        }
        exit();
    } else if ($_GET["type"] == "detalleid") {
        $result = VentasADO::GetDetalleId($_GET["idMantenimiento"]);
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $result
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $result
            ));
        }
    } else if ($_GET["type"] == "listarDetalleNotificaciones") {
        $result = VentasADO::ListarDetalleNotificaciones();
        if (is_array($result)) {
            print json_encode(array(
                "estado" => 1,
                "data" => $result
            ));
        } else {
            print json_encode(array(
                "estado" => 2,
                "message" => $result
            ));
        }
    }
}
