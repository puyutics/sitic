<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Carnetizacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carnetizacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CIInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cedula_pasaporte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoDocInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ApellInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ApellMatInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NombInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FechNacimPer')->textInput() ?>

    <?= $form->field($model, 'mailInst')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fotografia')->textInput() ?>

    <?= $form->field($model, 'idMatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idCarr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPer')->textInput() ?>

    <?= $form->field($model, 'fechfinalperlec')->textInput() ?>

    <?= $form->field($model, 'filefolder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filetype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fec_registro')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
