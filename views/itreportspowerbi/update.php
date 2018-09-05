<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItReportsPowerbi */

$this->title = Yii::t('app', 'Editar Reporte (Power BI): {nameAttribute}', [
    'nameAttribute' => $model->description,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reporte (Power BI)'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-reports-powerbi-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
