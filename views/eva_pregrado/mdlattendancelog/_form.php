<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendanceLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdl-attendance-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sessionid')->textInput() ?>

    <?= $form->field($model, 'studentid')->textInput() ?>

    <?= $form->field($model, 'statusid')->textInput() ?>

    <?= $form->field($model, 'statusset')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timetaken')->textInput() ?>

    <?= $form->field($model, 'takenby')->textInput() ?>

    <?= $form->field($model, 'remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ipaddress')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
