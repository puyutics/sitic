<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\PuertaSta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puerta-sta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'P_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'P_Fecha')->textInput() ?>

    <?= $form->field($model, 'P_Status')->textInput() ?>

    <?= $form->field($model, 'P_User')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'P_Maq')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
