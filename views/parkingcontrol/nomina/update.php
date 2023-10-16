<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\Nomina */

$this->title = 'Editar Vehículo: ' . $model->NOMINA_PLACA;
$this->params['breadcrumbs'][] = ['label' => 'Nominas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NOMINA_ID, 'url' => ['view', 'id' => $model->NOMINA_ID]];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="nomina-update">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
