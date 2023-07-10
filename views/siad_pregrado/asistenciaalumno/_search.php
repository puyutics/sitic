<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\AsistenciaAlumnoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistencia-alumno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_asist') ?>

    <?= $form->field($model, 'ciinfper') ?>

    <?= $form->field($model, 'fecha_asal') ?>

    <?= $form->field($model, 'hora_asal') ?>

    <?= $form->field($model, 'idPer') ?>

    <?php // echo $form->field($model, 'idnaa') ?>

    <?php // echo $form->field($model, 'observacion_asal') ?>

    <?php // echo $form->field($model, 'numsesion_asal') ?>

    <?php // echo $form->field($model, 'presente') ?>

    <?php // echo $form->field($model, 'ausente') ?>

    <?php // echo $form->field($model, 'atraso') ?>

    <?php // echo $form->field($model, 'justificada') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'fecha_modif') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'id_plasig') ?>

    <?php // echo $form->field($model, 'fecha_just_asal') ?>

    <?php // echo $form->field($model, 'usu_reg_just_asal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
