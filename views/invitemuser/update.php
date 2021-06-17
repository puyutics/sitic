<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InvItemUser */

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => $model->username,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Asignar Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="inv-item-user-update">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
