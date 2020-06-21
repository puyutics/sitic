<?php

use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use yii\web\JsExpression;
use dosamigos\chartjs\ChartJs;

$fecha = date("Y-m-d H:i:s");
$url = Url::to('@web/uploads/tabintformulario/contrato/', 'https');
$username = Yii::$app->user->identity->username;
$user_profile = \app\models\UserProfile::find()
    ->where(["username" => $username])
    ->one();

?>

<htmlpageheader name="myheader">
    <div style="border-bottom: 1px solid #000000; text-align: center; padding-top: 3mm; ">
        <h3><?= Html::img('images/uea_logo.png',['style' => 'width:40px;height: 40px']); ?>
            <b>UNIVERSIDAD ESTATAL AMAZÓNICA</b></h3>
        <h5><b>Sistema Integrado de Tecnologías de la Información y Comunicación</b></h5>
    </div>
</htmlpageheader>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<htmlpagefooter name="myfooter">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Documento generado por el Módulo de Gestión de Recursos Académicos,
        el <?php echo $fecha; ?><br>Pág. {PAGENO} de {nb} - Impreso por <?php echo $user_profile->mail ?>
    </div>
</htmlpagefooter>
<sethtmlpagefooter name="myfooter" value="on" />
<h4>
    <div align="center">
        <strong>REPORTE DE CONTRATOS DE RECURSOS ACADÉMICOS</strong>
    </div>
</h4>
<br>
<p style="text-align: justify">
    <b>Reporte generado por: <?php echo $user_profile->commonname ?></b>
    <br>
    <b>Correo institucional: <?php echo $user_profile->mail ?></b>
    <br>
    <b>Total de beneficiarios: <?php echo count($tabintformulario) ?></b>
    <br>
    <b>Filtros: </b>
    <br>
    <b>- Fecha Inicio: </b><?php if ($fecha_inicio == '%') { ?>Todos<?php } ?>
    <?php if ($fecha_inicio != '%') { echo $fecha_inicio; } ?>
    <br>
    <b>- Fecha Fin: </b><?php if ($fecha_fin == '%') { ?>Todos<?php } ?>
    <?php if ($fecha_fin != '%') { echo $fecha_fin; } ?>
    <br>
    <b>- Beneficiario: </b><?php if ($dni == '%') { ?>Todos<?php } ?>
    <?php if ($dni != '%') { echo $tabintformulario[0]->apellidos . ' ' . $tabintformulario[0]->nombres; ?>
        <br>
        <b>- Cédula: </b><?php echo $tabintformulario[0]->cedula; ?>
    <?php } ?>
    <br>
    <b>- Provincia: </b><?php if ($provincia == '%') { ?>Todas<?php } ?>
    <?php if ($provincia != '%') { echo $tabintformulario[0]->provincia; } ?>
    <br>
    <b>- Beneficio: </b><?php if ($beneficio == '%') { ?>Todos<?php } ?>
    <?php if ($beneficio != '%') { echo $tabintformulario[0]->encuesta_beneficiario; } ?>
    <br>
    <b>- Estado: </b><?php if ($status == '%') { ?>Todos<?php } ?>
    <?php if ($status == '1') { echo 'Contrato creado'; } ?>
    <?php if ($status == '2') { echo 'Beneficio Entregado'; } ?>
    <br>
</p>

<?php
///////////////////REPORTE GRÁFICO////////////////////

$label_provincias_total = \app\models\TabIntFormulario::find()
    ->select(['provincia',])
    ->groupBy('provincia')
    ->where("provincia LIKE '" . $provincia . "'")
    ->column();

$data_provincias_total = \app\models\TabIntFormulario::find()
    ->select('count(*) as data')
    ->groupBy('provincia')
    ->where("provincia LIKE '" . $provincia . "'")
    ->column();

$label_provincias_tablets = \app\models\TabIntFormulario::find()
    ->select('provincia')
    ->groupBy('provincia, encuesta_beneficiario')
    ->where('encuesta_beneficiario = "TABLET e Internet Educativo Ilimitado"')
    ->column();

$data_provincias_tablets = \app\models\TabIntFormulario::find()
    ->select('count(*) as data')
    ->groupBy('provincia, encuesta_beneficiario')
    ->where('encuesta_beneficiario = "TABLET e Internet Educativo Ilimitado"')
    ->column();

$label_provincias_internet = \app\models\TabIntFormulario::find()
    ->select('provincia')
    ->groupBy('provincia, encuesta_beneficiario')
    ->where('encuesta_beneficiario = "Internet Educativo Ilimitado"')
    ->column();

$data_provincias_internet = \app\models\TabIntFormulario::find()
    ->select('count(*) as data')
    ->groupBy('provincia, encuesta_beneficiario')
    ->where('encuesta_beneficiario = "Internet Educativo Ilimitado"')
    ->column();

$label_beneficio = \app\models\TabIntFormulario::find()
    ->select(['encuesta_beneficiario',])
    ->groupBy('encuesta_beneficiario')
    ->column();

$data_beneficio = \app\models\TabIntFormulario::find()
    ->select('count(*) as data')
    ->groupBy('encuesta_beneficiario')
    ->column();

$label_estratificacion = \app\models\TabIntFormulario::find()
    ->select(['ficha_escasos_recursos',])
    ->groupBy('ficha_escasos_recursos')
    ->column();

$data_estratificacion = \app\models\TabIntFormulario::find()
    ->select('count(*) as data')
    ->groupBy('ficha_escasos_recursos')
    ->column();


echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BENEFICIARIOS POR PROVINCIAS (TOTAL)',
        ],
        'xAxis' => [
            'categories' => $label_provincias_total,
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Total',
                //'data' => $data_provincias_total,
                'data' => [1,2,1,4,1,2,2,1,2,8,1,12,56,22,59,5,2,37,12,23],
            ],
            [
                'type' => 'column',
                'name' => 'Tablets',
                //'data' => $data_provincias_total,
                'data' => [0,0,0,0,0,0,0,0,0,0,0,0,34,0,41,0,0,26,0,17],
            ],
            [
                'type' => 'column',
                'name' => 'Internet',
                //'data' => $data_provincias_total,
                'data' => [0,0,0,0,0,0,0,0,0,0,0,0,22,0,18,0,0,11,0,6],
            ],
        ],
    ]
]);

$dataProvider = new \yii\data\ArrayDataProvider(['allModels' => $data_provincias_tablets]);
print_r($dataProvider);



echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'TABLETS E INTERNET EDUCATIVO ILIMITADO',
        ],
        'xAxis' => [
            'categories' => $label_provincias_tablets,
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Tablets',
                'data' => new SeriesDataHelper($dataProvider, ['']),
                //'data' => $data_provincias_tablets,
                //'data' => [0,0,0,0,0,0,0,0,0,34,0,41,0,0,26,0,17],
            ],
        ],
    ]
]);

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'INTERNET EDUCATIVO ILIMITADO',
        ],
        'xAxis' => [
            'categories' => $label_provincias_internet,
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Internet',
                //'data' => $data_provincias_total,
                'data' => [0,0,0,0,0,0,0,34,0,41,0,26,0,17],
            ],
        ],
    ]
]);

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'TIPOS DE BENEFICIOS',
        ],
        'series' => [[
            'type' => 'pie',
            'options3d' => [
                'enabled' => true,
                'alpha' => 15,
                'beta' => 15
            ],
            'name' => 'Total',
            'data' => [
                [
                    'name' => $label_beneficio[0],
                    'y' => 79,
                    'color' => new JsExpression('Highcharts.getOptions().colors[0]'),
                ],
                [
                    'name' => $label_beneficio[1],
                    'y' => 174,
                    'color' => new JsExpression('Highcharts.getOptions().colors[1]'),
                ],
            ],
            //'center' => [100, 80],
            'size' => 300,
            'showInLegend' => true,
            'dataLabels' => [
                'enabled' => true,
            ],
        ],
        ],
    ]
]);

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'BENEFICIARIOS POR ESTRATIFICACIÓN',
        ],
        'series' => [[
            'type' => 'pie',
            'options3d' => [
                'enabled' => true,
                'alpha' => 15,
                'beta' => 15
            ],
            'name' => 'Total',
            'data' => [
                [
                    'name' => $label_estratificacion[0],
                    'y' => 20,
                    'color' => new JsExpression('Highcharts.getOptions().colors[0]'),
                ],
                [
                    'name' => $label_estratificacion[1],
                    'y' => 119,
                    'color' => new JsExpression('Highcharts.getOptions().colors[1]'),
                ],
                [
                    'name' => $label_estratificacion[2],
                    'y' => 114,
                    'color' => new JsExpression('Highcharts.getOptions().colors[2]'),
                ],
            ],
            //'center' => [100, 80],
            'size' => 300,
            'showInLegend' => true,
            'dataLabels' => [
                'enabled' => true,
            ],
        ],
        ],
    ]
]);

echo ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 400,
        'width' => 400
    ],
    'data' => [
        'labels' => ["January", "February", "March", "April", "May", "June", "July"],
        'datasets' => [
            [
                'label' => "My First dataset",
                'backgroundColor' => "rgba(179,181,198,0.2)",
                'borderColor' => "rgba(179,181,198,1)",
                'pointBackgroundColor' => "rgba(179,181,198,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                'data' => [65, 59, 90, 81, 56, 55, 40]
            ],
            [
                'label' => "My Second dataset",
                'backgroundColor' => "rgba(255,99,132,0.2)",
                'borderColor' => "rgba(255,99,132,1)",
                'pointBackgroundColor' => "rgba(255,99,132,1)",
                'pointBorderColor' => "#fff",
                'pointHoverBackgroundColor' => "#fff",
                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                'data' => [28, 48, 40, 19, 96, 27, 100]
            ]
        ]
    ]
]);

?>