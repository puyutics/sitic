<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_nivelacion\EstudiantesNivelacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudiantes-nivelacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mailPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mailInst')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
