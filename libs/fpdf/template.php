<?php
	include '../../libs/fpdf/fpdf.php';
	class PDF extends FPDF
	{
		function Header()
		{
      $this->Image('../../images/header_pdf.png', 30, 5, 220 );
      $this->Cell(220);
			$this->SetFont('Arial','B',15);
			$this->Ln(25);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>