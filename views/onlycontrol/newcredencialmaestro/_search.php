<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencialMaestroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="new-credencial-maestro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CR_ID') ?>

    <?= $form->field($model, 'CR_DES') ?>

    <?= $form->field($model, 'CR_IMG') ?>

    <?= $form->field($model, 'CR_FIRMA') ?>

    <?= $form->field($model, 'CR_FOTO') ?>

    <?php // echo $form->field($model, 'CR_TIPO') ?>

    <?php // echo $form->field($model, 'CR_FOTOF') ?>

    <?php // echo $form->field($model, 'CR_CBARRA') ?>

    <?php // echo $form->field($model, 'CR_UCREA') ?>

    <?php // echo $form->field($model, 'CR_FCREA') ?>

    <?php // echo $form->field($model, 'CR_UserRI') ?>

    <?php // echo $form->field($model, 'CR_ClaveRI') ?>

    <?php // echo $form->field($model, 'CR_IMGATRAS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
