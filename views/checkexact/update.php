<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CheckExact */

$this->title = Yii::t('app', 'Update Check Exact: {name}', [
    'name' => $model->EXACTID,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Check Exacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EXACTID, 'url' => ['view', 'id' => $model->EXACTID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="check-exact-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
