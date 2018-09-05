<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItServicesResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Resultados (Servicios)');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-services-result-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Create It Services Result'), ['create'], ['class' => 'btn btn-success']) ?>
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
            //'it_services_id',
            //'date',
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'SERVICIO',
                'attribute'=>'it_services_id',
                'value'=>'itServices.service',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itservicesresult/eitservicesid'])],
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
                    'inputType' => Editable::INPUT_DATETIME,
                    'formOptions' => ['action' => Url::to(['itservicesresult/edate'])],
                    'options'=>[
                        'pluginOptions'=>['format'=>'yyyy-mm-dd hh:MM:ss']
                    ]
                ],
            ],
            [
                'label'=>'USUARIO',
                'attribute' => 'username',
                'value'=>function($model){
                    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', $model->username);
                    return $user->getAttribute('cn',0);
                },
            ],
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
