<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Asistnow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistnow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ASIS_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASIS_ING')->textInput() ?>

    <?= $form->field($model, 'ASIS_ZONA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASIS_FECHA')->textInput() ?>

    <?= $form->field($model, 'ASIS_HORA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASIS_TIPO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASIS_RES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASIS_F')->textInput() ?>

    <?= $form->field($model, 'ASIS_FN')->textInput() ?>

    <?= $form->field($model, 'ASIS_HN')->textInput() ?>

    <?= $form->field($model, 'ASIS_PRINT')->textInput() ?>

    <?= $form->field($model, 'ASIS_NOVEDAD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASIS_MM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASIS_MAIL')->textInput() ?>

    <?= $form->field($model, 'ASIS_CORRIGE')->textInput() ?>

    <?= $form->field($model, 'ASIS_TEMPERATURA')->textInput() ?>

    <?= $form->field($model, 'ASIS_SIMILARIDAD')->textInput() ?>

    <?= $form->field($model, 'ASIS_EVO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ASIS_EMPRESA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
