<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\InvModels */

$this->title = $model->model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modelos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-models-view">

    <h1><?php //Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Está seguro que desea eliminar este item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'model',
            'consumables:ntext',
            'inv_manufacturers_id',
        ],
    ]) ?>

</div>
