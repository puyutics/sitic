<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Externoe */

$this->title = 'Update Externoe: ' . $model->EMPE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Externoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->EMPE_ID, 'url' => ['view', 'id' => $model->EMPE_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="externoe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
