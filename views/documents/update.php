<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Documents */

$this->title = Yii::t('app', 'Actualizar Documento: {nameAttribute}', [
    'nameAttribute' => $model->description,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->description, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="documents-update">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <h1><?php if (isset($_GET['exception'])) { print_r( $_GET['exception']); } ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
