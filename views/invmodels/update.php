<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InvModels */

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => $model->model,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modelos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="inv-models-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
