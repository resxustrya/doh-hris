
<?php
require('dbconn.php');
require('fpdf.php');
ini_set('max_execution_time', 0);
ini_set('memory_limit','1000M');
ini_set('max_input_time','300000');

class PDF extends FPDF
{

// Page header
    function form($name,$userid,$date_from,$date_to)
    {

        $day1 = explode('-',$date_from);
        $day2 = explode('-',$date_to);

        $startday = floor($day1[2]);
        $endday = $day2[2];


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
        $this->SetXY(10,42);
        $this->Cell(89,8,'                     AM                             PM              UNDERTIME',1);


        $this->SetFont('Arial','',7.5);
        $this->SetXY(10,50);
        $this->Cell(89,8,'  DAY     ARRIVAL | DEPARTURE   ARRIVAL | DEPARTURE   LATE | UT',1);

        $this->SetFont('Arial', '', 7.5);
        $this->SetXY(10,65);

        $w = array(10,15,15,15,15);
        $index = 0;
        $log_date = "";
        $log = "";
        $logs = get_logs($userid,$date_from,$date_to);
        if(isset($logs) and count($logs))
        {
            for($r1 = $startday; $r1 <= $endday; $r1++)
            {
                $r1 >= 1 && $r1 < 10 ? $zero='0' : $zero = '';
                $datein = $day1[0]."-".$day1[1]."-".$zero.$r1;

                if($index != count($logs)) {
                    if($datein == $logs[$index]['datein']){
                        $log_date = $logs[$index]['datein'];
                        $log = $logs[$index];
                        $index = $index + 1;
                    }
                }
                $day_name = date('D', strtotime($datein));

                if($datein == $log_date)
                {
                    $am_in = $log['am_in'];
                    $am_out = $log['am_out'];
                    $pm_in = $log['pm_in'];
                    $pm_out = $log['pm_out'];

                   // $late = personal::late($am_in, $pm_in);
                   // $ut = personal::undertime($am_out,$pm_out);
                } else {
                    $am_in = '';
                    $am_out = '';
                    $pm_in = '';
                    $pm_out = '';
                    $late = '';
                    //$ut = personal::undertime($am_out,$pm_out);
                }


                $this->Cell(5,6,$r1,'');
                $this->Cell(7,6,$day_name,'');
                $this->Cell($w[1],6,$am_in,'');
                $this->Cell($w[1],6,$am_out,'');
                $this->Cell($w[2],6,$pm_in,'',0,'R');
                $this->Cell($w[3],6,$pm_out,'',0,'R');

                $this->Cell(37);
                $this->Cell(5,6,$r1,'');
                $this->Cell(7,6,$day_name,'');
                $this->Cell($w[1],6,$am_in,'');
                $this->Cell($w[1],6,$am_out,'');
                $this->Cell($w[2],6,$pm_in,'',0,'R');
                $this->Cell($w[3],6,$pm_out,'',0,'R');

                $this->Ln();
            }
        }

        $this->SetFont('Arial','',9);
        $this->SetXY(120,42);
        $this->Cell(89,8,'                     AM                              PM              UNDERTIME',1);

        $this->SetFont('Arial','',7.5);
        $this->SetXY(120,50);
        $this->Cell(89,8,'  DAY     ARRIVAL | DEPARTURE   ARRIVAL | DEPARTURE   LATE | UT',1);



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
if(isset($_POST['from']) and isset($_POST['to'])) {
    $date_from = $_POST['from'];
    $date_to = $_POST['to'];

    $_from = explode('/',$date_from);
    $_to = explode('/', $date_to);
    $date_from = $_from[2].'-'.$_from[0].'-'.$_from[1];
    $date_to = $_to[2].'-'.$_to[0].'-'.$_to[1];

}


$row = userlist();

if(isset($row) and count($row) > 0)
{
    for($i = 0; $i < count($row); $i++)
    {
        $pdf->form($row[$i]['fname'].' '.$row[$i]['lname'].' '.$row[$i]['mname'],$row[$i]['userid'],$date_from,$date_to);
    }
}
$pdf->Output();


?>