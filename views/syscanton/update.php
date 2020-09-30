<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysCanton */

$this->title = 'Update Sys Canton: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Cantons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sys-canton-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
