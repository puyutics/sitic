<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItProcesses */

$this->title = Yii::t('app', 'Editar Proceso: {nameAttribute}', [
    'nameAttribute' => $model->process,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Procesos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->process, 'url' => ['admin', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-processes-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
