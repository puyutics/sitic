<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendanceLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdl-attendance-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sessionid') ?>

    <?= $form->field($model, 'studentid') ?>

    <?= $form->field($model, 'statusid') ?>

    <?= $form->field($model, 'statusset') ?>

    <?php // echo $form->field($model, 'timetaken') ?>

    <?php // echo $form->field($model, 'takenby') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'ipaddress') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
