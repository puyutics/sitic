<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvModelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="inv-models-index">

    <?php Pjax::begin(); ?>

    <div align="center">
        <h3>Modelos</h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'FABRICANTE',
                'attribute'=>'inv_manufacturers_id',
                'value' => 'invManufacturers.manufacturer',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'formOptions' => ['action' => Url::to(['invmodels/einvmanufacturersid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\InvManufacturers::find()->all(), 'id', 'manufacturer'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvManufacturers::find()->all(), 'id', 'manufacturer'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar fabricante'],
                'format'=>'raw',
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'MODELO',
                'attribute'=>'model',
                'editableOptions'=>[
                    'size' => 'sm',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['invmodels/emodel'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'consumables',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['invmodels/econsumables'])],
                ],
            ],

            //['class' => 'kartik\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>',
                            Url::to(['invmodels/update', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Editar Modelo'),
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
                        ['invmodels/create'], [
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
