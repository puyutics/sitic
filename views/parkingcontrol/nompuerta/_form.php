<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\NomPuerta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nom-puerta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOM_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PUER_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TURN_ID')->textInput() ?>

    <?= $form->field($model, 'TURN_FECI')->textInput() ?>

    <?= $form->field($model, 'TURN_FECF')->textInput() ?>

    <?= $form->field($model, 'TURN_TIPO')->textInput() ?>

    <?= $form->field($model, 'TURN_STA')->textInput() ?>

    <?= $form->field($model, 'TURN_NOW')->textInput() ?>

    <?= $form->field($model, 'TURN_MARCA')->textInput() ?>

    <?= $form->field($model, 'TURN_TCOD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TURN_SEL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TURN_ESTADO_UP')->textInput() ?>

    <?= $form->field($model, 'TURN_FECHA_UP')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
