<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CheckInOut */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-in-out-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USERID')->textInput() ?>

    <?= $form->field($model, 'CHECKTIME')->textInput() ?>

    <?= $form->field($model, 'CHECKTYPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VERIFYCODE')->textInput() ?>

    <?= $form->field($model, 'SENSORID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Memoinfo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WorkCode')->textInput() ?>

    <?= $form->field($model, 'sn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UserExtFmt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
