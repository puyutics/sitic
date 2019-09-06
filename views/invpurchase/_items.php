<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\InvPurchase */
?>


<div class="inv-purchase-items">

    <?php Pjax::begin(); ?>

    <?php
    $searchModelItems = new \app\models\InvPurchaseItemSearch();
    $searchModelItems->inv_purchase_id = $model->id;
    $dataProviderItems = $searchModelItems->search(Yii::$app->request->queryParams);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderItems,
        'filterModel' => $searchModelItems,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'inv_purchase_id',
            //'id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DETALLE',
                'attribute'=>'description',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['invpurchaseitem/edescription'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'MODELO',
                'attribute'=>'inv_models_id',
                'value' => 'invModels.model',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'formOptions' => ['action' => Url::to(['invpurchaseitem/einvmodelsid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\InvModels::find()->all(), 'id', 'model'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvModels::find()->all(), 'id', 'model'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar modelo'],
                'format'=>'raw',
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'serial_number',
                'editableOptions'=>[
                    'size' => 'sm',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['invpurchaseitem/eserialnumber'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'control_code',
                'editableOptions'=>[
                    'size' => 'sm',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['invpurchaseitem/econtrolcode'])],
                ],
                'pageSummary' => 'TOTAL',
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'PRECIO',
                'attribute'=>'amount',
                'format'=>['decimal', 2],
                'editableOptions'=>[
                    'size' => 'sm',
                    'formOptions' => ['action' => Url::to(['invpurchaseitem/eamount'])],
                ],
                'pageSummary' => true,
            ],

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
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        ['invpurchaseitem/create', 'id_invpurchase' => $model->id], [
                        'class' => 'btn btn-success',
                        'title' => ('Agregar Compra')
                    ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'responsive' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
        'showPageSummary' => true,
    ]); ?>

    <?php Pjax::end(); ?>

</div>