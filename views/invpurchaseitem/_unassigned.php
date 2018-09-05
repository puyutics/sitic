<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvPurchaseItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="inv-purchase-item-indexUnassigned">

    <?php
    $searchModelItemsUnassigned = new \app\models\InvItemsUnassignedSearch();
    $dataProviderItemsUnassigned = $searchModelItemsUnassigned->search(Yii::$app->request->queryParams);
    ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div align="center">
        <h3>Bienes TI (Sin asignar)</h3>
    </div>

    <p>
        <?php //= Html::a(Yii::t('app', 'Agregar Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderItemsUnassigned,
        'filterModel' => $searchModelItemsUnassigned,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'COMPRA',
                'attribute'=>'inv_purchase_id',
                'value' => 'invPurchase.code',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvPurchase::find()->all(), 'id', 'code'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar compra'],
                'format'=>'raw',
            ],
            [
                'label'=>'DETALLE BIEN',
                'attribute'=>'description',
            ],
            [
                'label'=>'MODELO',
                'attribute'=>'inv_models_id',
                'value' => 'invModels.model',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvModels::find()->all(), 'id', 'model'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar modelo'],
                'format'=>'raw',
            ],
            'serial_number',
            [
                'label'=>'COD.',
                'attribute'=>'control_code',
            ],
            [
                'label'=>'PRECIO',
                'attribute'=>'amount',
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{transfer}',
                'buttons'=>[
                    'transfer' => function ($url, $model) {
                        return Html::a('<span class="btn btn-warning center-block">Asignar</span>',
                            Url::to(['/invpurchaseitem/view', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Asignar Bien'),
                            ]);
                    }
                ]
            ],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Compra</span>',
                            Url::to(['invpurchase/admin', 'id' => $model->inv_purchase_id]), [
                                'title' => Yii::t('yii', 'Abrir Compra'),
                            ]);
                    },
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
