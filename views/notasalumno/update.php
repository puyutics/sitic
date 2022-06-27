<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotasAlumno */

$this->title = 'Update Notas Alumno: ' . $model->idnaa;
$this->params['breadcrumbs'][] = ['label' => 'Notas Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idnaa, 'url' => ['view', 'id' => $model->idnaa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notas-alumno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
