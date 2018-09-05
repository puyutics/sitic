<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ItProjectsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="it-projects-services-index">

    <?php //Pjax::begin(); ?>

    <?php
    $searchModelProjectsServices = new \app\models\ItProjectsServicesSearch();
    $searchModelProjectsServices->it_projects_id = $model->id;
    $dataProviderProjectsServices = $searchModelProjectsServices->search(Yii::$app->request->queryParams);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProjectsServices,
        //'filterModel' => $searchModelProjectsServices,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',

            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'it_services_id',
                'value'=>'itServices.service',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itprojectsservices/eitservicesid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\ItServices::find()->all(), 'id', 'service'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\ItServices::find()->all(), 'id', 'service'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar servicio'],
                'format'=>'raw'
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DESCRIPCION',
                'attribute'=>'description',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['itprojectsservices/edescription'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'ESTADO',
                'attribute'=>'status',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['itprojectsservices/estatus'])],
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
                            Url::to(['/itprojectsservices/update', 'id' => $model->id]), [
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
                            Url::to(['/itservices/admin', 'id' => $model->it_services_id]), [
                                'title' => Yii::t('yii', 'Abrir Servicio'),
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
                        ['itprojectsservices/create', 'it_projects_id' => $model->id], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Servicio')
                        ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => false,
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
