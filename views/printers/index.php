<?php

use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrintersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Impresoras');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = $this->title;

$searchModelPrinterslogs = new app\models\PrintersLogsSearch();
$dataProviderPrinterslogs = $searchModelPrinterslogs->search(Yii::$app->request->queryParams);
$dataProviderPrinterslogs->sort->defaultOrder = [
    'date' => SORT_DESC,
];
?>
<div class="printers-index">

    <?php Pjax::begin(); ?>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'sideways'=>false,
        'bordered'=>false,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Impresoras',
                'content' => $this->render('indexGridview', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Registros',
                'content' => $this->render('../printerslogs/index', [
                    'searchModel' => $searchModelPrinterslogs,
                    'dataProvider' => $dataProviderPrinterslogs,
                ])

            ],
            /*[
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Reportes',
                'content' => $this->render('../printerslogs/report')

            ],*/

        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
