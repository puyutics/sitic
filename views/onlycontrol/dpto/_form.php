<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Dpto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dpto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DEP_ARE')->textInput() ?>

    <?= $form->field($model, 'DEP_NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DEP_DESC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DEP_OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DEP_EM')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
