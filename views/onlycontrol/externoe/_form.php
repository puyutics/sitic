<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Externoe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="externoe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EMPE_NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_DIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_RUC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_REP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_TELF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_FAX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_WEB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_CONT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMPE_CODE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
