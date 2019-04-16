<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documentación TI');
$this->params['breadcrumbs'][] = $this->title;

$dataProvider->sort->defaultOrder = [
    'date' => SORT_DESC,
];
?>
<div class="documents-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Agregar Documento'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div align="center">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'description',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['documents/edescription'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'date',
                'editableOptions'=>[
                    'inputType' => Editable::INPUT_DATE,
                    'formOptions' => ['action' => Url::to(['documents/edate'])],
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
                'label'=>'ESTADO',
                'attribute'=>'status',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_DROPDOWN_LIST,
                        'size' => 'sm',
                        'formOptions' => ['action' => Url::to(['documents/estatus'])],
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

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{pdf}',
                'buttons'=>[
                    'pdf' => function ($url, $model) {
                        $basepath = str_replace('\\', '/', Yii::$app->basePath) . '/web/';
                        $path = str_replace($basepath, '', 'uploads/documents/' . $model->filename . '.' . $model->filetype);
                        //return Html::a('Abrir', $path, array('target' => '_blank'));
                        return Html::a('<i class="fa fa-fw fa-file"></i> PDF', $path,[
                                'class' => 'btn btn-danger center-block',
                                'target'=>'_blank',
                                'data-pjax'=>"0",
                            ]
                        );
                    },
                ]
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                            return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i>Detalles</span>',
                            Url::to(['documents/view',
                                'id' => $model->id
                            ]),
                            ['title' => Yii::t('yii', 'Editar Documento')]);
                    },
                ]
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block"><i class="fa fa-fw fa-folder"></i>Origen</span>',
                            Url::to([strtolower($model->external_type) . '/admin', 'id' => $model->external_id]),
                            ['title' => Yii::t('yii', 'Abrir Origen')]);
                    },
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    /*Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                        'class' => 'btn btn-success',
                        'title' => ('Agregar Documento')
                    ]),*/
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
