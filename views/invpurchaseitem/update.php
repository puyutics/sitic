<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InvPurchaseItem */

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => $model->description,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="inv-purchase-item-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
