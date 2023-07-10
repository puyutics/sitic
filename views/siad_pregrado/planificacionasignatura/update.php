<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\PlanificacionAsignatura */

$this->title = 'Update Planificacion Asignatura: ' . $model->id_plasig;
$this->params['breadcrumbs'][] = ['label' => 'Planificacion Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_plasig, 'url' => ['view', 'id' => $model->id_plasig]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="planificacion-asignatura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
