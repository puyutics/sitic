<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AuxNomina */

$this->title = 'Update Aux Nomina: ' . $model->ANOM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Aux Nominas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ANOM_ID, 'url' => ['view', 'id' => $model->ANOM_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aux-nomina-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
