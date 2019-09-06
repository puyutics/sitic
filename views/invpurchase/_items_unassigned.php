<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvPurchaseItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="inv-purchase-item-index">

    <?php Pjax::begin(); ?>

    <?php
    $searchModelItemsUnassigned = new \app\models\InvItemsUnassignedSearch();
    $searchModelItemsUnassigned->inv_purchase_id = $model->id;
    $dataProviderItemsUnassigned = $searchModelItemsUnassigned->search(Yii::$app->request->queryParams);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderItemsUnassigned,
        'filterModel' => $searchModelItemsUnassigned,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'inv_purchase_id',
            [
                'label'=>'DETALLE',
                'attribute'=>'description',
            ],
            [
                'label'=>'MODELO',
                'attribute'=>'inv_models_id',
                'value' => function($model) {
                    $model_invModels = \app\models\InvModels::find()
                        ->where(['id' => $model->inv_models_id])->one();
                    $model_invManufacturers = \app\models\InvManufacturers::find()
                        ->where(['id' => $model_invModels->inv_manufacturers_id])->one();
                    return $model_invManufacturers->manufacturer . " " . $model_invModels->model;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvModels::find()->all(), 'id', 'model'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar modelo'],
                'format'=>'raw',
            ],
            'serial_number',
            'control_code',
            [
                'label'=>'CODIGO CONTROL',
                'attribute'=>'control_code',
                'pageSummary' => 'TOTAL',
            ],
            [
                'label'=>'PRECIO',
                'attribute'=>'amount',
                'format'=>['decimal', 2],
                'pageSummary' => true,
            ],

            //['class' => 'kartik\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{transfer}',
                'buttons'=>[
                    'transfer' => function ($url, $model) {
                        return Html::a('<span class="btn btn-warning center-block">Asignar</span>',
                            Url::to(['/invpurchaseitem/view', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Asignar Bien'),
                            ]);
                    }
                ]
            ],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>

                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                        'class' => 'btn btn-default',
                        'title' => ('Reset Grid')
                    ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
        'showPageSummary' => true,
    ]); ?>
    <?php Pjax::end(); ?>
</div>
