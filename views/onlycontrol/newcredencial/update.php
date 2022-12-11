<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencial */

$this->title = 'Update New Credencial: ' . $model->CR_FIMPRESION;
$this->params['breadcrumbs'][] = ['label' => 'New Credencials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CR_FIMPRESION, 'url' => ['view', 'CR_FIMPRESION' => $model->CR_FIMPRESION, 'CR_ID' => $model->CR_ID, 'CR_RESULTADO' => $model->CR_RESULTADO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="new-credencial-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
