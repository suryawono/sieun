<?php

App::import('Vendor', 'PHPExcel');

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$workingSheet = $objPHPExcel->getActiveSheet();
PHPExcel_Shared_Font::setAutoSizeMethod(PHPExcel_Shared_Font::AUTOSIZE_METHOD_EXACT);

$titleStyle = [
    'alignment' => [
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ],
    "font" => [
        "size" => 16,
        "bold" => true,
    ],
    "borders" => [
        "bottom" => [
            "style" => PHPExcel_Style_Border::BORDER_DOUBLE
        ],
    ],
];
$tabletitleStyle = [
    'alignment' => [
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ],
    "font" => [
        "size" => 12,
        "bold" => true,
    ],
];
$nodataStyle = [
    'alignment' => [
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    ],
    "font" => [
        "color" => [
            "rgb" => "ff0000",
        ],
    ],
];
$exportTimeStyle = [
    'alignment' => [
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
    ],
    "font" => [
        "size" => 9,
    ],
];

$rowTitle = 1;
$startColumnTitleN = 1;
$endColumnTitleN = count($titleRow);


$startColumnTitle = excelCFN($startColumnTitleN);
$endColumnTitle = excelCFN($endColumnTitleN);

//setup title
$workingSheet
        ->mergeCells("$startColumnTitle$rowTitle:$endColumnTitle$rowTitle")
        ->setCellValue("$startColumnTitle$rowTitle", _APP_NAME)
        ->getStyle("$startColumnTitle$rowTitle:$endColumnTitle$rowTitle")->applyFromArray($titleStyle);

//setup export time
$workingSheet
        ->mergeCells(excelCFN($endColumnTitleN - 1) . ($rowTitle + 1) . ":" . excelCFN($endColumnTitleN) . ($rowTitle + 1))
        ->setCellValue(excelCFN($endColumnTitleN - 1) . ($rowTitle + 1), date("Y-m-d H:i:s"))
        ->getStyle(excelCFN($endColumnTitleN - 1) . ($rowTitle + 1) . ":" . excelCFN($endColumnTitleN) . ($rowTitle + 1))->applyFromArray($exportTimeStyle);

//setup table title
$workingSheet
        ->fromArray($titleRow, null, "A" . ($rowTitle + 3))
        ->getStyle(excelCFN($startColumnTitleN) . ($rowTitle + 3) . ":" . excelCFN($endColumnTitleN) . ($rowTitle + 3))->applyFromArray($tabletitleStyle);

if (!isset($excelData) || empty($excelData)) {
    $workingSheet
            ->mergeCells(excelCFN($startColumnTitleN) . ($rowTitle + 4) . ":" . excelCFN($endColumnTitleN) . ($rowTitle + 4))
            ->setCellValue(excelCFN($startColumnTitleN) . ($rowTitle + 4), "Tidak ada data")
            ->getStyle(excelCFN($startColumnTitleN) . ($rowTitle + 4))->applyFromArray($nodataStyle);
} else {
    $workingSheet->fromArray($excelData, null, "A" . ($rowTitle + 4));
}

header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=" . str_replace(' ', '_', strtolower($pageInfo["titlePage"])) . "_" . date('Ymd') . ".xls");
header("Content-Description: Generated Report");
header("Content-Transfer-Encoding: binary");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>