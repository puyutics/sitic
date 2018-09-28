<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItLicensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="it-licenses-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'attribute'=>'inv_manufacturers_id',
                'value'=>'invManufacturers.manufacturer',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itapps/einvmanufacturersid'])],
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
                'format'=>'raw'
            ],
            'license',
            'description:ntext',
            'serial_number',
            'valid_since',
            'valid_until',
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
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                        'class' => 'btn btn-success',
                        'title' => ('Agregar Aplicación')
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
