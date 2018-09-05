<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvItemUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Asignar Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-item-user-index">

    <h1><?php //Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Asignar item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'label'=>'BIEN',
                'attribute'=>'inv_purchase_item_id',
                'value' => 'invPurchaseItem.description',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\InvPurchaseItem::find()->all(), 'id', 'description'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar compra'],
                'format'=>'raw',
            ],
            [
                'label'=>'DET. ASIGNACION',
                'attribute'=>'description',
            ],
            [
                'label'=>'FEC. ASIG.',
                'attribute'=>'date_asigned',
            ],
            [
                'label'=>'FEC. FIN',
                'attribute'=>'date_released',
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
                'label'=>'ESTADO',
                'attribute'=>'status',
                'value' =>function($model){
                    if ($model->status = 0) {
                        return 'INACTIVO';
                    }
                    if ($model->status = 1) {
                        return 'ACTIVO';
                    }

                },
                'filter'=>['0'=>'INACTIVO','1'=>'ACTIVO'],
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Url::to(['invitemuser/update', 'id' => $model->id]), [
                                'title' => Yii::t('yii', 'Asignar Bien'),
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
