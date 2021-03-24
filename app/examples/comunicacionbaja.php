<?php

set_time_limit(300);
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json; charset=UTF-8');

use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Voided\Voided;
use Greenter\Model\Voided\VoidedDetail;
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
    $correlativoActual = $detalleventa[4];
    $correlativo = ($correlativoActual === 0) ? (intval($venta->Correlativo) + 1) : ($correlativoActual + 1);

    date_default_timezone_set('America/Lima');
    $currentDate = date('Y-m-d');

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

    $detail1 = new VoidedDetail();
    $detail1->setTipoDoc($venta->TipoComprobante)
        ->setSerie($venta->Serie)
        ->setCorrelativo($venta->Numeracion)
        ->setDesMotivoBaja('ERROR EN EL SISTEMA');


    $voided = new Voided();
    $voided->setCorrelativo($correlativo)
        // Fecha Generacion menor que Fecha comunicacion
        ->setFecGeneracion(new DateTime($venta->FechaVenta . "T" . $venta->HoraVenta))
        ->setFecComunicacion(new DateTime($currentDate))
        ->setCompany($company)
        ->setDetails([$detail1]);

    // Envio a SUNAT.
    //FE_BETA
    //FE_PRODUCCION
    $point = SunatEndpoints::FE_BETA;
    $see = $util->getSee($point, $empresa->NumeroDocumento, $empresa->UsuarioSol, $empresa->ClaveSol);
    $res = $see->send($voided);
    $util->writeXml($voided, $see->getFactory()->getLastXml());
    $hash = $util->getHashCode($voided);

    if (!$res->isSuccess()) {
        VentasADO::CambiarEstadoSunatResumen($idventa, $res->getError()->getCode(), $res->getError()->getMessage(), $hash, $correlativo, $currentDate);
        echo json_encode(array(
            "state" => false,
            "code" => $res->getError()->getCode(),
            "description" => $res->getError()->getMessage()
        ));
    } else {
        $ticket = $res->getTicket();
        $res = $see->getStatus($ticket);
        if (!$res->isSuccess()) {
            VentasADO::CambiarEstadoSunatResumen($idventa, $res->getError()->getCode(),  $res->getError()->getMessage(), $hash, $correlativo, $currentDate);
            echo json_encode(array(
                "state" => false,
                "code" => $res->getError()->getCode(),
                "description" => $res->getError()->getMessage()
            ));
        } else {
            $cdr = $res->getCdrResponse();
            $util->writeCdr($voided, $res->getCdrZip());
            if (!$cdr->isAccepted()) {
                VentasADO::CambiarEstadoSunatResumen($idventa, $cdr->getCode(), $cdr->getDescription(), $hash, $correlativo, $currentDate);
                echo json_encode(array(
                    "state" => $res->isSuccess(),
                    "accept" => $cdr->isAccepted(),
                    "id" => $cdr->getId(),
                    "code" => $cdr->getCode(),
                    "description" => $cdr->getDescription()
                ));
            } else {
                VentasADO::CambiarEstadoSunatResumen($idventa, $cdr->getCode(), $cdr->getDescription(), $hash, $correlativo, $currentDate);
                echo json_encode(array(
                    "state" => $res->isSuccess(),
                    "accept" => $cdr->isAccepted(),
                    "id" => $cdr->getId(),
                    "code" => $cdr->getCode(),
                    "description" => $cdr->getDescription()
                ));
            }
        }
    }
}
