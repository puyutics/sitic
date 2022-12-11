<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonamarcaje */

$this->title = 'Update Tbl Zonamarcaje: ' . $model->ZM_DES;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Zonamarcajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ZM_DES, 'url' => ['view', 'id' => $model->ZM_DES]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-zonamarcaje-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
