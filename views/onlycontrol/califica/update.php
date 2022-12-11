<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Califica */

$this->title = 'Update Califica: ' . $model->CALI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Calificas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CALI_ID, 'url' => ['view', 'CALI_ID' => $model->CALI_ID, 'CALI_NOM' => $model->CALI_NOM]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="califica-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
