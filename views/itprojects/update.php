<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItProjects */

$this->title = Yii::t('app', 'Update It Projects: {nameAttribute}', [
    'nameAttribute' => $model->code,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyectos TI'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['admin', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-projects-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
