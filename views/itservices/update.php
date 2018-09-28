<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ItServices */

$this->title = Yii::t('app', 'Editar Servicio: {nameAttribute}', [
    'nameAttribute' => $model->service,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->service, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="it-services-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
