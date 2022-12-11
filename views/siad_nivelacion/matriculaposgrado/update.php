<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\siad_posgrado\MatriculaPosgrado */

$this->title = 'Update Matricula Posgrado: ' . $model->idMatricula;
$this->params['breadcrumbs'][] = ['label' => 'Matricula Posgrados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMatricula, 'url' => ['view', 'id' => $model->idMatricula]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="matricula-posgrado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
