<?php

App::import('Vendor', 'PHPExcel');

$objPHPExcel = new PHPExcel();

if (!isset($excelData)) {
    $excelData = [];
}

$objPHPExcel->getActiveSheet()->fromArray($excelData, null, 'A1');
$objPHPExcel->setActiveSheetIndex(0);

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=" . $printfile . "_" . date('dmY') . ".xls");
header("Content-Description: Generated Report");
header("Content-Transfer-Encoding: binary");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>