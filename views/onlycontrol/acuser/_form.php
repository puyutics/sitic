<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AcUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ac-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AC_USER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AC_P1')->textInput() ?>

    <?= $form->field($model, 'AC_P2')->textInput() ?>

    <?= $form->field($model, 'AC_P3')->textInput() ?>

    <?= $form->field($model, 'AC_P4')->textInput() ?>

    <?= $form->field($model, 'AC_P5')->textInput() ?>

    <?= $form->field($model, 'AC_P6')->textInput() ?>

    <?= $form->field($model, 'AC_P7')->textInput() ?>

    <?= $form->field($model, 'AC_P8')->textInput() ?>

    <?= $form->field($model, 'AC_P9')->textInput() ?>

    <?= $form->field($model, 'AC_P10')->textInput() ?>

    <?= $form->field($model, 'AC_P11')->textInput() ?>

    <?= $form->field($model, 'AC_P12')->textInput() ?>

    <?= $form->field($model, 'AC_P13')->textInput() ?>

    <?= $form->field($model, 'AC_P14')->textInput() ?>

    <?= $form->field($model, 'AC_P15')->textInput() ?>

    <?= $form->field($model, 'AC_P16')->textInput() ?>

    <?= $form->field($model, 'AC_P17')->textInput() ?>

    <?= $form->field($model, 'AC_P18')->textInput() ?>

    <?= $form->field($model, 'AC_P19')->textInput() ?>

    <?= $form->field($model, 'AC_P20')->textInput() ?>

    <?= $form->field($model, 'AC_UCREA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AC_FCREA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
