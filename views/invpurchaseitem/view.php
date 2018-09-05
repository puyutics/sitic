<?php

use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InvPurchaseItem */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bienes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-purchase-item-view">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'description:ntext',
            'amount',
            'control_code',
            [
                'attribute' => 'inv_models_id',
                'value' => $model->invModels->model,
            ],
            'serial_number',
            [
                'attribute' => 'inv_purchase_id',
                'value' => $model->invPurchase->code,
            ],
        ],
        'bordered' => true,
        'condensed'=>true,
        'enableEditMode'=>false,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'type'=>DetailView::TYPE_PRIMARY,
        ],
    ]) ?>

    <p>
        <?= Html::a('Agregar Asignación',
            ['invitemuser/create', 'inv_purchase_item_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('Regresar Compra',
            ['invpurchase/admin', 'id' => $model->inv_purchase_id],
            [
                'class' => 'btn btn-primary grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
    </p>

    <?= $this->render('_items_users', [
        'model' => $model,
    ]) ?>

    <?php Pjax::end(); ?>

</div>
