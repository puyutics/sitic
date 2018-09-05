<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsStages */

$this->title = Yii::t('app', 'Agregar Etapa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etapas Proyectos TI'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-stages-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
