<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Servicios TI');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-services-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Agregar Servicio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div align="center">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'service',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['itservices/eservice'])],
                ],
            ],
            //'description:ntext',
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'TIPO',
                'attribute'=>'type',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['itservices/etype'])],
                        'data' =>[
                            'PROPIO'=>'PROPIO',
                            'CONTRATADO'=>'CONTRATADO',
                            'OPEN SOURCE'=>'OPEN SOURCE'
                        ],
                        'options' => [
                            'class'=>'form-control', 'prompt'=>'Seleccionar tipo',
                        ]
                    ];
                },
                'filter'=>[
                    'PROPIO'=>'PROPIO',
                    'CONTRATADO'=>'CONTRATADO',
                    'OPEN SOURCE'=>'OPEN SOURCE'
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'CREACION',
                'attribute'=>'date_creation',
                'editableOptions'=>[
                    'inputType' => Editable::INPUT_DATE,
                    'formOptions' => ['action' => Url::to(['itservices/edatecreation'])],
                    'options'=>[
                        'pluginOptions'=>['format'=>'yyyy-mm-dd']
                    ]
                ],
            ],
            //'date_renovation',
            //'date_closed',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'stakeholders',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['itservices/estakeholders'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'IMPORTANCIA',
                'attribute'=>'magnitude',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['itservices/emagnitude'])],
                        'data' =>[
                            '0'=>'BAJA',
                            '1'=>'MEDIA',
                            '2'=>'ALTA',
                        ],
                        'displayValueConfig'=> [
                            '0' => 'BAJA',
                            '1' => 'MEDIA',
                            '2' => 'ALTA',
                        ],
                        'options' => [
                            'class'=>'form-control', 'prompt'=>'Seleccionar importancia',
                        ]
                    ];
                },
                'filter'=>[
                    '0'=>'BAJA',
                    '1'=>'MEDIA',
                    '2'=>'ALTA',
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
                        'formOptions' => ['action' => Url::to(['itservices/estatus'])],
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
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Abrir</span>', $url, [
                            'title' => Yii::t('yii', 'Abrir Servicio'),
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
                        'title' => ('Agregar Proyecto')
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
