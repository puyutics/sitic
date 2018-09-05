<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItIncidentsReports */

$this->title = Yii::t('app', 'Reporte: {nameAttribute}', [
    'nameAttribute' => $model->subject,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes Incidentes TI'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subject, 'url' => ['admin', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-incidents-reports-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
