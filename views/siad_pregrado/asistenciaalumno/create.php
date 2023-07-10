<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\AsistenciaAlumno */

$this->title = 'Create Asistencia Alumno';
$this->params['breadcrumbs'][] = ['label' => 'Asistencia Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistencia-alumno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
