<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\DptoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dpto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DEP_ID') ?>

    <?= $form->field($model, 'DEP_ARE') ?>

    <?= $form->field($model, 'DEP_NOM') ?>

    <?= $form->field($model, 'DEP_DESC') ?>

    <?= $form->field($model, 'DEP_OBS') ?>

    <?php // echo $form->field($model, 'DEP_EM') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
