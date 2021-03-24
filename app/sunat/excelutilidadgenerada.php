<?php

set_time_limit(300); //evita el error 20 segundos de peticion
session_start();

require __DIR__ . "/lib/phpspreadsheet/vendor/autoload.php";
include __DIR__ . "./../model/VentasADO.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;


$result = VentasADO::ResumenProductoVendidos($_GET["fechaInicio"], $_GET["fechaFinal"], intval($_GET["marca"]), intval($_GET["categoria"]));
if (!is_array($result)) {
    echo $ajuste;
    exit;
}

$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator("Creado por SysSoftIntegra")
    ->setTitle('Reporte de Utilidad')
    ->setSubject('Reporte')
    ->setDescription('Reporte de Utilidad del ' . $_GET["fechaInicio"] . ' al ' . $_GET["fechaFinal"])
    ->setKeywords('Reporte de Utilidad')
    ->setCategory('Utilidades');

$documento->getActiveSheet()->setTitle("Reporte de Utilidad");

$documento->getActiveSheet()->getStyle('A1:H1')->applyFromArray(array(
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

$documento->setActiveSheetIndex(0)->mergeCells('A1:H1');
$documento->setActiveSheetIndex(0)
    ->setCellValue("A1", "REPORTE DE UTILIDAD DEL " . date("d/m/Y", strtotime($_GET["fechaInicio"])) . " AL " . date("d/m/Y", strtotime($_GET["fechaFinal"])));


$documento->getActiveSheet()->getStyle('J3:K3')->applyFromArray(array(
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

$documento->setActiveSheetIndex(0)->mergeCells('J3:K3');
$documento->setActiveSheetIndex(0)
    ->setCellValue("J3", "RESUMEN GENERAL");


$documento->setActiveSheetIndex(0)
    ->setCellValue("A3", "N°")
    ->setCellValue("B3", "CLAVE")
    ->setCellValue("C3", "PRODUCTO")
    ->setCellValue("D3", "CANTIDAD")
    ->setCellValue("E3", "MEDIDA")
    ->setCellValue("F3", "COSTO TOTAL")
    ->setCellValue("G3", "PRECIO TOTAL")
    ->setCellValue("H3", "UTILIDAD GENERADA");

$costoTotal = 0;
$precioTotal = 0;
$cel = 4;
foreach ($result as $key => $value) {

    $documento->getActiveSheet()->getStyle('A' . $cel . ':H' . $cel . '')->applyFromArray(array(
        'font'  => array(
            'bold'  =>  false,
            'color' => array('rgb' => '000000')
        ),
        'alignment' => array(
            'horizontal' => Alignment::HORIZONTAL_LEFT
        )
    ));

    $documento->getActiveSheet()->getStyle("D" . $cel)->getNumberFormat()->setFormatCode('0.00');
    $documento->getActiveSheet()->getStyle("F" . $cel)->getNumberFormat()->setFormatCode('0.00');
    $documento->getActiveSheet()->getStyle("G" . $cel)->getNumberFormat()->setFormatCode('0.00');
    $documento->getActiveSheet()->getStyle("H" . $cel)->getNumberFormat()->setFormatCode('0.00');

    $documento->setActiveSheetIndex(0)
        ->setCellValue("A" . $cel,  strval($value["Id"]))
        ->setCellValue("B" . $cel, strval($value["Clave"]))
        ->setCellValue("C" . $cel, strval($value["NombreMarca"]))
        ->setCellValue("D" . $cel, strval(round($value["Cantidad"], 2, PHP_ROUND_HALF_UP)))
        ->setCellValue("E" . $cel, strval($value["Medida"]))
        ->setCellValue("F" . $cel, strval(round($value["CostoTotal"], 2, PHP_ROUND_HALF_UP)))
        ->setCellValue("G" . $cel, strval(round($value["PrecioTotal"], 2, PHP_ROUND_HALF_UP)))
        ->setCellValue("H" . $cel, strval(round($value["Utilidad"], 2, PHP_ROUND_HALF_UP)));
    $costoTotal += $value["CostoTotal"];
    $precioTotal += $value["PrecioTotal"];
    $cel++;
}

//Ancho de las columnas
$documento->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$documento->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$documento->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$documento->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$documento->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$documento->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$documento->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$documento->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$documento->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$documento->getActiveSheet()->getColumnDimension('K')->setWidth(20);

$documento->setActiveSheetIndex(0)
    ->setCellValue("J4", "COSTO TOTAL");

$documento->setActiveSheetIndex(0)
    ->setCellValue("J5", "PRECIO TOTAL");

$documento->setActiveSheetIndex(0)
    ->setCellValue("J6", "UTILIDAD GENERADA");


$documento->getActiveSheet()->getStyle("K4")->getNumberFormat()->setFormatCode('0.00');
$documento->setActiveSheetIndex(0)
    ->setCellValue("K4", strval(round($costoTotal, 2, PHP_ROUND_HALF_UP)));


$documento->getActiveSheet()->getStyle("K5")->getNumberFormat()->setFormatCode('0.00');
$documento->setActiveSheetIndex(0)
    ->setCellValue("K5", strval(round($precioTotal, 2, PHP_ROUND_HALF_UP)));


$documento->getActiveSheet()->getStyle("K6")->getNumberFormat()->setFormatCode('0.00');
$documento->setActiveSheetIndex(0)
    ->setCellValue("K6", strval(round($precioTotal - $costoTotal, 2, PHP_ROUND_HALF_UP)));



$nombreDelDocumento =  "Utilidad Generada del " . $_GET["fechaInicio"] . " al " . $_GET["fechaFinal"] . ".xlsx";
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
