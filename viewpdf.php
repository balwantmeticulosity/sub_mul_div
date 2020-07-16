<?php
session_start();
require_once('tcpdf/tcpdf.php');
require_once('tcpdf/tcpdf_parser.php');

$data = $_SESSION['data']['addents'];
$action = $_SESSION['data']['action'];

if(!empty($data)){

class MYPDF extends TCPDF {
    

   
    public function Header() {
        $this->SetY(10);
    
        // Set font
        $this->title = $_SESSION['data']['title'];
        $this->SetFont('robotolight', '', 10);
        // Title
        $this->Cell(0, 10, $this->title , 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->Ln(6);
        $this->Cell(0, 10, 'Name : ________________________________' , 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->Ln(6);
        $this->Cell(0, 10, 'Date : ________________________________' , 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->Ln(8);
       $this->writeHTML('<hr>', true, false, false, false, '');
    }

  
    public function Footer() {
        $this->credit = $_SESSION['data']['fcredit'];
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('robotolight', '', 10);
        // Page number
        $this->Cell(0, 10, $this->credit, 1, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('');
$pdf->SetAuthor('');
$pdf->SetTitle('Addition');
$pdf->SetSubject('Addition');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title , PDF_HEADER_STRING);

// remove default header/footer
//$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

$pdf->SetFont('helvetica', '', 15);
// add a page
$pdf->AddPage();
//$pdf->Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);
//$pdf->Cell(0, 0, $title, 0, 1, 'C', 0, '', 0);
$pdf->Ln(20);

$pdf->SetFont('robotolight', '', 15);

// -----------------------------------------------------------------------------

$table = '<table border="0" cellpadding="0" cellspacing="0" align="center">';
$i = 1;
foreach($data as $element){
    if($action == 'add'){
        if($i==1){ $table .= '<tr>'; }
        $table .= '<td border="0" height="170">'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$element[0].'<br> + '.$element[1].'<br>-----</td>';
        if(($i % 4 == 0) && $i < 16){ $table .= '</tr><tr nobr="true">'; }
        
        if($i==16){ $table .= '</tr>'; break;}
    }
    
    if($action == 'mul'){
        if($i==1){ $table .= '<tr>'; }
        $table .= '<td border="0" height="170">'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$element[0].'<br> x '.$element[1].'<br>-----</td>';
        if(($i % 4 == 0) && $i < 16){ $table .= '</tr><tr nobr="true">'; }
        
        if($i==16){ $table .= '</tr>'; break;}
    }
    if($action == 'sub'){
        $fele = $element[0];
        $sele = $element[1];
        if($element[1]>$element[0]){
            $fele = $element[1];
            $sele = $element[0];
        }
        if($i==1){ $table .= '<tr>'; }
        $table .= '<td border="0" height="170">'.'&nbsp;&nbsp;&nbsp;&nbsp;'.$fele.'<br> - '.$sele.'<br>-----</td>';
        if(($i % 4 == 0) && $i < 16){ $table .= '</tr><tr nobr="true">'; }
        
        if($i==16){ $table .= '</tr>'; break;}
    }
    if($action == 'div'){
        $fele = $element[0];
        $sele = $element[1] * $fele;
        
        if($i==1){ $table .= '<tr>'; }
        $table .= '<td border="0" height="170">'.'&nbsp;&nbsp;'.$sele.' ÷ '.$fele.' = </td>';
        if(($i % 4 == 0) && $i < 16){ $table .= '</tr><tr nobr="true">'; }
        
        if($i==16){ $table .= '</tr>'; break;}
    }
    $i++;
}
$table .= '</table>';
$tbl = <<<EOD
$table 
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->Output('addition.pdf', 'I');

}
