<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonaequipo */

$this->title = 'Update Tbl Zonaequipo: ' . $model->PRT_COD;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Zonaequipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PRT_COD, 'url' => ['view', 'PRT_COD' => $model->PRT_COD, 'ZM_ID' => $model->ZM_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-zonaequipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
