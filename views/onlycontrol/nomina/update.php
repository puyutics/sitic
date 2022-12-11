<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Nomina */

$this->title = 'Update Nomina: ' . $model->NOMINA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Nominas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NOMINA_ID, 'url' => ['view', 'id' => $model->NOMINA_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nomina-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
