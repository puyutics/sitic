<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuertaDel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nom-puerta-del-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PUER_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FLAG_T')->textInput() ?>

    <?= $form->field($model, 'TURN_ESTADO_DEL')->textInput() ?>

    <?= $form->field($model, 'TURN_FECHA_DEL')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
