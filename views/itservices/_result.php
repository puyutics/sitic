<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItServicesResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="it-services-result-index">

    <?php Pjax::begin(); ?>

    <?php
    $searchModelProjectsServices = new \app\models\ItServicesResultSearch();
    $searchModelProjectsServices->it_services_id = $model->id;
    $dataProviderProjectsServices = $searchModelProjectsServices->search(Yii::$app->request->queryParams);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderProjectsServices,
        //'filterModel' => $searchModelProjectsServices,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'it_services_id',
            //'date',

            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'AÑO',
                'attribute'=>'year',
                'editableOptions'=>[
                    'inputType' => Editable::INPUT_DATE,
                    'formOptions' => ['action' => Url::to(['itservicesresult/eyear'])],
                    'options'=>[
                        'pluginOptions'=>['format'=>'yyyy']
                    ]
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'description',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['itservicesresult/edescription'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'date',
                'editableOptions'=>[
                    'inputType' => Editable::INPUT_DATE,
                    'formOptions' => ['action' => Url::to(['itservicesresult/edate'])],
                    'options'=>[
                        'pluginOptions'=>['format'=>'yyyy-mm-dd hh:MM:ss']
                    ]
                ],
            ],
            'username',
            /*[
                'label'=>'USUARIO',
                'attribute' => 'username',
                'value'=>function($model){
                    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', $model->username);
                    return $user->getAttribute('cn',0);
                },
            ],*/
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'percent',
                'format'=>['decimal', 2],
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['itservicesresult/epercent'])],
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

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{edit}',
                'buttons'=>[
                    'edit' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>',
                            Url::to(['/itservicesresult/update', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Editar Resultado'),
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
                        ['itservicesresult/create', 'it_services_id' => $model->id], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Resultado')
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
