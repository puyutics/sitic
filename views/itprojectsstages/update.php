<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsStages */

$this->title = Yii::t('app', 'Actualizar Etapa: {nameAttribute}', [
    'nameAttribute' => $model->project_stage,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etapas Proyectos TI'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project_stage, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-projects-stages-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
