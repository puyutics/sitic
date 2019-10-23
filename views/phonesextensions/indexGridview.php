<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhonesExtensionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="phones-extensions-index">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'EXTENSION',
                'attribute'=>'extension',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['phonesextensions/eextension'])],
                ],
            ],

            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DETALLE',
                'attribute'=>'description',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXTAREA,
                    'formOptions' => ['action' => Url::to(['phonesextensions/edescription'])],
                ],
            ],

            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DIRECCION IP V4',
                'attribute'=>'ipv4_address',
                'editableOptions'=>[
                    'size' => 'md',
                    'inputType' => Editable::INPUT_TEXT,
                    'formOptions' => ['action' => Url::to(['phonesextensions/eipv4address'])],
                ],
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'DEPARTAMENTO',
                'attribute'=>'department_id',
                'value'=>'department.department',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['phonesextensions/edepartmentid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\Department::find()->all(),
                                'id', 'department'),
                        ]
                    ];
                },
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'label'=>'ITEM',
                'attribute'=>'inv_purchase_item_id',
                'value'=>'invPurchaseItem.description',
                'editableOptions' => function() {
                    return [
                        'inputType' => Editable::INPUT_SELECT2,
                        'size' => 'md',
                        'formOptions' => ['action' => Url::to(['phonesextensions/einvpurchaseitemid'])],
                        'options' => [
                            'data' => ArrayHelper::map(\app\models\InvPurchaseItem::find()->all(),
                                'id', 'description'),
                        ]
                    ];
                },
            ],
            [
                'label'=>'USUARIO',
                'attribute' => 'username',
                'value'=>function($model){
                    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', $model->username);
                    if (isset($user)) {
                        return $user->getAttribute('cn',0);
                    } else {
                        return "-";
                    }
                },
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>', $url, [
                            'title' => Yii::t('yii', 'Editar Extension'),
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
                        'title' => ('Agregar Extensión')
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
