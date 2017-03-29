
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




        $this->SetFont('Arial','',9);
        $this->SetXY(120,42);
        $this->Cell(89,8,'                     AM                              PM              UNDERTIME',1);

        $this->SetFont('Arial','',7.5);
        $this->SetXY(120,50);
        $this->Cell(89,8,'  DAY     ARRIVAL | DEPARTURE   ARRIVAL | DEPARTURE   LATE | UT',1);


        $this->SetFont('Arial', '', 7.5);
        $this->SetXY(120,65);
        $w = array(10,15,15, 15, 15);

        for($i = 1; $i <= 15; $i++)
        {

            $this->Cell($w[0],6,'R'.$i,'');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[2],6,$i.':22:22','',0,'R');
            $this->Cell($w[3],6,$i.':22:22','',0,'R');


            $this->Cell(30);
            $this->Cell($w[0],6,'R'.$i,'');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[1],6,$i.':22:22','');
            $this->Cell($w[2],6,$i.':22:22','',0,'R');
            $this->Cell($w[3],6,$i.':22:22','',0,'R');
            $this->Ln();

            if($i == 15)
            {
                $this->SetFont('Arial','BU',8);
                $this->SetX(50);
                $this->Cell(5,0,'                                                                                                             ',0,0,'C');

                $this->SetX(160);
                $this->Cell(5,0,'                                                                                                             ',0,0,'C');
                $this->Ln();

                $this->SetFont('Arial','',9);
                $this->Cell(10,7,'TOTAL',0,0,'C');

                $this->SetX(120);
                $this->Cell(10,7,'TOTAL',0,0,'C');
                $this->Ln();

                $this->SetFont('Arial','',7);
                $this->MultiCell(80,2, '        I CERTIFY on my honor that above entry is true and correct report of the hours work performed, record of which was made daily at the time of arrival and departure from the office.');
                $this->MultiCell(80,2, '        I CERTIFY on my honor that above entry is true and correct report of the hours work performed, record of which was made daily at the time of arrival and departure from the office.');
                $this->Ln();

                $this->SetFont('Arial','BU',8);
                $this->SetX(50);
                $this->Cell(5,10,'                                     LOURENCE                                                     ',0,0,'C');
                $this->Ln();

                $this->SetFont('Arial','',8);
                $this->SetX(50);
                $this->Cell(10,0,'Verified as to the prescribed office hours',0,0,'C');
                $this->Ln();

                $this->SetFont('Arial','BU',8);
                $this->SetX(50);
                $this->Cell(5,10,'                                                                                                             ',0,0,'C');
                $this->Ln();

                $this->SetFont('Arial','',8);
                $this->SetX(40);
                $this->Cell(10,0,'IN-CHARGE',0,0,'C');
            }



        }
    }
// Page footer

}


$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$date_from = '';
$date_to = '';

$pdf->form();


$pdf->Output();

?>