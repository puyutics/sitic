<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InvItemUser */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asignar Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-item-user-view">

    <h1><?php //Html::encode($this->title) ?></h1>

    <p>
        <?php //= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            /*[
                'attribute' => 'username',
                'value'=>call_user_func(function($model){
                    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', $model->username);
                    return $user->getAttribute('cn',0);
                },$model),
            ],*/
            [
                'label'=>'DETALLE BIEN',
                'attribute'=>'inv_purchase_item_id',
                'value'=>call_user_func(function($model){
                    return \app\models\InvPurchaseItem::findOne($model->inv_purchase_item_id)->description;
                },$model),
            ],
            'date_asigned',
            'date_released',
            'description:ntext',
            [
                'attribute' => 'status',
                'value'=>call_user_func(function($model){
                    if ($model->status == '0') {
                        return "INACTIVO";
                    };
                    if ($model->status == '1') {
                        return "ACTIVO";
                    };
                },$model),
            ],
        ],
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            //'heading'=>$model->username,
            'headingOptions'=>[
                //'template'=>'{buttons}{title}',
                'template'=>'{title}',
            ],
            'type'=>DetailView::TYPE_PRIMARY,
        ],

    ]) ?>

</div>
