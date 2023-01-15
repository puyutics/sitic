<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\PuertaSta */

$this->title = 'Update Puerta Sta: ' . $model->P_Fecha;
$this->params['breadcrumbs'][] = ['label' => 'Puerta Stas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->P_Fecha, 'url' => ['view', 'P_Fecha' => $model->P_Fecha, 'P_ID' => $model->P_ID, 'P_User' => $model->P_User]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="puerta-sta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
