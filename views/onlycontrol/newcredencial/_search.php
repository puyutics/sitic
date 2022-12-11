<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencialSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="new-credencial-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CR_ID') ?>

    <?= $form->field($model, 'CR_FIMPRESION') ?>

    <?= $form->field($model, 'CR_RESULTADO') ?>

    <?= $form->field($model, 'CR_CEDULA') ?>

    <?= $form->field($model, 'CR_CIUDADANO') ?>

    <?php // echo $form->field($model, 'CR_FCADUDA') ?>

    <?php // echo $form->field($model, 'CR_UIMPRIME') ?>

    <?php // echo $form->field($model, 'CR_AAUTORIZA') ?>

    <?php // echo $form->field($model, 'CR_FAUTORIZA') ?>

    <?php // echo $form->field($model, 'CR_TARJETA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
