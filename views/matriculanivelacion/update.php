<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MatriculaNivelacion */

$this->title = 'Update Matricula Nivelacion: ' . $model->idMatricula;
$this->params['breadcrumbs'][] = ['label' => 'Matricula Nivelacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMatricula, 'url' => ['view', 'id' => $model->idMatricula]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="matricula-nivelacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
