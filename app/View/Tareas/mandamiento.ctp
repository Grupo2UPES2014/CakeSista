<?php

App::import('Vendor', 'xtcpdf');
date_default_timezone_set('America/El_Salvador');

$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'
$tcpdf->SetTitle('Mandamiento de Pago');
$tcpdf->SetAuthor("SiSTA - Universidad Politecnica de El Salvador");
$tcpdf->SetAutoPageBreak(false);
$tcpdf->xheadertext = '';
$tcpdf->xfootertext = '';
// add a page (required with recent versions of tcpdf)
$tcpdf->AddPage();

// Now you position and print your page content
// example: 

$tcpdf->setJPEGQuality(100);
$tcpdf->Image('img/pdf/fondo_mandamiento.png', 0, 0, 210, 90);
$tcpdf->SetTextColor(0, 0, 0);

$tcpdf->Ln(10);
$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(48);

$tcpdf->Cell(20, 5, date('d/m/Y'), 0, 3, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(10);

$tcpdf->Cell(5, 5, 'Carnet:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(22);

$tcpdf->Cell(20, 5, 'TT200601', 0, 0, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(39);

$tcpdf->Cell(20, 5, 'NUI:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(46);

$tcpdf->Cell(20, 5, '18036', 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(10);

$tcpdf->Cell(20, 5, 'Nombre:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(24);

$tcpdf->Cell(20, 5, 'CARLOS AMAURY', 0, 1, 'L');

$tcpdf->SetX(24);

$tcpdf->Cell(20, 5, 'TEJADA RAPHSON', 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(10);

$tcpdf->Cell(20, 5, 'Carrera:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);

$tcpdf->MultiCell(55, 5, 'INGENIERIA EN CIENCIAS DE LA COMPUTACIÓN', 0, 'L', 0, 1, 24, $tcpdf->GetY() + 0.5, true);

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(10);

$tcpdf->Cell(20, 5, 'Información de Pago:', 0, 1, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(15);

$tcpdf->MultiCell(60, 5, 'REPOSICIÓN DE CARTA DE EGRESADO', 0, 'L', 0, 1, '', '', true);

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->Ln(3);
$tcpdf->SetX(25);


$tcpdf->Cell(20, 5, 'Total a Pagar:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(60);

$tcpdf->Cell(20, 5, '$350.00', 0, 0, 'L');
//--------------------------------------------- OTRA MITAD
$tcpdf->SetXY(85, 20);

$tcpdf->Cell(20, 5, date('d/m/Y'), 0, 3, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(85);

$tcpdf->Cell(5, 5, 'Carnet:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(97);

$tcpdf->Cell(20, 5, 'TT200601', 0, 0, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(114);

$tcpdf->Cell(20, 5, 'NUI:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(121);

$tcpdf->Cell(20, 5, '18036', 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(85);

$tcpdf->Cell(20, 5, 'Nombre:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(99);

$tcpdf->Cell(20, 5, 'CARLOS AMAURY TEJADA RAPHSON', 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(85);

$tcpdf->Cell(20, 5, 'Carrera:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(99);

$tcpdf->Cell(20, 5, 'INGENIERIA EN CIENCIAS DE LA COMPUTACIÓN', 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(85);

$tcpdf->Cell(20, 5, 'Información de Pago:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(119);
$tcpdf->SetXY(119, $tcpdf->GetY() + 0.5);

$tcpdf->MultiCell(85, 5, 'REPOSICIÓN DE CARTA DE EGRESADO', 0, 'L', 0, 1, '', '', true);

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->Ln(7);
$tcpdf->SetX(170);


$tcpdf->Cell(20, 5, 'Total a Pagar:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(193);

$tcpdf->Cell(20, 5, '$350.00', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 7);
$tcpdf->SetXY(85, $tcpdf->GetY() - 2);
$tcpdf->Cell(20, 1, 'Después de la fecha de vencimiento su cuota tendrá un recargo de $7.00', 0, 1, 'L');

$tcpdf->SetX(85);
$tcpdf->Cell(20, 5, 'Vencimiento 08/09/20014', 0, 1, 'L');

$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => $textfont,
    'fontsize' => 8,
    'stretchtext' => 4
);
$tcpdf->Ln(2);
$tcpdf->SetX(110);
$tcpdf->SetFont($textfont, 'B', 8);
$tcpdf->Cell(0, 0, 'NPE 0597 0070 0020 1401 0400 0180 3604 7011 49', 0, 1);
$tcpdf->SetX(87);
$tcpdf->write1DBarcode('4157419700005971390200000070009620140104802000180360470114', 'C128', '', '', '', 18, 0.3, $style, 'N');

echo $tcpdf->Output('MandamientoSiSTA.pdf', 'I');
