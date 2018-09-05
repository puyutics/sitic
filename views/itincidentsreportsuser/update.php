<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItIncidentsReportsUser */

$this->title = Yii::t('app', 'Actualizar Usuario: {nameAttribute}', [
    'nameAttribute' => $model->username,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios relacionados a Reportes de Incidentes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="it-incidents-reports-user-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
