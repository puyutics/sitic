<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AcUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ac-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AC_USER') ?>

    <?= $form->field($model, 'AC_P1') ?>

    <?= $form->field($model, 'AC_P2') ?>

    <?= $form->field($model, 'AC_P3') ?>

    <?= $form->field($model, 'AC_P4') ?>

    <?php // echo $form->field($model, 'AC_P5') ?>

    <?php // echo $form->field($model, 'AC_P6') ?>

    <?php // echo $form->field($model, 'AC_P7') ?>

    <?php // echo $form->field($model, 'AC_P8') ?>

    <?php // echo $form->field($model, 'AC_P9') ?>

    <?php // echo $form->field($model, 'AC_P10') ?>

    <?php // echo $form->field($model, 'AC_P11') ?>

    <?php // echo $form->field($model, 'AC_P12') ?>

    <?php // echo $form->field($model, 'AC_P13') ?>

    <?php // echo $form->field($model, 'AC_P14') ?>

    <?php // echo $form->field($model, 'AC_P15') ?>

    <?php // echo $form->field($model, 'AC_P16') ?>

    <?php // echo $form->field($model, 'AC_P17') ?>

    <?php // echo $form->field($model, 'AC_P18') ?>

    <?php // echo $form->field($model, 'AC_P19') ?>

    <?php // echo $form->field($model, 'AC_P20') ?>

    <?php // echo $form->field($model, 'AC_UCREA') ?>

    <?php // echo $form->field($model, 'AC_FCREA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
