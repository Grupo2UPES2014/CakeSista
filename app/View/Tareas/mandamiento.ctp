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

$tcpdf->Cell(20, 5, 'Información de Pago:', 0, 0, 'L');

echo $tcpdf->Output('MandamientoSiSTA.pdf', 'I');
