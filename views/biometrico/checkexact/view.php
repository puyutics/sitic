<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\biometrico\CheckExact */

$this->title = $model->EXACTID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check Exacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="check-exact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->EXACTID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->EXACTID], [
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
            'EXACTID',
            'USERID',
            'CHECKTIME',
            'CHECKTYPE',
            'ISADD',
            'YUYIN',
            'ISMODIFY',
            'ISDELETE',
            'INCOUNT',
            'ISCOUNT',
            'MODIFYBY',
            'DATE',
        ],
    ]) ?>

</div>
