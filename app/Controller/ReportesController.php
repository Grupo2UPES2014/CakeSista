<?php

App::uses('AppController', 'Controller');
/*
 * Copyright 2014 UPES Grupo#2 Ingenieria en Ciencias de la Computación.
 * [Iddo José Claros - José Carlos Escobar - Carlos Amaury Tejada]
 */

/**
 * Description of ReportesController
 *
 * @author Amaury
 */
class ReportesController extends AppController {

    public $uses = false;
    public $helpers = array('Html', 'Form', 'Paginator');
    public $components = array('Paginator', 'Session');

    public function index() {
        $this->set('title_for_layout', 'Índice');
    }

    public function reporte_tramites() {

        App::import('Vendor/pchart', 'pData');
        App::import('Vendor/pchart', 'pChart');

        $fontFolder = APP . 'vendor' . DS . 'pchart' . DS . 'Fonts';

        $DataSet = new pData;

        $this->set('title_for_layout', 'Tramites por mes');
        $this->loadModel('Cattramite');

        $options = array('recursive' => 0);
        $cattramites = $this->Cattramite->find('all', $options);

        $n = 0;
        $total = 0;
        $data1 = array();
        $data2 = array();

        foreach ($cattramites as $cattramite) {
            $options = array('recursive' => 0, 'conditions' => array('Tramite.cattramite_id' => $cattramite['Cattramite']['id'], 'Tramite.fechainicio BETWEEN ? AND ?' => array('2014-09-01', '2014-09-31')));
            $count = $this->Cattramite->Tramite->find('count', $options);
            $cattramites[$n]['Cattramite']['cantidad'] = $count;

            if ($count == 0) {
                $data1[] = 1;
            } else {
                $data1[] = $count;
            }
            $data2[] = $cattramites[$n]['Cattramite']['nombre'];
            $total+= $count;
            $n++;
        }
        $meses = array(
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        );

        $DataSet->AddPoint($data1, "Serie1");
        $DataSet->AddPoint($data2, "Serie2");
        $DataSet->AddAllSeries();
        $DataSet->SetAbsciseLabelSerie("Serie2");

        // Initialise the graph
        $Test = new pChart(600, 200);
        $Test->loadColorPalette(APP . 'vendor' . DS . 'pchart' . DS . 'Sample' . DS . "softtones.txt");
        $Test->drawFilledRoundedRectangle(7, 7, 493, 393, 5, 240, 240, 240);
        $Test->drawRoundedRectangle(5, 5, 295, 195, 5, 230, 230, 230);

        // This will draw a shadow under the pie chart
        $Test->drawFilledCircle(122, 102, 70, 200, 200, 200);

        // Draw the pie chart
        $Test->setFontProperties($fontFolder . DS . "tahoma.ttf", 8);
        $Test->AntialiasQuality = 0;
        $Test->drawBasicPieGraph($DataSet->GetData(), $DataSet->GetDataDescription(), 120, 100, 70, PIE_PERCENTAGE, 255, 255, 218);
        $Test->drawPieLegend(230, 15, $DataSet->GetData(), $DataSet->GetDataDescription(), 250, 250, 250);
        $Test->Render(APP . "webroot/img/r1.png");

        $this->set(compact('meses'));
        $this->set('data', $cattramites);
        $this->set('total', $total);
    }

}
