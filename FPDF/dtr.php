
<?php
require('fpdf.php');
ini_set('max_execution_time', 0);
ini_set('memory_limit','10000M');
ini_set('max_input_time','300000');

class PDF extends FPDF
{
// Page header
    function form($temp)
    {
        $this->SetFont('Arial','',8);
        $this->SetX(10);
        $this->Cell(40,10,'Civil Service Form No. 43',0);
        $this->SetX(60);
        $this->Cell(40,10,'Printed : '. date('Y'),0);

        $this->SetX(100);
        $this->Cell(40,10,'Civil Service Form No. 43',0);
        $this->SetX(170);
        $this->Cell(40,10,'Printed : '. date('Y'),0);

        $this->Ln(5);
        $this->SetX(35);
        $this->Cell(40,10,'DAILY TIME RECORD',0);

        $this->SetX(140);
        $this->Cell(40,10,'DAILY TIME RECORD',0);

        $this->Ln(5);
        $this->SetFont('Arial','',8);
        $this->SetX(10);
        $this->Cell(40,10,$temp,0);

        $this->Ln(500);
    }
// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);

        $this->SetFont('Arial','I',8);

        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function SetDtr()
    {
        $this->Cell(40,10,'Lourence Rex B. Traya',0);
        $this->Cell(100,10,'Age : 22',0,1);
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
for($i = 0; $i < 100; $i++)
{
    $pdf->form('Autopsy of Jane Doe');
}
$pdf->Output();
?>