<?php

App::import('Vendor', 'xtcpdf');
date_default_timezone_set('America/El_Salvador');

$tcpdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'
$tcpdf->SetCreator('SiSTA');
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

$tcpdf->Cell(20, 5, date('d/m/Y', strtotime($mandamiento['Mandamiento']['fechaemision'])), 0, 3, 'L'); //date('d/m/Y')

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(10);

$tcpdf->Cell(5, 5, 'Carnet:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(22);

$tcpdf->Cell(20, 5, $estudiante['Estudiante']['carnet'], 0, 0, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(39);

$tcpdf->Cell(20, 5, 'NUI:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(46);

$tcpdf->Cell(20, 5, $estudiante['Estudiante']['nui'], 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(10);

$tcpdf->Cell(20, 5, 'Nombre:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(24);

$tcpdf->Cell(20, 5, $estudiante['Estudiante']['nombres'], 0, 1, 'L');

$tcpdf->SetX(24);

$tcpdf->Cell(20, 5, $estudiante['Estudiante']['apellido1'] . ' ' . $estudiante['Estudiante']['apellido2'], 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(10);

$tcpdf->Cell(20, 5, 'Carrera:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);

$tcpdf->MultiCell(55, 5, mb_strtoupper($estudiante['Carrera']['nombre'], 'UTF-8'), 0, 'L', 0, 1, 24, $tcpdf->GetY() + 0.5, true);

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(10);

$tcpdf->Cell(20, 5, 'Información de Pago:', 0, 1, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(15);

$tcpdf->MultiCell(60, 5, mb_strtoupper($mandamiento['Mandamiento']['descripcion'], 'UTF-8'), 0, 'L', 0, 1, '', '', true);

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->Ln(3);
$tcpdf->SetX(25);


$tcpdf->Cell(20, 5, 'Total a Pagar:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(60);

$tcpdf->Cell(20, 5, $mandamiento['Mandamiento']['arancel'], 0, 0, 'L');
//--------------------------------------------- OTRA MITAD
$tcpdf->SetXY(85, 20);

$tcpdf->Cell(20, 5, date('d/m/Y', strtotime($mandamiento['Mandamiento']['fechaemision'])), 0, 3, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(85);

$tcpdf->Cell(5, 5, 'Carnet:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(97);

$tcpdf->Cell(20, 5, $estudiante['Estudiante']['carnet'], 0, 0, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(114);

$tcpdf->Cell(20, 5, 'NUI:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(121);

$tcpdf->Cell(20, 5, $estudiante['Estudiante']['nui'], 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(85);

$tcpdf->Cell(20, 5, 'Nombre:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(99);

$tcpdf->Cell(20, 5, $estudiante['Estudiante']['nombres'] . ' ' . $estudiante['Estudiante']['apellido1'] . ' ' . $estudiante['Estudiante']['apellido2'], 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(85);

$tcpdf->Cell(20, 5, 'Carrera:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(99);

$tcpdf->Cell(20, 5, mb_strtoupper($estudiante['Carrera']['nombre'], 'UTF-8'), 0, 1, 'L');

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->SetX(85);

$tcpdf->Cell(20, 5, 'Información de Pago:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(119);
$tcpdf->SetXY(119, $tcpdf->GetY() + 0.5);

$tcpdf->MultiCell(85, 5, mb_strtoupper($mandamiento['Mandamiento']['descripcion'], 'UTF-8'), 0, 'L', 0, 1, '', '', true);

$tcpdf->SetFont($textfont, 'B', 9);
$tcpdf->Ln(7);
$tcpdf->SetX(170);


$tcpdf->Cell(20, 5, 'Total a Pagar:', 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 9);
$tcpdf->SetX(193);

$tcpdf->Cell(20, 5, $mandamiento['Mandamiento']['arancel'], 0, 0, 'L');

$tcpdf->SetFont($textfont, '', 7);
$tcpdf->SetXY(85, $tcpdf->GetY() - 2);
$tcpdf->Cell(20, 1, 'Después de la fecha de vencimiento su cuota tendrá un recargo de 10%', 0, 1, 'L');

$tcpdf->SetX(85);
$tcpdf->Cell(20, 5, 'Vencimiento ' . $vencimiento->format('d/m/Y'), 0, 1, 'L');

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
$tcpdf->Cell(0, 0, 'NPE ' . $mandamiento['Mandamiento']['npe'], 0, 1);
$tcpdf->SetX(87);
$tcpdf->write1DBarcode($mandamiento['Mandamiento']['codigobarras'], 'C128', '', '', '', 18, 0.3, $style, 'N');

$tcpdf->Ln(10);
//var_dump($estudiante);
$tcpdf->Cell(0, 0, 'Avisos', 0, 1);
echo $tcpdf->Output('MandamientoSiSTA.pdf', 'I');
