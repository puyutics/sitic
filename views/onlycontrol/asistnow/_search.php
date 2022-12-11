<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AsistnowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistnow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ASIS_ID') ?>

    <?= $form->field($model, 'ASIS_ING') ?>

    <?= $form->field($model, 'ASIS_ZONA') ?>

    <?= $form->field($model, 'ASIS_FECHA') ?>

    <?= $form->field($model, 'ASIS_HORA') ?>

    <?php // echo $form->field($model, 'ASIS_TIPO') ?>

    <?php // echo $form->field($model, 'ASIS_RES') ?>

    <?php // echo $form->field($model, 'ASIS_F') ?>

    <?php // echo $form->field($model, 'ASIS_FN') ?>

    <?php // echo $form->field($model, 'ASIS_HN') ?>

    <?php // echo $form->field($model, 'ASIS_PRINT') ?>

    <?php // echo $form->field($model, 'ASIS_NOVEDAD') ?>

    <?php // echo $form->field($model, 'ASIS_MM') ?>

    <?php // echo $form->field($model, 'ASIS_MAIL') ?>

    <?php // echo $form->field($model, 'ASIS_CORRIGE') ?>

    <?php // echo $form->field($model, 'ASIS_TEMPERATURA') ?>

    <?php // echo $form->field($model, 'ASIS_SIMILARIDAD') ?>

    <?php // echo $form->field($model, 'ASIS_EVO') ?>

    <?php // echo $form->field($model, 'ASIS_EMPRESA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
