<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvPurchaseItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="inv-purchase-item-indexGridview">

    <?php Pjax::begin(); ?>

    <div align="center">
        <h3>Bienes TI (Global)</h3>
    </div>

    <p>
        <?php //= Html::a(Yii::t('app', 'Agregar Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'COMPRA',
                'attribute'=>'inv_purchase_id',
                'value' => 'invPurchase.code',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'formOptions' => ['action' => Url::to(['invpurchaseitem/einvpurchaseid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\InvPurchase::find()->all(), 'id', 'code'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvPurchase::find()->all(), 'id', 'code'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar compra'],
                'format'=>'raw',
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DETALLE BIEN',
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
                'label'=>'COD.',
                'attribute'=>'control_code',
                'editableOptions'=>[
                    'size' => 'sm',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['invpurchaseitem/econtrolcode'])],
                ],
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
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{transfer}',
                'buttons'=>[
                    'transfer' => function ($url, $model) {
                        return Html::a('<span class="btn btn-warning center-block"><i class="fa fa-fw fa-arrow-right"></i>Asignar</span>',
                            Url::to(['/invpurchaseitem/view', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Asignar Bien'),
                            ]);
                    }
                ]
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block"><i class="fa fa-fw fa-folder"></i>Compra</span>',
                            Url::to(['invpurchase/admin', 'id' => $model->inv_purchase_id]), [
                            'title' => Yii::t('yii', 'Abrir Compra'),
                        ]);
                    },
                ]
            ],

        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        ['invpurchaseitem/create'], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Etapa')
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
    ]); ?>

    <?php Pjax::end(); ?>

</div>
