<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItIncidentsReportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Reportes de Incidentes de Servicos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-incidents-reports-index">

    <?php Pjax::begin(); ?>

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
                'label'=>'ASUNTO',
                'attribute'=>'subject',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['itincidentsreports/esubject'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DETALLE PROBLEMA',
                'attribute'=>'issue',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['itincidentsreports/eissue'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'FECHA REPORTE',
                'attribute'=>'date_reported',
                'editableOptions'=>[
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['itincidentsreports/edatereported'])],
                    'options'=>[
                        'pluginOptions'=>['format'=>'yyyy-mm-dd hh:MM:ss']
                    ]
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'FECHA SOLUCION',
                'attribute'=>'date_solved',
                'editableOptions'=>[
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['itincidentsreports/edatesolved'])],
                    'options'=>[
                        'pluginOptions'=>['format'=>'yyyy-mm-dd hh:MM:ss']
                    ]
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
                        'formOptions' => ['action' => Url::to(['itprojects/estatus'])],
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
            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Abrir</span>',
                            Url::to(['/itincidentsreports/admin', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Abrir Reporte'),
                            ]);
                    },
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
