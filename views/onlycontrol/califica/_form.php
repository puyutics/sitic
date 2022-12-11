<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Califica */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="califica-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CALI_NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CALI_DES')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
