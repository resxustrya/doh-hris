<?php

/**
 * Created by PhpStorm.
 * User: Lourence
 * Date: 3/9/2017
 * Time: 2:55 PM
 */
require('fpdf.php');
class PDF extends  FPDF
{
    function Header()
    {
        // Logo
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Title',1,0,'C');
        // Line break
        $this->Ln(20);
    }
}