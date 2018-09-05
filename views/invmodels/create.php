<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvModels */

$this->title = Yii::t('app', 'Agregar Modelo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modelos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-models-create">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
