<?php

set_time_limit(300);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Ws\Services\SunatEndpoints;

require __DIR__ . './../vendor/autoload.php';
include_once __DIR__ . './../model/VentasADO.php';

$util = Util::getInstance();

$idventa = $_GET['idventa'];
$detalleventa = VentasADO::ListarDetalleVentPorId($idventa);

if (!is_array($detalleventa)) {

    echo json_encode(array(
        "state" => false,
        "code" => "-1",
        "description" => $detalleventa
    ));
} else {

    $detalle = $detalleventa[0]['detalle'];
    $empresa = $detalleventa[1];
    $cliente = $detalleventa[2];
    $venta = $detalleventa[3];

    // Cliente
    $client = new Client();
    $client->setTipoDoc($cliente->IdAuxiliar)
        ->setNumDoc($cliente->NumeroDocumento)
        ->setRznSocial($cliente->Informacion);

    // Empresa

    $company = new Company();
    $company->setRuc($empresa->NumeroDocumento)
        ->setNombreComercial($empresa->NombreComercial)
        ->setRazonSocial($empresa->RazonSocial)
        ->setAddress((new Address())
            ->setUbigueo($empresa->CodigoUbigeo)
            ->setDistrito($empresa->Distrito)
            ->setProvincia($empresa->Provincia)
            ->setDepartamento($empresa->Departamento)
            ->setUrbanizacion('')
            ->setCodLocal('0000')
            ->setDireccion($empresa->Domicilio))
        ->setEmail($empresa->Telefono)
        ->setTelephone($empresa->Email);

    // Venta
    $invoice = new Invoice();
    $invoice
        ->setUblVersion('2.1')
        ->setTipoOperacion('0101')
        ->setTipoDoc($venta->TipoComprobante)
        ->setSerie($venta->Serie)
        ->setCorrelativo($venta->Numeracion)
        ->setFechaEmision(new DateTime($venta->FechaVenta . "T" . $venta->HoraVenta))
        ->setTipoMoneda($venta->TipoMoneda)
        ->setCompany($company)
        ->setClient($client)
        ->setMtoOperExoneradas(round($detalleventa[0]['opexonerada'], 2, PHP_ROUND_HALF_UP))
        ->setMtoOperGravadas(round($detalleventa[0]['opgravada'], 2, PHP_ROUND_HALF_UP)) //5.10
        ->setMtoIGV(round($detalleventa[0]['totalimpuesto'], 2, PHP_ROUND_HALF_UP)) //0.92
        ->setTotalImpuestos(round($detalleventa[0]['totalimpuesto'], 2, PHP_ROUND_HALF_UP)) //0.92
        ->setValorVenta(round($detalleventa[0]['totalsinimpuesto'], 2, PHP_ROUND_HALF_UP)) //5.10
        ->setSubTotal(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP)) //6
        ->setMtoImpVenta(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP)) //6
    ;

    $detail = [];

    foreach ($detalle as $value) {
        $cantidad = $value['Cantidad'];
        $impuesto = $value['ValorImpuesto'];
        $precioVenta = $value['PrecioVenta'];

        $precioBruto = $precioVenta / (($impuesto / 100.00) + 1);
        $impuestoGenerado = $precioBruto * ($impuesto / 100.00);
        $impuestoTotal = $impuestoGenerado * $cantidad;
        $importeBrutoTotal = $precioBruto * $cantidad;
        $importeNeto = $precioBruto + $impuestoGenerado;
        $importeNetoTotal = $importeBrutoTotal + $impuestoTotal;

        $item1 = new SaleDetail();
        $item1->setCodProducto($value['ClaveSat'])            
            ->setUnidad($value['CodigoUnidad'])
            ->setCantidad(round($cantidad, 2, PHP_ROUND_HALF_UP))
            ->setDescripcion($value['NombreMarca'])
            ->setMtoBaseIgv($importeBrutoTotal) //18 50*2
            ->setPorcentajeIgv(round($impuesto, 0, PHP_ROUND_HALF_UP))
            ->setIgv($impuestoTotal)
            ->setTipAfeIgv($value["Codigo"])
            ->setTotalImpuestos($impuestoTotal)
            ->setMtoValorVenta($importeBrutoTotal)
            ->setMtoValorUnitario(round($precioBruto, 2, PHP_ROUND_HALF_UP))
            ->setMtoPrecioUnitario($importeNeto);
        array_push($detail, $item1);
    }

    $legend = new Legend();
    $legend->setCode('1000')
        ->setValue($util->ConvertirNumerosLetras(round($detalleventa[0]['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), $venta->NombreMoneda));

    $invoice->setDetails($detail)
        ->setLegends([$legend]);

    // Envio a SUNAT.
    //FE_BETA
    //FE_PRODUCCION
    $point = SunatEndpoints::FE_BETA;
    $see = $util->getSee($point, $empresa->NumeroDocumento, $empresa->UsuarioSol, $empresa->ClaveSol);
    $res = $see->send($invoice);
    $util->writeXml($invoice, $see->getFactory()->getLastXml());
    $hash = $util->getHashCode($invoice);

    if ($res->isSuccess()) {
        $cdr = $res->getCdrResponse();
        $util->writeCdr($invoice, $res->getCdrZip());
        // $util->showResponse($invoice, $cdr);
        if ($cdr->isAccepted()) {
            VentasADO::CambiarEstadoSunatVenta($idventa, $cdr->getCode(), $cdr->getDescription(), $hash, $see->getFactory()->getLastXml());
            echo json_encode(array(
                "state" => $res->isSuccess(),
                "accept" => $cdr->isAccepted(),
                "id" => $cdr->getId(),
                "code" => $cdr->getCode(),
                "description" => $cdr->getDescription(),
                "dd" => $util
            ));
        } else {
            VentasADO::CambiarEstadoSunatVenta($idventa, $cdr->getCode(), $cdr->getDescription(), $hash, $see->getFactory()->getLastXml());
            echo json_encode(array(
                "state" => $res->isSuccess(),
                "accept" => $cdr->isAccepted(),
                "id" => $cdr->getId(),
                "code" => $cdr->getCode(),
                "description" => $cdr->getDescription()
            ));
        }
        exit();
    } else {

        if ($res->getError()->getCode() === "1033") {
            VentasADO::CambiarEstadoSunatVentaUnico($idventa, "0", $res->getError()->getMessage(), $hash);
            echo json_encode(array(
                "state" => false,
                "code" => $res->getError()->getCode(),
                "description" => $res->getError()->getMessage()
            ));
        } else {
            VentasADO::CambiarEstadoSunatVenta($idventa, $res->getError()->getCode(), $res->getError()->getMessage(), $hash, $see->getFactory()->getLastXml());
            echo json_encode(array(
                "state" => false,
                "code" => $res->getError()->getCode(),
                "description" => $res->getError()->getMessage()
            ));
        }
        exit();
    }
}
