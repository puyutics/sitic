<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencialMaestro */

$this->title = 'Update New Credencial Maestro: ' . $model->CR_ID;
$this->params['breadcrumbs'][] = ['label' => 'New Credencial Maestros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CR_ID, 'url' => ['view', 'id' => $model->CR_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="new-credencial-maestro-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
