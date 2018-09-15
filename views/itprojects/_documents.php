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

?>
<div class="documents-index">

    <?php //Pjax::begin(); ?>

    <?php
    $searchModelDocs = new \app\models\DocumentsSearch();
    $searchModelDocs->external_id = $model->id;
    $searchModelDocs->external_type = 'itProjects';
    $dataProviderDocs = $searchModelDocs->search(Yii::$app->request->queryParams);
    ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Agregar Documento'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderDocs,
        'filterModel' => $searchModelDocs,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'filename',
            //'filetype',
            //'external_id',
            //'external_type',


            /*[
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DOCUMENTO',
                'attribute'=>'filename',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['documents/efilname'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'TIPO',
                'attribute'=>'filetype',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['documents/efiletype'])],
                ],
            ],*/
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

            [
                'attribute' => 'pdf',
                'label' => 'PDF',
                'format' => 'raw',
                'value' => function($model) {
                    $basepath = str_replace('\\', '/', Yii::$app->basePath) . '/web/';
                    $path = str_replace($basepath, '', 'uploads/documents/' . $model->filename . '.' . $model->filetype);
                    //return Html::a('Abrir', $path, array('target' => '_blank'));
                    return Html::a('Abrir', $path,[
                            'class' => 'btn btn-danger center-block',
                            'target'=>'_blank',
                            'data-pjax'=>"0",
                        ]
                );

                }
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>',
                            Url::to(['documents/update',
                                'id' => $model->id
                            ]),
                            ['title' => Yii::t('yii', 'Editar Documento')]);
                    },
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],

        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        [
                            'documents/create',
                            'external_id' => $model->id,
                            'external_type' => 'itProjects',], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Documento')
                        ]
                    ),
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
    <?php //Pjax::end(); ?>
</div>
