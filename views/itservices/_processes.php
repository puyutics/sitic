<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItProcessesServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="it-processes-services-index">

    <?php //Pjax::begin(); ?>

    <?php
    $searchModelProcessesServices = new \app\models\ItProcessesServicesSearch();
    $searchModelProcessesServices->it_services_id = $model->id;
    $dataProviderProcessesServices = $searchModelProcessesServices->search(Yii::$app->request->queryParams);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProcessesServices,
        //'filterModel' => $searchModelProcessesServices,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'PROCESO',
                'attribute'=>'it_processes_id',
                'value'=>'itProcesses.process',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itprocessesservices/eitprocessesid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\ItProcesses::find()->all(), 'id', 'process'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\ItProcesses::find()->all(), 'id', 'process'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar proceso'],
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
                        'formOptions' => ['action' => Url::to(['itprocessesprojects/estatus'])],
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
                            Url::to(['/itprocessesservices/update', 'id' => $model->id]), [
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
                            Url::to(['/itprocesses/admin', 'id' => $model->it_processes_id]), [
                                'title' => Yii::t('yii', 'Abrir Proceso'),
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
                        ['itprocessesservices/create', 'it_services_id' => $model->id], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Proceso')
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
    <?php //Pjax::end(); ?>
</div>
