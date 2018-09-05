<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InvManufacturers */

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => $model->manufacturer,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fabricantes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->manufacturer, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="inv-manufacturers-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
