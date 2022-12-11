<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\sisges\TthhServidor */

$this->title = Yii::t('app', 'Update Tthh Servidor: {name}', [
    'name' => $model->id_documento,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tthh Servidors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_documento, 'url' => ['view', 'id' => $model->id_documento]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tthh-servidor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
