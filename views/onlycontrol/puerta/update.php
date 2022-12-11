<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Puerta */

$this->title = 'Update Puerta: ' . $model->PRT_COD;
$this->params['breadcrumbs'][] = ['label' => 'Puertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PRT_COD, 'url' => ['view', 'id' => $model->PRT_COD]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="puerta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
