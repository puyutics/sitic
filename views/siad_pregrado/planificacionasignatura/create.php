<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\PlanificacionAsignatura */

$this->title = 'Create Planificacion Asignatura';
$this->params['breadcrumbs'][] = ['label' => 'Planificacion Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planificacion-asignatura-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
