<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TipoPermisoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-permiso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'TIPO_ID') ?>

    <?= $form->field($model, 'TIPO_NOM') ?>

    <?= $form->field($model, 'TIPO_COD_N') ?>

    <?= $form->field($model, 'TIPO_COD_A') ?>

    <?= $form->field($model, 'TIPO_FACE') ?>

    <?php // echo $form->field($model, 'TIPO_IRIS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
