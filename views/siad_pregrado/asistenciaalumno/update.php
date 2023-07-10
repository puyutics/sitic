<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\AsistenciaAlumno */

$this->title = 'Update Asistencia Alumno: ' . $model->id_asist;
$this->params['breadcrumbs'][] = ['label' => 'Asistencia Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_asist, 'url' => ['view', 'id' => $model->id_asist]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asistencia-alumno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
