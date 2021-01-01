<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstudiantesNivelacion */

$this->title = 'Update Estudiantes Nivelacion: ' . $model->CIInfPer;
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes Nivelacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CIInfPer, 'url' => ['view', 'id' => $model->CIInfPer]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estudiantes-nivelacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
