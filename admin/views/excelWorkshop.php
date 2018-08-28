<?php
  $id_workshop = $_POST['id_workshop'];
  $title_workshop = '';
  require '../../libs/phpSpreadsheet/vendor/autoload.php';
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xls;
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  include_once '../../models/Workshop.php';
  $spreadsheet = new Spreadsheet();
  $Excel_writer = new Xls($spreadsheet);
  $spreadsheet->setActiveSheetIndex(0);
  $activeSheet = $spreadsheet->getActiveSheet();
  $database = new Database();
  $db = $database->connect();
  $workshop = new Workshop($db);
  $result = $workshop->getInfoWorkshop($id_workshop);
  $num = $result->rowCount();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $title_workshop = $title;
  }
  // Excel header
  $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
  $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
  $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
  $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
  $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
  $activeSheet->setCellValue('A1' , 'No.')->getStyle('A1')->getFont()->setBold(true);
  $activeSheet->setCellValue('B1' , 'Numero de control')->getStyle('B1')->getFont()->setBold(true);
  $activeSheet->setCellValue('C1' , 'Nombre')->getStyle('C1')->getFont()->setBold(true);
  $activeSheet->setCellValue('D1' , 'Carrera')->getStyle('D1')->getFont()->setBold(true);
  $assistant = new Assistant($db);
  $result = $assistant->getAllWorkshopsAssistantsExcel($id_workshop);
  $num = $result->rowCount();
  $i = 0;
  $cell = 2;
  if($num > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $activeSheet->setCellValue('A'.($cell) , ++$i);
      $activeSheet->setCellValue('B'.($cell) , $acontrol_number);
      $activeSheet->setCellValue('C'.($cell) , $apaternal_surname.' '.$amaternal_surname.' '.$aname);
      $activeSheet->setCellValue('D'.($cell) , $csname);
      $cell++;
    }
  } else {

  }
  $activeSheet->setCellValue('E1' , 'Taller: '.$title_workshop)->getStyle('E1')->getFont()->setBold(true);
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="archivo.xls"'); /*-- $filename is  xsl filename ---*/
  header('Cache-Control: max-age=0');
  $Excel_writer->save('php://output');
?>