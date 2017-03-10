
<?php

require('fpdf.php');
require('dbconn.php');
ini_set('max_execution_time', 0);
ini_set('memory_limit','10000M');
ini_set('max_input_time','300000');

class PDF extends FPDF
{

// Page header
    function form($name,$userid,$date_from,$date_to)
    {
        $this->SetFont('Arial','',8);
        $this->SetX(10);
        $this->Cell(40,10,'Civil Service Form No. 43',0);
        $this->SetX(60);
        $this->Cell(40,10,'Printed : '. date('Y-m-d'),0);

        $this->SetX(120);
        $this->Cell(40,10,'Civil Service Form No. 43',0);
        $this->SetX(-40);
        $this->Cell(40,10,'Printed : '.date('Y-m-d') ,0);

        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $this->SetXY(35,15);
        $this->Cell(40,10,'DAILY TIME RECORD',0);

        $this->SetFont('Arial','B',10);
        $this->SetXY(10,22);
        $this->Cell(40,10,'Name : '.$name,0);

        $this->SetFont('Arial','',10);
        $this->SetXY(10,28);
        $this->Cell(40,10,'For the month of',0);

        $this->SetFont('Arial','',10);
        $this->SetXY(60,28);
        $this->Cell(40,10,'ID No.  '.$userid,0);

        $this->SetFont('Arial','',10);
        $this->SetXY(10,33);
        $this->Cell(40,10,'Official hours for (days A.M. P.M. arrival and departure)',0);



        $this->SetFont('Arial','',10);
        $this->SetXY(145,15);
        $this->Cell(40,10,'DAILY TIME RECORD',0);

        $this->SetFont('Arial','B',10);
        $this->SetXY(120,22);
        $this->SetFillColor(200,220,255);
        $this->Cell(40,10,'Name : '.$name,0);

        $this->SetFont('Arial','',10);
        $this->SetXY(120,28);
        $this->Cell(40,10,'For the month of',0);

        $this->SetFont('Arial','',10);
        $this->SetXY(170,28);
        $this->Cell(40,10,'ID No.  '.$userid,0);

        $this->SetFont('Arial','',10);
        $this->SetXY(120,33);
        $this->Cell(40,10,'Official hours for (days A.M. P.M. arrival and departure)',0);

        $this->SetFont('Arial','',9);
        $this->SetXY(120,42);
        $this->Cell(89,10,'                     AM                              PM              UNDERTIME',1);

        $this->SetFont('Arial','',9);
        $this->SetXY(10,42);
        $this->Cell(89,10,'                     AM                              PM              UNDERTIME',1);

        $this->SetFont('Arial','',7.5);
        $this->SetXY(120,52);
        $this->Cell(89,10,'  DAY  ARRIVAL | DEPARTURE   ARRIVAL | DEPARTURE   LATE | UT',1);

        $this->SetFont('Arial','',7.5);
        $this->SetXY(10,52);
        $this->Cell(89,10,'  DAY  ARRIVAL | DEPARTURE   ARRIVAL | DEPARTURE   LATE | UT',1);

        $this->SetFont('Arial', '', 7.5);
        $this->SetXY(10,60);
        for($i = 0; $i < 15; $i++)
        {
            $this->Cell($i, 10, '  '.$i.'        8:05:12     12:17:27            12:17:34              20:56:17     0        0',0);
            $this->Ln();
        }


        $this->Ln(500);
    }
// Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}


$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$date_from = '';
$date_to = '';
if(isset($_GET['from']) and isset($_GET['to'])) {
    $date_from = $_GET['from'];
    $date_to = $_GET['to'];

    $_from = explode('/',$date_from);
    $_to = explode('/', $date_to);
    $date_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
    $date_to = $_to[2].'-'.$_to[0].'-'.$_to[1];

}
$row = userlist($date_from,$date_to);
if(isset($row) and count($row) > 0)
{
    for($i = 0; $i < 100; $i++)
    {
        $pdf->form($row[$i]['fname'].' '.$row[$i]['lname'].' '.$row[$i]['mname'],$row[$i]['userid'],$date_from,$date_to);
    }
}
$pdf->Output();

?>