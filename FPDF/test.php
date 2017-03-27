
<?php

require('fpdf.php');
require('dbconn.php');
ini_set('max_execution_time', 0);
ini_set('memory_limit','10000M');
ini_set('max_input_time','300000');

class PDF extends FPDF
{

// Page header
    function form()
    {


        $this->SetFont('Arial','',9);
        $this->SetXY(10,42);
        $this->Cell(89,8,'                     AM                             PM              UNDERTIME',1);


        $this->SetFont('Arial','',7.5);
        $this->SetXY(10,50);
        $this->Cell(89,8,'  DAY     ARRIVAL | DEPARTURE   ARRIVAL | DEPARTURE   LATE | UT',1);

        $this->SetFont('Arial', '', 7.5);
        $this->SetXY(10,65);

        $w = array(10,15,15, 15, 15);
        for($i = 0; $i < 15; $i++)
        {

            $this->Cell($w[0],6,'L'.$i,'');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[2],6,$i.':22:22','',0,'R');
            $this->Cell($w[3],6,$i.':22:22','',0,'R');

            $this->Ln();
        }



        $this->SetFont('Arial','',9);
        $this->SetXY(120,42);
        $this->Cell(89,8,'                     AM                              PM              UNDERTIME',1);

        $this->SetFont('Arial','',7.5);
        $this->SetXY(120,50);
        $this->Cell(89,8,'  DAY     ARRIVAL | DEPARTURE   ARRIVAL | DEPARTURE   LATE | UT',1);


        $this->SetFont('Arial', '', 7.5);
        $this->SetXY(120,65);
        $w = array(10,15,15, 15, 15);

        for($i = 0; $i < 15; $i++)
        {
            if($i > 0){
                $this->Cell(110);
            }
            $this->Cell($w[0],6,'R'.$i,'');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[2],6,$i.':22:22','',0,'R');
            $this->Cell($w[3],6,$i.':22:22','',0,'R');

            $this->Ln();
        }
    }
// Page footer
    function Footer()
    {

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
$pdf->form();


$pdf->Output();

?>