<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TipoPermiso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-permiso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'TIPO_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIPO_NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIPO_COD_N')->textInput() ?>

    <?= $form->field($model, 'TIPO_COD_A')->textInput() ?>

    <?= $form->field($model, 'TIPO_FACE')->textInput() ?>

    <?= $form->field($model, 'TIPO_IRIS')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
