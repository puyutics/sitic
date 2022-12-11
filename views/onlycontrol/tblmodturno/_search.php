<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblmodTurnoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblmod-turno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'MOD_ID') ?>

    <?= $form->field($model, 'MOD_DES') ?>

    <?= $form->field($model, 'MOD_LUNES') ?>

    <?= $form->field($model, 'MOD_MARTES') ?>

    <?= $form->field($model, 'MOD_MIERCOLES') ?>

    <?php // echo $form->field($model, 'MOD_JUEVES') ?>

    <?php // echo $form->field($model, 'MOD_VIERNES') ?>

    <?php // echo $form->field($model, 'MOD_SABADO') ?>

    <?php // echo $form->field($model, 'MOD_DOMINGO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
