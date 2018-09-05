<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItIncidentsReports */

$this->title = Yii::t('app', 'Agregar Reporte de Incidente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes de Incidentes de Servicos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-incidents-reports-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
