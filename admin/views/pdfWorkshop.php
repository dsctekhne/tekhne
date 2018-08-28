<?php
  $id_workshop = $_POST['id_workshop'];
  $titleWorkshop = '';
  $day_schedule = 0;
  include '../../libs/fpdf/template.php';
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  include_once '../../models/Workshop.php';
  $database = new Database();
  $db = $database->connect();
  $workshop = new Workshop($db);
  $result = $workshop->getInfoWorkshop($id_workshop);
  $num = $result->rowCount();
  // PDF
  $pdf = new PDF('L','mm','letter');
	$pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFillColor(255,255,255);
  $pdf->SetFont('times','B',12);
  $pdf->Line(10,40,269,40);
  $pdf->Ln(6);
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $titleWorkshop = utf8_decode($title);
    $pdf->Cell(260,6,'Taller: '.(utf8_decode($title)),0,1,'C',1);
    $pdf->Cell(260,6,'Instructor: '.utf8_decode($name).' '.utf8_decode($paternal_surname).' '.utf8_decode($maternal_surname),0,1,'C',1);
  }
  $pdf->Cell(260,6,'Horario:',0,1,'L',1);
  $pdf->SetFont('times','',10);
  $pdf->Cell(15,6,'',0,0,'C',1);
  $pdf->Cell(50,6,'Fecha:',1,0,'C',1);
  $pdf->Cell(50,6,'Hora de inicio:',1,0,'C',1);
  $pdf->Cell(50,6,'Hora de termino:',1,0,'C',1);
  $pdf->Cell(80,6,'Salon:',1,0,'C',1);
  $pdf->Cell(15,6,'',0,1,'C',1);
  $result = $workshop->getSchedule($id_workshop);
  $num = $result->rowCount();
  $day_schedule = $num;
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $pdf->Cell(15,6,'',0,0,'C',1);
    $pdf->Cell(50,6,$day.'/'.$month.'/'.$year,1,0,'C',1);
    $pdf->Cell(50,6,$hour_start,1,0,'C',1);
    $pdf->Cell(50,6,$hour_end,1,0,'C',1);
    $pdf->Cell(80,6,$place,1,0,'C',1);
    $pdf->Cell(15,6,'',0,1,'C',1);
  }
  $pdf->Ln(2);
  $pdf->SetFont('times','B',12);
  $pdf->Cell(260,6,'Estudiantes registrados:',0,1,'L',1);
  $pdf->SetFont('times','',10);
  $pdf->Cell(10,6,'No',1,0,'C',1);
	$pdf->Cell(30,6,'No. Control',1,0,'C',1);
  $pdf->Cell(120,6,'Nombre',1,0,'C',1);
  $result = $workshop->getSchedule($id_workshop);
  $num = $result->rowCount();
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $pdf->Cell((100/$day_schedule),6,$day.'/'.$month.'/'.$year,1,0,'C',1);
  }
  $pdf->Ln(6);
	
  // Instantiate DB & connect
  $i = 0;
  $assistant = new Assistant($db);
  $result = $assistant->getAllWorkshopsAssistants($id_workshop);
  $num = $result->rowCount();
  if($num > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $pdf->Cell(10,6,++$i,1,0,'C');
      $pdf->Cell(30,6,utf8_decode($acontrol_number),1,0,'C');
      $pdf->Cell(120,6,utf8_decode($apaternal_surname).' '.utf8_decode($amaternal_surname).' '.utf8_decode($aname),1,0,'C');
      for ($i=0; $i < $day_schedule; $i++) { 
        $pdf->Cell((100/$day_schedule),6,'',1,0,'C');
      }
      $pdf->Ln(6);
    }
  } else {
    $pdf->Cell(10,6,$k,1,0,'C');
    $pdf->Cell(30,6,'',1,0,'C');
    $pdf->Cell(120,6,'',1,0,'C');
    for ($i=0; $i < $day_schedule; $i++) { 
      $pdf->Cell((100/$day_schedule),6,'',1,0,'C');
    }
    $pdf->Ln(6);
  }
  $pdf->Output('I','LISTA_'.$titleWorkshop.'.pdf');
?>