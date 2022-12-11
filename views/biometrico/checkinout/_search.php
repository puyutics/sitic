<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\biometrico\CheckInOutSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-in-out-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'USERID') ?>

    <?= $form->field($model, 'CHECKTIME') ?>

    <?= $form->field($model, 'CHECKTYPE') ?>

    <?= $form->field($model, 'VERIFYCODE') ?>

    <?= $form->field($model, 'SENSORID') ?>

    <?php // echo $form->field($model, 'Memoinfo') ?>

    <?php // echo $form->field($model, 'WorkCode') ?>

    <?php // echo $form->field($model, 'sn') ?>

    <?php // echo $form->field($model, 'UserExtFmt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
