<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdl-attendance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'course') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'grade') ?>

    <?= $form->field($model, 'timemodified') ?>

    <?php // echo $form->field($model, 'intro') ?>

    <?php // echo $form->field($model, 'introformat') ?>

    <?php // echo $form->field($model, 'subnet') ?>

    <?php // echo $form->field($model, 'sessiondetailspos') ?>

    <?php // echo $form->field($model, 'showsessiondetails') ?>

    <?php // echo $form->field($model, 'showextrauserdetails') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
