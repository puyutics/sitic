<?php

use yii\helpers\Html;
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use yii\web\JsExpression;

$this->title = 'Reporte Gráfico - Contratos Recursos Académicos';

$fecha = date("Y-m-d H:i:s");
$url = Url::to('@web/uploads/tabintformulario/contrato/', 'https');
$username = Yii::$app->user->identity->username;
$user_profile = \app\models\UserProfile::find()
    ->where(["username" => $username])
    ->one();

///////////////////TOTAL BENEFICIARIOS////////////////
$formularios = \app\models\TabIntFormulario::find()->all();

///////////////////REPORTE GRÁFICO////////////////////

$data_provincias_total = \app\models\TabIntFormulario::find()
    ->select('provincia, count(*) as data')
    ->groupBy('provincia')
    ->asArray()
    ->all();

$data_provincias_tablets = \app\models\TabIntFormulario::find()
    ->select('provincia, count(*) as data')
    ->groupBy('provincia, encuesta_beneficiario')
    ->andWhere('encuesta_beneficiario = "TABLET e Internet Educativo Ilimitado"')
    ->asArray()
    ->all();

$data_provincias_internet = \app\models\TabIntFormulario::find()
    ->select('provincia, count(*) as data')
    ->groupBy('provincia, encuesta_beneficiario')
    ->andWhere('encuesta_beneficiario = "Internet Educativo Ilimitado"')
    ->asArray()
    ->all();

$data_beneficio = \app\models\TabIntFormulario::find()
    ->select('encuesta_beneficiario, count(*) as data')
    ->groupBy('encuesta_beneficiario')
    ->asArray()
    ->all();

$data_estratificacion = \app\models\TabIntFormulario::find()
    ->select('ficha_escasos_recursos, count(*) as data')
    ->groupBy('ficha_escasos_recursos')
    ->asArray()
    ->all();

$data_fecregistro = \app\models\TabIntFormulario::find()
    ->select(['date_format(fec_registro, "%Y-%m-%d") as fecha','count(date_format(fec_registro, "%Y-%m-%d")) as data'])
    ->groupBy('fecha')
    ->asArray()
    ->all();

$data_fecregistrototal = \app\models\TabIntFormulario::findBySql(
    "SELECT tif.fecha, tif.data, @running_total:=@running_total + tif.data AS total
         FROM (SELECT
                 date(fec_registro) as fecha,
                    count(fec_registro) as data
                    FROM tab_int_formulario
                    GROUP BY fecha ) tif
                JOIN (SELECT @running_total:=0) r
                ORDER BY tif.fecha")
    ->asArray()
    ->all();

$data_carrera = \app\models\TabIntFormulario::find()
    ->select(['siad_carrera','count(*) as data'])
    ->groupBy('siad_carrera')
    ->asArray()
    ->all();

$dataProviderTotal = new \yii\data\ArrayDataProvider(['allModels' => $data_provincias_total,'pagination' => false]);
$dataProviderTablets = new \yii\data\ArrayDataProvider(['allModels' => $data_provincias_tablets,'pagination' => false]);
$dataProviderInternet = new \yii\data\ArrayDataProvider(['allModels' => $data_provincias_internet,'pagination' => false]);
$dataProviderBeneficio = new \yii\data\ArrayDataProvider(['allModels' => $data_beneficio,'pagination' => false]);
$dataProviderEstratificacion = new \yii\data\ArrayDataProvider(['allModels' => $data_estratificacion,'pagination' => false]);
$dataProviderFecRegitro = new \yii\data\ArrayDataProvider(['allModels' => $data_fecregistro,'pagination' => false]);
$dataProviderFecRegitroTotal = new \yii\data\ArrayDataProvider(['allModels' => $data_fecregistrototal,'pagination' => false]);
$dataProviderCarrera = new \yii\data\ArrayDataProvider(['allModels' => $data_carrera,'pagination' => false]);

?>

<htmlpageheader name="myheader">
    <div style="border-bottom: 1px solid #000000; text-align: center; padding-top: 3mm; ">
        <h3><?= Html::img('images/uea_logo.png',['style' => 'width:40px;height: 40px']); ?>
            <b>UNIVERSIDAD ESTATAL AMAZÓNICA</b></h3>
        <h5><b>Sistema Integrado de Tecnologías de la Información y Comunicación</b></h5>
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
    <b>Total de beneficiarios: <?php echo count($formularios) ?></b>
</p>

<?php

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
        //'themes/sand-signika',
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
                //'innerSize' => 100,
                'depth' => 45
            ]
        ],
        'title' => [
            'text' => 'BENEFICIARIOS POR PROVINCIAS',
        ],
        'series' => [[
            'type' => 'pie',
            'data' => new SeriesDataHelper($dataProviderTotal, ['provincia','data:int']),
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
            'text' => 'BENEFICIARIOS POR PROVINCIAS',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderTotal, ['provincia']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Total',
                'data' => new SeriesDataHelper($dataProviderTotal, ['data:int']),
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
            'text' => 'CONTRATOS CREADOS POR FECHA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderFecRegitro, ['fecha']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
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

echo Highcharts::widget([
    'scripts' => [
        'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'title' => [
            'text' => 'CONTRATOS ACUMULADOS POR FECHA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderFecRegitroTotal, ['fecha']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
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
            'text' => 'TIPOS DE BENEFICIOS',
        ],
        'series' => [[
            'type' => 'pie',
            'data' => new SeriesDataHelper($dataProviderBeneficio, ['encuesta_beneficiario','data:int']),
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
            'text' => 'INTERNET EDUCATIVO ILIMITADO POR PROVINCIA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderInternet, ['provincia']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Internet',
                'data' => new SeriesDataHelper($dataProviderInternet, ['data:int']),
                'color' => new JsExpression('Highcharts.getOptions().colors[0]'),
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
            'text' => 'TABLETS E INTERNET EDUCATIVO ILIMITADO POR PROVINCIA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderTablets, ['provincia']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
        ],
        'series' => [
            [
                'type' => 'column',
                'name' => 'Tablets',
                'data' => new SeriesDataHelper($dataProviderTablets, ['data:int']),
                'color' => new JsExpression('Highcharts.getOptions().colors[1]'),
            ],
        ],
        'credits' => array('enabled' => true),
    ]
]);

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
            'text' => 'BENEFICIARIOS POR ESTRATIFICACIÓN ECONÓMICA',
        ],
        'series' => [[
            'type' => 'pie',
            'data' => new SeriesDataHelper($dataProviderEstratificacion, ['ficha_escasos_recursos','data:int']),
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
            'text' => 'BENEFICIARIOS POR CARRERA',
        ],
        'series' => [[
            'type' => 'pie',
            'data' => new SeriesDataHelper($dataProviderCarrera, ['siad_carrera','data:int']),
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
            'text' => 'BENEFICIARIOS POR CARRERA',
        ],
        'xAxis' => [
            'categories' => new SeriesDataHelper($dataProviderCarrera, ['siad_carrera']),
        ],
        'yAxis' => [
            'title' => ['text' => 'Beneficiarios']
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
        Documento generado por el Módulo de Gestión de Recursos Académicos,
        el <?php echo $fecha; ?><br><!--Pág. {PAGENO} de {nb} - -->Impreso por <?php echo $user_profile->mail ?>
    </div>
</htmlpagefooter>
<sethtmlpagefooter name="myfooter" value="on" />
