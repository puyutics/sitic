<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItProjectsParentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Proyectos Relacionados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-parents-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Agregar Proyecto Relacionado'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'it_projects_id',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itprojectsparents/eitprojectsid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\ItProjects::find()->all(), 'id', 'project'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\ItProjects::find()->all(), 'id', 'project'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar proyecto'],
                'format'=>'raw'
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'parent_id',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itprojectsparents/eparentid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\ItProjects::find()->all(), 'id', 'project'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\ItProjects::find()->all(), 'id', 'project'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar proyecto'],
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
                        'formOptions' => ['action' => Url::to(['itprojectsparents/estatus'])],
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
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
