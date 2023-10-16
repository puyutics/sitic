<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\Asistnow */

$this->title = 'Update Asistnow: ' . $model->ASIS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Asistnows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ASIS_ID, 'url' => ['view', 'ASIS_ID' => $model->ASIS_ID, 'ASIS_ING' => $model->ASIS_ING, 'ASIS_ZONA' => $model->ASIS_ZONA]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asistnow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
