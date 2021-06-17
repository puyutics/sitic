<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\InvPurchase */
/* @var $searchModel app\models\InvItemUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="inv-item-user-index">

    <?php Pjax::begin(); ?>

    <?php
    $searchModelItemsAssigned = new \app\models\InvItemsAssignedSearch();
    $searchModelItemsAssigned->inv_purchase_id = $model->id;
    $dataProviderItemsAssigned = $searchModelItemsAssigned->search(Yii::$app->request->queryParams);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderItemsAssigned,
        'filterModel' => $searchModelItemsAssigned,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'label'=>'DETALLE BIEN',
                'attribute'=>'inv_purchase_item_id',
                'value' => 'invPurchaseItem.description',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvPurchaseItem::find()->all(), 'id', 'description'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar bien'],
                'format'=>'raw',
            ],
            [
                'label'=>'SERIE',
                'attribute'=>'inv_purchase_item_id',
                'value' => 'invPurchaseItem.serial_number',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvPurchaseItem::find()->all(), 'id', 'serial_number'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar bien'],
                'format'=>'raw',
            ],
            'description',
            'date_asigned',
            //'date_released',
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
                'label'=>'ESTADO',
                'attribute'=>'status',
                'value' =>function($model){
                    if ($model->status == 0) {
                        return 'INACTIVO';
                    }
                    if ($model->status == 1) {
                        return 'ACTIVO';
                    }

                },
                'filter'=>['0'=>'INACTIVO','1'=>'ACTIVO'],
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">Editar</span>',
                            Url::to(['invitemuser/update', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Editar Asignación'),
                            ]);
                    }
                ]
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{transfer}',
                'buttons'=>[
                    'transfer' => function ($url, $model) {
                        return Html::a('<span class="btn btn-warning center-block">Re-Asignar</span>',
                            Url::to(['/invpurchaseitem/view', 'id' => $model->inv_purchase_item_id]), [
                                'title' => Yii::t('yii', 'Re-Asignar Bien'),
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
