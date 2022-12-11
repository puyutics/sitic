<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonamarcaje */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-zonamarcaje-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ZM_DES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ZM_SEL')->textInput() ?>

    <?= $form->field($model, 'ZM_EMPE')->textInput() ?>

    <?= $form->field($model, 'ZM_EMPE_NOM')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
