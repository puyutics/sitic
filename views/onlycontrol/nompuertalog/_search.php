<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuertalogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nom-puertalog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'NOM_ID') ?>

    <?= $form->field($model, 'PUER_ID') ?>

    <?= $form->field($model, 'TURN_ID') ?>

    <?= $form->field($model, 'TURN_FECI') ?>

    <?= $form->field($model, 'TURN_FECF') ?>

    <?php // echo $form->field($model, 'TURN_TIPO') ?>

    <?php // echo $form->field($model, 'TURN_STA') ?>

    <?php // echo $form->field($model, 'TURN_NOW') ?>

    <?php // echo $form->field($model, 'TURN_DELNOW') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
