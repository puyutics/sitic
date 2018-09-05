<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItProjectsServices */

$this->title = Yii::t('app', 'Agregar Relación Proyecto/Servicio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relaciones Proyectos/Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-services-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
