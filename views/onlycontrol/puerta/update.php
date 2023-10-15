<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Puerta */

$this->title = 'Editar Puerta: ' . $model->PRT_COD;
$this->params['breadcrumbs'][] = ['label' => 'Puertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PRT_COD, 'url' => ['view', 'id' => $model->PRT_COD]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="puerta-update">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
