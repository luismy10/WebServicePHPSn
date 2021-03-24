<?php

set_time_limit(300); //evita el error 20 segundos de peticion
session_start();

require __DIR__ . "/lib/phpspreadsheet/vendor/autoload.php";
include __DIR__ . "./../model/MovimientoADO.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;


$result = MovimientoADO::ObtenerMovimientoInventarioById($_GET["idMovimiento"]);
if (!is_array($result)) {
    echo $ajuste;
    exit;
}

date_default_timezone_set('America/Lima');

$ajuste = $result[0];
$ajustedetalle = $result[1];

$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator("Creado por SysSoftIntegra")
    ->setTitle('Reporte general')
    ->setSubject('Reporte')
    ->setDescription('Ajuste de Inventario del ' . $ajuste->Fecha . '' . $ajuste->Hora)
    ->setKeywords('Ajuste de Inventario')
    ->setCategory('Ajuste');

$documento->getActiveSheet()->setTitle("Ajuste de inventario");

$documento->getActiveSheet()->getStyle('A1:E1')->applyFromArray(array(
    'borders' => array(
        'outline' => array(
            'borderStyle' => Border::BORDER_THIN,
            'color' => array('argb' => '000000'),
        ),
    ),
    'fill' => array(
        'fillType' => Fill::FILL_SOLID,
        'startColor' => array('argb' => '006ac1')
    ),
    'font'  => array(
        'bold'  =>  true,
        'color' => array('argb' => 'ffffff'),
        'size' => 13
    ),
    'alignment' => array(
        'horizontal' => Alignment::HORIZONTAL_CENTER
    )
));

$documento->setActiveSheetIndex(0)->mergeCells('A1:E1');
$documento->setActiveSheetIndex(0)
    ->setCellValue("A1", "AJUSTE DE INVENTARIO DEL " . date("d/m/Y", strtotime($ajuste->Fecha)));


$documento->getActiveSheet()->getStyle('A2:E2')->applyFromArray(array(
    'borders' => array(
        'outline' => array(
            'borderStyle' => Border::BORDER_THIN,
            'color' => array('argb' => '000000'),
        ),
    ),
    'fill' => array(
        'fillType' => Fill::FILL_SOLID,
        'startColor' => array('argb' => 'cecece')
    ),
    'font'  => array(
        'bold'  =>  true,
        'color' => array('argb' => '000000'),
        'size' => 11
    ),
    'alignment' => array(
        'horizontal' => Alignment::HORIZONTAL_LEFT
    )
));

$documento->setActiveSheetIndex(0)->mergeCells('A2:C2');
$documento->setActiveSheetIndex(0)
    ->setCellValue("A2", "TIPO DE AJUSTE: " . $ajuste->TipoMovimiento);

$documento->setActiveSheetIndex(0)->mergeCells('D2:E2');
$documento->setActiveSheetIndex(0)
    ->setCellValue("D2", "ESTADO: " . $ajuste->Estado);


$documento->getActiveSheet()->getStyle('G2:I2')->applyFromArray(array(
    'borders' => array(
        'outline' => array(
            'borderStyle' => Border::BORDER_THIN,
            'color' => array('argb' => '000000'),
        ),
    ),
    'fill' => array(
        'fillType' => Fill::FILL_SOLID,
        'startColor' => array('argb' => 'cecece')
    ),
    'font'  => array(
        'bold'  =>  true,
        'color' => array('argb' => '000000'),
        'size' => 11
    ),
    'alignment' => array(
        'horizontal' => Alignment::HORIZONTAL_CENTER
    )
));

$documento->setActiveSheetIndex(0)->mergeCells('G2:I2');
$documento->setActiveSheetIndex(0)
    ->setCellValue("G2", "VALOR DE INVENTARIO");


$documento->setActiveSheetIndex(0)
    ->setCellValue("A3", "N°")
    ->setCellValue("B3", "CLAVE")
    ->setCellValue("C3", "PRODUCTO")
    ->setCellValue("D3", "CANTIDAD")
    ->setCellValue("E3", "COSTO");

$costo = 0;
$cel = 4;
foreach ($ajustedetalle as $key => $value) {

    $documento->getActiveSheet()->getStyle('A' . $cel . ':E' . $cel . '')->applyFromArray(array(
        'font'  => array(
            'bold'  =>  false,
            'color' => array('rgb' => '000000')
        ),
        'alignment' => array(
            'horizontal' => Alignment::HORIZONTAL_LEFT
        )
    ));

    $documento->getActiveSheet()->getStyle("D" . $cel)->getNumberFormat()->setFormatCode('0.00');
    $documento->getActiveSheet()->getStyle("E" . $cel)->getNumberFormat()->setFormatCode('0.00');

    $documento->setActiveSheetIndex(0)
        ->setCellValue("A" . $cel,  strval($value["Id"]))
        ->setCellValue("B" . $cel, strval($value["Clave"]))
        ->setCellValue("C" . $cel, strval($value["NombreMarca"]))
        ->setCellValue("D" . $cel, strval(round($value["Cantidad"], 2, PHP_ROUND_HALF_UP)))
        ->setCellValue("E" . $cel, strval(round($value["Costo"], 2, PHP_ROUND_HALF_UP)));
    $costo += ($value["Cantidad"] * $value["Costo"]);
    $cel++;
}

//Ancho de las columnas
$documento->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$documento->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$documento->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$documento->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$documento->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$documento->getActiveSheet()->getColumnDimension('I')->setWidth(20);

$documento->setActiveSheetIndex(0)->mergeCells('G3:H3');
$documento->setActiveSheetIndex(0)
    ->setCellValue("G3", "VALOR TOTAL");


$documento->getActiveSheet()->getStyle("I3")->getNumberFormat()->setFormatCode('0.00');
$documento->setActiveSheetIndex(0)
    ->setCellValue("I3", strval(round($costo, 2, PHP_ROUND_HALF_UP)));



$nombreDelDocumento =  "Ajuste de inventario.xlsx";
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $nombreDelDocumento);
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

ob_end_clean();
$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;
