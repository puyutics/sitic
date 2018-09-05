<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItProjectsStagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="it-projects-stages-index">

    <?php Pjax::begin(); ?>

    <?php
    $searchModelStages = new \app\models\ItProjectsStagesSearch();
    $searchModelStages->it_projects_id = $model->id;
    $dataProviderStages = $searchModelStages->search(Yii::$app->request->queryParams);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderStages,
        //'filterModel' => $searchModelStages,
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
            ],
            [
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
                'class' => \yiister\grid\widgets\ProgressColumn::className(),
                'attribute' => 'percent',
                'size' => \yiister\grid\widgets\ProgressColumn::SIZE_LARGE,
                'isStriped' => true,
                'isAnimated' => true,
                'showText' => true,
                'percent' => true,
                'minValue'=> 0,
                'maxValue' => 100,
                'progressBarClass' => function ($model, $column) {
                    if ($model->{$column->attribute} >= 99.50) {
                        return \yiister\grid\widgets\ProgressColumn::STYLE_SUCCESS;
                    }
                    if ($model->{$column->attribute} >= 50) {
                        return \yiister\grid\widgets\ProgressColumn::STYLE_WARNING;
                    }
                    if ($model->{$column->attribute} < 50) {
                        return \yiister\grid\widgets\ProgressColumn::STYLE_DANGER;
                    }

                },
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{edit}',
                'buttons'=>[
                    'edit' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>',
                            Url::to(['/itprojectsstages/update', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Editar Relación'),
                            ]);
                    }
                ]
            ],

        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        ['itprojectsstages/create', 'it_projects_id' => $model->id], [
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
