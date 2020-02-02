<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CheckExactSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-exact-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'EXACTID') ?>

    <?= $form->field($model, 'USERID') ?>

    <?= $form->field($model, 'CHECKTIME') ?>

    <?= $form->field($model, 'CHECKTYPE') ?>

    <?= $form->field($model, 'ISADD') ?>

    <?php // echo $form->field($model, 'YUYIN') ?>

    <?php // echo $form->field($model, 'ISMODIFY') ?>

    <?php // echo $form->field($model, 'ISDELETE') ?>

    <?php // echo $form->field($model, 'INCOUNT') ?>

    <?php // echo $form->field($model, 'ISCOUNT') ?>

    <?php // echo $form->field($model, 'MODIFYBY') ?>

    <?php // echo $form->field($model, 'DATE') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
