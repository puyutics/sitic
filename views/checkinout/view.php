<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CheckInOut */

$this->title = $model->USERID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check In Outs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="check-in-out-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'USERID' => $model->USERID, 'CHECKTIME' => $model->CHECKTIME], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'USERID' => $model->USERID, 'CHECKTIME' => $model->CHECKTIME], [
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
            'USERID',
            'CHECKTIME',
            'CHECKTYPE',
            'VERIFYCODE',
            'SENSORID',
            'Memoinfo',
            'WorkCode',
            'sn',
            'UserExtFmt',
        ],
    ]) ?>

</div>
