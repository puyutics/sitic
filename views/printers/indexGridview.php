<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PrintersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="printers-index">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'IMPRESORA',
                'attribute'=>'printer',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['printers/eprinter'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'ipv4_address',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['printers/eipv4address'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'serial_number',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['printers/eserialnumber'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DEPARTAMENTO',
                'attribute'=>'department_id',
                'value'=>'department.department',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['printers/edepartmentid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\Department::find()->all(),
                                'id', 'department'),
                        ]
                    ];
                },
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'MODELO',
                'attribute'=>'inv_models_id',
                'value'=>'invModels.model',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['printers/einvmodelsid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\InvModels::find()->all(),
                                'id', 'model'),
                        ]
                    ];
                },
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'ESTADO',
                'attribute'=>'status',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['printers/estatus'])],
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

            //['class' => 'kartik\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>', $url, [
                            'title' => Yii::t('yii', 'Editar Impresora'),
                        ]);
                    }
                ]
            ],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                        'class' => 'btn btn-success',
                        'title' => ('Agregar Impresora')
                    ]),
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
    ]); ?>
    <?php Pjax::end(); ?>
</div>
