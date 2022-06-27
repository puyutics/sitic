<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotasAlumno */

$this->title = 'Create Notas Alumno';
$this->params['breadcrumbs'][] = ['label' => 'Notas Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notas-alumno-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
