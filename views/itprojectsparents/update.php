<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsParents */

$this->title = Yii::t('app', 'Editar relación Proyecto/Proyecto: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relaciones Proyectos/Proyectos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-projects-parents-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
