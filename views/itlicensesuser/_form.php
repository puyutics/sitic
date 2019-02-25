<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItLicensesUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-licenses-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'it_licenses_id')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_assigned')->textInput() ?>

    <?= $form->field($model, 'date_released')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
