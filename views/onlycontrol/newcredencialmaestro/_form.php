<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencialMaestro */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="new-credencial-maestro-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CR_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_DES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_IMG')->textInput() ?>

    <?= $form->field($model, 'CR_FIRMA')->textInput() ?>

    <?= $form->field($model, 'CR_FOTO')->textInput() ?>

    <?= $form->field($model, 'CR_TIPO')->textInput() ?>

    <?= $form->field($model, 'CR_FOTOF')->textInput() ?>

    <?= $form->field($model, 'CR_CBARRA')->textInput() ?>

    <?= $form->field($model, 'CR_UCREA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_FCREA')->textInput() ?>

    <?= $form->field($model, 'CR_UserRI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_ClaveRI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CR_IMGATRAS')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
