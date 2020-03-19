<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CheckInOut */

$this->title = Yii::t('app', 'Update Check In Out: {name}', [
    'name' => $model->USERID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check In Outs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->USERID, 'url' => ['view', 'USERID' => $model->USERID, 'CHECKTIME' => $model->CHECKTIME]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="check-in-out-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
