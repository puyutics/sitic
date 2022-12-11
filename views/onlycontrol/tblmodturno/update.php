<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblmodTurno */

$this->title = 'Update Tblmod Turno: ' . $model->MOD_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tblmod Turnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MOD_ID, 'url' => ['view', 'id' => $model->MOD_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tblmod-turno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
