<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItProjectsStagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Etapas Proyectos TI');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-stages-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Agregar Etapa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'project_stage',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['itprojectsstages/eprojectstage'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DETALLE ETAPA',
                'attribute'=>'description',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['itprojectsstages/edescription'])],
                ],
            ],            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'PORCENTAJE',
                'attribute'=>'percent',
                'format'=>['decimal', 2],
                'editableOptions'=>[
                    'size' => 'sm',
                    'formOptions' => ['action' => Url::to(['itprojectsstages/epercent'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'PROYECTO',
                'attribute'=>'it_projects_id',
                'value' => 'itProjects.code',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'formOptions' => ['action' => Url::to(['itprojectsstages/eitprojectsid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\ItProjects::find()->all(), 'id', 'code'),
                        ]
                    ];
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\ItProjects::find()->all(), 'id', 'code'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar proyecto'],
                'format'=>'raw',
            ],

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
