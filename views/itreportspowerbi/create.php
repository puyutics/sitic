<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItReportsPowerbi */

$this->title = Yii::t('app', 'Agregar Reporte (Power BI)');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes (Power BI)'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-reports-powerbi-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
