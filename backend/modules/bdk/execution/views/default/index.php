<?php 
use miloschuman\highcharts\Highcharts;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="bdk-execution-default-index">
    <div class="row">
        <div class="col-md-8">
            <?php
                echo Highcharts::widget([
                   'options' => [
                        'chart' => [
                            'type' => 'column',
                        ],
                        'credits' => [
                            'enable' => false
                        ],
                        'title' => [
                            'text' => 'Total Rencana Sebaran Data Peserta Diklat'
                        ],
                        'xAxis' => [
                            'categories' => $cat
                        ],
                        'yAxis' => [
                            'title' => [
                                'text' => 'Spread'
                            ]
                        ],
                        'tooltip' => [
                            'crosshairs' => [false, true]
                        ],
                        'series' => $series
                   ]
                ]);
            ?>
        </div>
        <div class="col-md-4">
            <?php
                /*echo Highcharts::widget([
                   'options' => [
                        'chart' => [
                            'type' => 'column',
                        ],
                        'credits' => [
                            'enable' => false
                        ],
                        'title' => [
                            'text' => 'Total Anggaran dan Realisasi'
                        ],
                        'xAxis' => [
                            'categories' => $catYear
                        ],
                        'yAxis' => [
                            'title' => [
                                'text' => 'Rupiah'
                            ]
                        ],
                        'tooltip' => [
                            'crosshairs' => [false, true]
                        ],
                        'series' => $seriesCost
                   ]
                ]);*/
            ?>
        </div>
    </div>
</div>