<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BecasConectividad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="becas-conectividad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cel_contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuenta_dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuenta_numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuenta_titular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuenta_tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuenta_institucion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siad_matriculado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siad_semestre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siad_carrera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ficha_escasos_recursos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
