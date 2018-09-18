<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PhonesExtensions */

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => $model->extension,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Extensiones Telefónicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->extension, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="phones-extensions-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
