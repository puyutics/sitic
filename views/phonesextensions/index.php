<?php

use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhonesExtensionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Extensiones Telefónicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = $this->title;

$searchModelPhoneslogs = new app\models\PhonesLogsSearch();
$dataProviderPhoneslogs = $searchModelPhoneslogs->search(Yii::$app->request->queryParams);
$dataProviderPhoneslogs->sort->defaultOrder = [
    'date' => SORT_DESC,
];
?>
<div class="phones-extensions-index">

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
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Teléfonos',
                'content' => $this->render('indexGridview', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Registros',
                'content' => $this->render('../phoneslogs/index', [
                    'searchModel' => $searchModelPhoneslogs,
                    'dataProvider' => $dataProviderPhoneslogs,
                ])

            ],
            /*[
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Reportes',
                'content' => $this->render('../phoneslogs/report')

            ],*/

        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
