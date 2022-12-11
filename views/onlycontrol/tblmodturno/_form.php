<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblmodTurno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblmod-turno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MOD_ID')->textInput() ?>

    <?= $form->field($model, 'MOD_DES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MOD_LUNES')->textInput() ?>

    <?= $form->field($model, 'MOD_MARTES')->textInput() ?>

    <?= $form->field($model, 'MOD_MIERCOLES')->textInput() ?>

    <?= $form->field($model, 'MOD_JUEVES')->textInput() ?>

    <?= $form->field($model, 'MOD_VIERNES')->textInput() ?>

    <?= $form->field($model, 'MOD_SABADO')->textInput() ?>

    <?= $form->field($model, 'MOD_DOMINGO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
