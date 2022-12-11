<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AuxNomina */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aux-nomina-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ANOM_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_APE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_CED')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_EMP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_AREA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_DPTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_CAR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_FECN')->textInput() ?>

    <?= $form->field($model, 'ANOM_OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ANOM_TIPO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
