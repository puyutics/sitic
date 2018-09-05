<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ItProjectsUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Asignar Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-user-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Asignar Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'PROYECTO',
                'attribute'=>'it_projects_id',
                'value' => 'itProjects.code',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['itprojectsuser/eitprojectsid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\ItProjects::find()->all(),
                                'id', 'code'),
                        ]
                    ];
                },
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'description',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['itprojectsuser/edescription'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'date_asigned',
                'editableOptions'=>[
                    'inputType' => Editable::INPUT_DATE,
                    'formOptions' => ['action' => Url::to(['itprojectsuser/edateasigned'])],
                    'options'=>[
                        'pluginOptions'=>['format'=>'yyyy-mm-dd']
                    ]
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'date_released',
                'editableOptions'=>[
                    'inputType' => Editable::INPUT_DATE,
                    'formOptions' => ['action' => Url::to(['itprojectsuser/edatereleased'])],
                    'options'=>[
                        'pluginOptions'=>['format'=>'yyyy-mm-dd']
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
                'label'=>'ESTADO',
                'attribute'=>'status',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['itprojectsuser/estatus'])],
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
                'template'=>'{admin} {update}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-list"></span>',
                            Url::to(['itprojects/admin', 'id' => $model->it_projects_id]), [
                                'title' => Yii::t('yii', 'Abrir Proyecto'),
                            ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('yii', 'Editar'),
                        ]);
                    }
                ]
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
