<?php

APP::import('Vendor', 'tcpdf/tcpdf');
/*
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */

/**
 * Description of xtcpdf
 *
 * @author Amaury
 */
class XTCPDF extends TCPDF{

    var $xheadertext = 'PDF creado using CakePHP y TCPDF';
    var $xheadercolor = array(0, 0, 200);
    var $xfootertext = 'Copyright © %d XXXXXXXXXXX. All rights reserved.';
    var $xfooterfont = PDF_FONT_NAME_MAIN;
    var $xfooterfontsize = 8;

    function Header() {

    }

    function Footer() {

    }

}
