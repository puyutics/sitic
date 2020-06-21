<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysProvincia */

$this->title = 'Update Sys Provincia: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Provincias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sys-provincia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
