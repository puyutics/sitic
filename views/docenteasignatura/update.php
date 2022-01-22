<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocenteAsignatura */

$this->title = 'Update Docente Asignatura: ' . $model->dpa_id;
$this->params['breadcrumbs'][] = ['label' => 'Docente Asignaturas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dpa_id, 'url' => ['view', 'id' => $model->dpa_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="docente-asignatura-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
