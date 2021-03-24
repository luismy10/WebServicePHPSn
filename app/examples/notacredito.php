<?php

set_time_limit(300);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');


use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Note;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use Greenter\Ws\Services\SunatEndpoints;

require __DIR__ . './../vendor/autoload.php';
include_once __DIR__ . './../model/VentasADO.php';

$util = Util::getInstance();

$idNotaCredito = $_GET["idNotaCredito"];
$result = VentasADO::ObtenerNotaCreditoById($idNotaCredito);
if (!is_array($result)) {
    echo json_encode(array(
        "state" => false,
        "code" => "-1",
        "description" => $result
    ));
} else {

    $notacredito = $result[0];
    $empresa = $result[1];
    $detalle = $result[2];
    $totales = $result[3];

    date_default_timezone_set('America/Lima');
    $currentDate = date('Y-m-d');

    // Cliente
    $client = new Client();
    $client->setTipoDoc($notacredito->CodigoCliente)
        ->setNumDoc($notacredito->NumeroDocumento)
        ->setRznSocial($notacredito->Informacion)
        ->setAddress((new Address())
            ->setDireccion($notacredito->Direccion));

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

    $note = new Note();
    $note
        ->setUblVersion('2.1')
        ->setTipoDoc($notacredito->TipoDocumentoNotaCredito) // Tipo Doc: Nota de Credito
        ->setSerie($notacredito->SerieNotaCredito) // Serie NCR
        ->setCorrelativo($notacredito->NumeracionNotaCredito) // Correlativo NCR
        ->setFechaEmision(new DateTime($notacredito->FechaNotaCredito . "T" . $notacredito->HoraNotaCredito))
        ->setTipDocAfectado($notacredito->CodigoAlterno) // Tipo Doc: Boleta
        ->setNumDocfectado($notacredito->Serie . '-' . $notacredito->Numeracion) // Boleta: Serie-Correlativo
        ->setCodMotivo($notacredito->CodigoAnulacion) // Catalogo. 09
        ->setDesMotivo($notacredito->MotivoAnulacion)
        ->setTipoMoneda($notacredito->Moneda)
        ->setCompany($company)
        ->setClient($client)
        ->setMtoOperGravadas($totales['totalsinimpuesto']) //200 sin igv
        ->setMtoIGV($totales['totalimpuesto']) //36 igv generado
        ->setTotalImpuestos($totales['totalimpuesto']) //36 suma total
        ->setMtoImpVenta($totales['totalconimpuesto']) //236 con igv
    ;

    $detail = [];

    foreach ($detalle as $value) {
        $cantidad = $value['Cantidad'];
        $impuesto = $value['ValorImpuesto'];
        $precioVenta = $value['Precio'];

        $precioBruto = $precioVenta / (($impuesto / 100.00) + 1);
        $impuestoGenerado = $precioBruto * ($impuesto / 100.00);
        $impuestoTotal = $impuestoGenerado * $cantidad;
        $importeBrutoTotal = $precioBruto * $cantidad;
        $importeNeto = $precioBruto + $impuestoGenerado;
        $importeNetoTotal = $importeBrutoTotal + $impuestoTotal;


        $item = new SaleDetail();
        $item
            ->setCodProducto($value["ClaveSat"])
            ->setUnidad($value["CodigoUnidad"])
            ->setCantidad(round($cantidad, 2, PHP_ROUND_HALF_UP))
            ->setDescripcion($value["NombreMarca"])
            ->setMtoBaseIgv($importeBrutoTotal)
            ->setPorcentajeIgv(round($impuesto, 0, PHP_ROUND_HALF_UP))
            ->setIgv($impuestoTotal)
            ->setTipAfeIgv($value["Codigo"])
            ->setTotalImpuestos($impuestoTotal)
            ->setMtoValorVenta($importeBrutoTotal)
            ->setMtoValorUnitario(round($precioBruto, 2, PHP_ROUND_HALF_UP))
            ->setMtoPrecioUnitario($importeNeto);
        array_push($detail, $item);
    }

    $legend = new Legend();
    $legend->setCode('1000')
        ->setValue($util->ConvertirNumerosLetras(round($totales['totalconimpuesto'], 2, PHP_ROUND_HALF_UP), "SOLES"));

    $note->setDetails($detail)
        ->setLegends([$legend]);


    //Envio a SUNAT.
    //FE_BETA
    //FE_PRODUCCION
    $point = SunatEndpoints::FE_BETA;
    $see = $util->getSee($point, $empresa->NumeroDocumento, $empresa->UsuarioSol, $empresa->ClaveSol);
    $res = $see->send($note);
    $util->writeXml($note, $see->getFactory()->getLastXml());
    $hash = $util->getHashCode($note);

    if ($res->isSuccess()) {
        $cdr = $res->getCdrResponse();
        $util->writeCdr($note, $res->getCdrZip());
        if ($cdr->isAccepted()) {
            VentasADO::CambiarEstadoSunatNotaCredito($idNotaCredito, $cdr->getCode(), $cdr->getDescription(), $hash, $see->getFactory()->getLastXml());
            echo json_encode(array(
                "state" => $res->isSuccess(),
                "accept" => $cdr->isAccepted(),
                "id" => $cdr->getId(),
                "code" => $cdr->getCode(),
                "description" => $cdr->getDescription()
            ));
        } else {
            VentasADO::CambiarEstadoSunatNotaCredito($idNotaCredito, $cdr->getCode(), $cdr->getDescription(), $hash, $see->getFactory()->getLastXml());
            echo json_encode(array(
                "state" => $res->isSuccess(),
                "accept" => $cdr->isAccepted(),
                "id" => $cdr->getId(),
                "code" => $cdr->getCode(),
                "description" => $cdr->getDescription(),
                "hashcode" => $pdf
            ));
        }
    } else {
        if ($res->getError()->getCode() === "1033") {
            VentasADO::CambiarEstadoSunatNotaCreditoUnico($idNotaCredito, "0", $res->getError()->getMessage(), $hash);
            echo json_encode(array(
                "state" => false,
                "code" => $res->getError()->getCode(),
                "description" => $res->getError()->getMessage()
            ));
        } else {
            VentasADO::CambiarEstadoSunatNotaCredito($idNotaCredito, $res->getError()->getCode(), $res->getError()->getMessage(), $hash, $see->getFactory()->getLastXml());
            echo json_encode(array(
                "state" => false,
                "code" => $res->getError()->getCode(),
                "description" => $res->getError()->getMessage()
            ));
        }
    }
}
