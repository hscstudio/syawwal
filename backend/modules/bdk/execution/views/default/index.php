<?php 
use miloschuman\highcharts\Highcharts;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="bdk-execution-default-index">
    <?php
        echo Highcharts::widget([
           'options' => [
                'chart' => [
                    'type' => 'pie',
                ],

              'title' => ['text' => 'Fruit Consumption'],
              'xAxis' => [
                 'categories' => ['Apples', 'Bananas', 'Oranges']
              ],
              'yAxis' => [
                 'title' => ['text' => 'Fruit eaten']
              ],
              'series' => [
                 ['name' => 'Jane', 'data' => [1, 0, 4]],
                 ['name' => 'John', 'data' => [5, 7, 3]]
              ]
           ]
        ]);
    ?>
</div>