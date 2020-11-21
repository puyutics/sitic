<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BecasConectividadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="becas-conectividad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dni') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'nombres') ?>

    <?php // echo $form->field($model, 'apellidos') ?>

    <?php // echo $form->field($model, 'provincia') ?>

    <?php // echo $form->field($model, 'cel_contacto') ?>

    <?php // echo $form->field($model, 'tel_contacto') ?>

    <?php // echo $form->field($model, 'cuenta_dni') ?>

    <?php // echo $form->field($model, 'cuenta_numero') ?>

    <?php // echo $form->field($model, 'cuenta_titular') ?>

    <?php // echo $form->field($model, 'cuenta_tipo') ?>

    <?php // echo $form->field($model, 'cuenta_institucion') ?>

    <?php // echo $form->field($model, 'siad_matriculado') ?>

    <?php // echo $form->field($model, 'siad_semestre') ?>

    <?php // echo $form->field($model, 'siad_carrera') ?>

    <?php // echo $form->field($model, 'ficha_escasos_recursos') ?>

    <?php // echo $form->field($model, 'doc_libreta') ?>

    <?php // echo $form->field($model, 'fec_registro') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
