<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Printers */

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => $model->printer,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Impresoras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->printer, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="printers-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
