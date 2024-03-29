<?php

use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use yii\web\JsExpression;

$this->title = 'Reporte Gráfico - Carnetización';

$fecha = date("Y-m-d H:i:s");
$periodo = \app\models\siad_pregrado\Periodo::getUltimoPeriodoActivo();
$periodoDescriptivo = \app\models\siad_pregrado\Periodo::Periododescriptivo($periodo);
$url = Url::to('@web/uploads/carnetizacion/'.$periodo.'/', 'https');
$username = Yii::$app->user->identity->username;
$user_profile = \app\models\UserProfile::find()
    ->where(["username" => $username])
    ->one();

///////////////////TOTAL CARNETS DIGITALES////////////////
$carnets = \app\models\Carnetizacion::find()
    ->select('id')
    ->where(['idPer' => $periodo])
    ->all();


?>

<htmlpageheader name="myheader">
    <div style="border-bottom: 1px solid #000000; text-align: center; padding-top: 3mm; ">
        <?= Html::img('images/uea_banner.png',['style' => 'width:400px']); ?>
        <br>
        <br>
        <h4><b>Dirección de Gestión de Tecnologías de la Información y Comunicación</b></h4>
    </div>
</htmlpageheader>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<h4>
    <div align="center">
        <strong><?php echo $this->title ?></strong>
    </div>
</h4>
<br>
<p style="text-align: justify">
    <b>Reporte generado por: <?php echo $user_profile->commonname ?></b>
    <br>
    <b>Correo institucional: <?php echo $user_profile->mail ?></b>
    <br>
    <b>Total de Carnets Digitales: <?php echo count($carnets) ?></b>
    <br>
    <b>Período: <?php echo $periodoDescriptivo ?></b>
</p>
<br>
<h3>
    <div align="center">
        <strong>DATOS CARNETIZACIÓN</strong>
        <br>
        CARNETS GENERADOS: <?= count($carnets) ?>
    </div>
</h3>
<br>
<br>
<?php


/*$datatime_fecregistro = \app\models\Carnetizacion::find()
    ->select(['date_format(fec_registro, "%Y-%m-%d %H:00") as fecha','count(date_format(fec_registro, "%Y-%m-%d %H:00")) as data'])
    ->groupBy('fecha')
    ->asArray()
    ->all();
$datatimeProviderFecRegitro = new \yii\data\ArrayDataProvider(['allModels' => $datatime_fecregistro,'pagination' => false]);

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'CARNETS DIGITALES / CREADOS POR FECHA Y HORA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($datatimeProviderFecRegitro, ['fecha']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Carnets']
        ],
        'series' => [
            [
                //'type' => 'spline',
                'type' => 'areaspline',
                'name' => 'Total',
                'data' => new SeriesDataHelper($datatimeProviderFecRegitro, ['data:int']),
                'color' => new JsExpression('Highcharts.getOptions().colors[8]'),
            ],
        ],
        'credits' => array('enabled' => true),
    ]
]);*/


$data_fecregistro = \app\models\Carnetizacion::find()
    ->select(['date_format(fec_registro, "%Y-%m") as fecha','count(date_format(fec_registro, "%Y-%m-%d")) as data'])
    ->where(['idPer' => $periodo])
    ->groupBy('fecha')
    ->asArray()
    ->all();
$dataProviderFecRegitro = new \yii\data\ArrayDataProvider(['allModels' => $data_fecregistro,'pagination' => false]);

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'CARNETS DIGITALES / CREADOS POR FECHA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderFecRegitro, ['fecha']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Carnets']
        ],
        'series' => [
            [
                //'type' => 'spline',
                'type' => 'areaspline',
                'name' => 'Total',
                'data' => new SeriesDataHelper($dataProviderFecRegitro, ['data:int']),
                'color' => new JsExpression('Highcharts.getOptions().colors[8]'),
            ],
        ],
        'credits' => array('enabled' => true),
    ]
]);


$data_fecregistrototal = \app\models\Carnetizacion::findBySql(
    "SELECT c.fecha, c.data, @running_total:=@running_total + c.data AS total
         FROM (SELECT
                    date_format(fec_registro, '%Y-%m') as fecha,
                    count(date_format(fec_registro, '%Y-%m')) as data
                    FROM carnetizacion
                    WHERE idPer = ".$periodo."
                    GROUP BY fecha) c
                JOIN (SELECT @running_total:=0) r
                ORDER BY c.fecha")
    ->asArray()
    ->all();
$dataProviderFecRegitroTotal = new \yii\data\ArrayDataProvider(['allModels' => $data_fecregistrototal,'pagination' => false]);

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'CARNETS DIGITALES / ACUMULADOS POR FECHA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderFecRegitroTotal, ['fecha']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Carnets']
        ],
        'series' => [
            [
                'type' => 'areaspline',
                'name' => 'Total',
                'data' => new SeriesDataHelper($dataProviderFecRegitroTotal, ['total:int']),
                'color' => new JsExpression('Highcharts.getOptions().colors[2]'),
            ],
        ],
        'credits' => array('enabled' => true),
    ]
]);


$data_carrera = \app\models\Carnetizacion::findBySql(
    "SELECT
            CONCAT(idCarr, '( ', COUNT(c.id), ' )') as idCarr,
            COUNT(c.id) as data
        FROM
            carnetizacion c
        WHERE
            c.idPer = ".$periodo."
        GROUP BY
            c.idCarr
        ORDER BY
            idCarr ASC
        ")
    ->asArray()
    ->all();
$dataProviderCarrera = new \yii\data\ArrayDataProvider(['allModels' => $data_carrera,'pagination' => false]);

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
        'highcharts-3d',
    ],
    'options' => [
        'chart' => ['type' => 'pie',
            'options3d' => [
                'enabled' => true,
                'alpha' => 45,
                'beta' => 0,
            ]
        ],
        'plotOptions' => [
            'pie' => [
                'allowPointSelect' => true,
                'cursor' => 'pointer',
                'depth' => 45
            ]
        ],
        'title' => [
            'text' => 'CARNETS DIGITALES POR CARRERA',
        ],
        'series' => [[
            'type' => 'pie',
            'data' => new SeriesDataHelper($dataProviderCarrera, ['idCarr','data:int']),
            'showInLegend' => false,
            'dataLabels' => [
                'enabled' => true,
            ],
        ],
        ],
        'credits' => array('enabled' => true),
    ]
]);

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'CARNETS DIGITALES POR CARRERA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderCarrera, ['idCarr']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Carnets']
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Total',
                'data' => new SeriesDataHelper($dataProviderCarrera, ['data:int']),
                'color' => new JsExpression('Highcharts.getOptions().colors[9]'),
            ],
        ],
        'credits' => array('enabled' => true),
    ]
]);

?>

<htmlpagefooter name="myfooter">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Documento generado por el Módulo de Gestión de Carnets Digitales,
        el <?php echo $fecha; ?><br><!--Pág. {PAGENO} de {nb} - -->Impreso por <?php echo $user_profile->mail ?>
    </div>
</htmlpagefooter>
<sethtmlpagefooter name="myfooter" value="on" />
