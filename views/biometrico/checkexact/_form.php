<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\biometrico\CheckExact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-exact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'EXACTID')->textInput() ?>

    <?= $form->field($model, 'USERID')->textInput() ?>

    <?= $form->field($model, 'CHECKTIME')->textInput() ?>

    <?= $form->field($model, 'CHECKTYPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISADD')->textInput() ?>

    <?= $form->field($model, 'YUYIN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ISMODIFY')->textInput() ?>

    <?= $form->field($model, 'ISDELETE')->textInput() ?>

    <?= $form->field($model, 'INCOUNT')->textInput() ?>

    <?= $form->field($model, 'ISCOUNT')->textInput() ?>

    <?= $form->field($model, 'MODIFYBY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DATE')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
