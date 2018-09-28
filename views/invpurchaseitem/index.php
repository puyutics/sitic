<?php

use yii\widgets\Pjax;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvPurchaseItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->title = Yii::t('app', 'Bienes TI');
$this->params['breadcrumbs'][] = $this->title;

$searchModelInvManufacturers = new app\models\InvManufacturersSearch();
$dataProviderInvManufacturers = $searchModelInvManufacturers->search(Yii::$app->request->queryParams);
$dataProviderInvManufacturers->sort->defaultOrder = [
    'manufacturer' => SORT_ASC,
];

$searchModelInvModels = new app\models\InvModelsSearch();
$dataProviderInvModels = $searchModelInvModels->search(Yii::$app->request->queryParams);
$dataProviderInvModels->sort->defaultOrder = [
    'model' => SORT_ASC,
];
?>
<div class="inv-purchase-item-index">

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
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Bienes (Global)',
                'content' => $this->render('_items', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Asignados',
                'content' => $this->render('_assigned')
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Sin asignar',
                'content' => $this->render('_unassigned')
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Modelos',
                'content' => $this->render('_models',[
                    'searchModel' => $searchModelInvModels,
                    'dataProvider' => $dataProviderInvModels
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Fabricantes',
                'content' => $this->render('_manufacturers',[
                    'searchModel' => $searchModelInvManufacturers,
                    'dataProvider' => $dataProviderInvManufacturers
                ])
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
