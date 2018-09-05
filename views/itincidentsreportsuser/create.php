<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ItIncidentsReportsUser */

$this->title = Yii::t('app', 'Agregar Usuario a Reporte de Incidente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios Relacionados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-incidents-reports-user-create">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
