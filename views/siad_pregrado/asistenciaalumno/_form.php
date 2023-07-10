<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\AsistenciaAlumno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistencia-alumno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ciinfper')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_asal')->textInput() ?>

    <?= $form->field($model, 'hora_asal')->textInput() ?>

    <?= $form->field($model, 'idPer')->textInput() ?>

    <?= $form->field($model, 'idnaa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observacion_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numsesion_asal')->textInput() ?>

    <?= $form->field($model, 'presente')->textInput() ?>

    <?= $form->field($model, 'ausente')->textInput() ?>

    <?= $form->field($model, 'atraso')->textInput() ?>

    <?= $form->field($model, 'justificada')->textInput() ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'fecha_modif')->textInput() ?>

    <?= $form->field($model, 'observacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_plasig')->textInput() ?>

    <?= $form->field($model, 'fecha_just_asal')->textInput() ?>

    <?= $form->field($model, 'usu_reg_just_asal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
