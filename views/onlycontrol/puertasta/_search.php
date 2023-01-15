<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\PuertaStaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puerta-sta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'P_ID') ?>

    <?= $form->field($model, 'P_Fecha') ?>

    <?= $form->field($model, 'P_Status') ?>

    <?= $form->field($model, 'P_User') ?>

    <?= $form->field($model, 'P_Maq') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
