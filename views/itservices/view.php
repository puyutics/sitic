<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ItServices */

$this->title = $model->service;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-services-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'service',
            'description:ntext',
            'type',
            'date_renovation',
            'date_creation',
            'date_closed',
            'stakeholders',
            'magnitude',
            'status',
        ],
    ]) ?>

</div>
