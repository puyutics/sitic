<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="new-credencial-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CR_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_FIMPRESION')->textInput() ?>

    <?= $form->field($model, 'CR_RESULTADO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_CEDULA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_CIUDADANO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_FCADUDA')->textInput() ?>

    <?= $form->field($model, 'CR_UIMPRIME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_AAUTORIZA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_FAUTORIZA')->textInput() ?>

    <?= $form->field($model, 'CR_TARJETA')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
