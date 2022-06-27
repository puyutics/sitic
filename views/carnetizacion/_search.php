<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CarnetizacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carnetizacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'CIInfPer') ?>

    <?= $form->field($model, 'cedula_pasaporte') ?>

    <?= $form->field($model, 'TipoDocInfPer') ?>

    <?php // echo $form->field($model, 'ApellInfPer') ?>

    <?php // echo $form->field($model, 'ApellMatInfPer') ?>

    <?php // echo $form->field($model, 'NombInfPer') ?>

    <?php // echo $form->field($model, 'FechNacimPer') ?>

    <?php // echo $form->field($model, 'mailInst') ?>

    <?php // echo $form->field($model, 'fotografia') ?>

    <?php // echo $form->field($model, 'idMatricula') ?>

    <?php // echo $form->field($model, 'idCarr') ?>

    <?php // echo $form->field($model, 'idPer') ?>

    <?php // echo $form->field($model, 'fechfinalperlec') ?>

    <?php // echo $form->field($model, 'filefolder') ?>

    <?php // echo $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'filetype') ?>

    <?php // echo $form->field($model, 'fec_registro') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
