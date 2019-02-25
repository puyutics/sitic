<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItAppsCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="it-apps-category-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Crear Categorías'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div align="center">
        <h3><?= Html::encode('Categorías') ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'category',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['itapps/ecategory'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'parent_id',
                'label' => 'CATEGORIA PADRE',
                'value'=>'parent.category',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itapps/eparentid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\ItAppsCategory::find()->all(), 'id', 'category'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\ItAppsCategory::find()->all(), 'id', 'category'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar categoría padre'],
                'format'=>'raw'
            ],
            'level',
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'ESTADO',
                'attribute'=>'status',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['itapps/estatus'])],
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
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>',
                            Url::to(['itappscategory/update',
                                'id' => $model->id
                            ]),
                            ['title' => Yii::t('yii', 'Editar Aplicación')]);
                    },
                ]
            ],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        ['itappscategory/create'], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Categoría')
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
