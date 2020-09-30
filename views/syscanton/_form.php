<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysCanton */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-canton-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sys_provincia_id')->textInput() ?>

    <?= $form->field($model, 'canton')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
