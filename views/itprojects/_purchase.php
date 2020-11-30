<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsSearch */
/* @var $searchModel app\models\ItProjectsPurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="it-projects-purchase-index">

    <?php Pjax::begin(); ?>

    <?php
    $searchModelProjectsPurchase = new \app\models\ItProjectsPurchaseSearch();
    $searchModelProjectsPurchase->it_projects_id = $model->id;
    $dataProviderProjectsPurchase = $searchModelProjectsPurchase->search(Yii::$app->request->queryParams);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProjectsPurchase,
        //'filterModel' => $searchModelProjectsPurchase,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'COMPRAS',
                'attribute'=>'inv_purchase_id',
                'value'=>'invPurchase.description',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itprojectspurchase/einvpurchaseid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\InvPurchase::find()->all(), 'id', 'description'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvPurchase::find()->all(), 'id', 'description'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar compra'],
                'format'=>'raw'
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'ESTADO',
                'attribute'=>'status',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['itprojectspurchase/estatus'])],
                        'data' =>['0'=>'INACTIVO','1'=>'ACTIVO'],
                        'displayValueConfig'=> [
                            '0' => '<i class="glyphicon glyphicon-remove text-danger"></i> INACTIVO',
                            '1' => '<i class="glyphicon glyphicon-ok text-success"></i> ACTIVO',
                        ],
                        'options' => [
                            'class'=>'form-control', 'prompt'=>'Seleccionar estado',
                        ]
                    ];
                },
                'filter'=>['0'=>'INACTIVO','1'=>'ACTIVO'],
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{edit}',
                'buttons'=>[
                    'edit' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>',
                            Url::to(['/itprojectspurchase/update', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Editar Relación'),
                            ]);
                    }
                ]
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Abrir</span>',
                            Url::to(['/invpurchase/admin', 'id' => $model->inv_purchase_id]), [
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
                        ['itprojectspurchase/create', 'it_projects_id' => $model->id], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Compra')
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
