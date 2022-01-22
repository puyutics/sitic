<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotasAlumno */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notas-alumno-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CIInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idAsig')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPer')->textInput() ?>

    <?= $form->field($model, 'CAC1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CAC2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CAC3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TCAC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CEF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CSP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CCR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CSP2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CalifFinal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asistencia')->textInput() ?>

    <?= $form->field($model, 'StatusCalif')->textInput() ?>

    <?= $form->field($model, 'idMatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VRepite')->textInput() ?>

    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'op1')->textInput() ?>

    <?= $form->field($model, 'op2')->textInput() ?>

    <?= $form->field($model, 'op3')->textInput() ?>

    <?= $form->field($model, 'pierde_x_asistencia')->textInput() ?>

    <?= $form->field($model, 'repite')->textInput() ?>

    <?= $form->field($model, 'retirado')->textInput() ?>

    <?= $form->field($model, 'excluidaxrepitencia')->textInput() ?>

    <?= $form->field($model, 'excluidaxreingreso')->textInput() ?>

    <?= $form->field($model, 'excluidaxresolucion')->textInput() ?>

    <?= $form->field($model, 'convalidacion')->textInput() ?>

    <?= $form->field($model, 'aprobada')->textInput() ?>

    <?= $form->field($model, 'anulada')->textInput() ?>

    <?= $form->field($model, 'arrastre')->textInput() ?>

    <?= $form->field($model, 'registro_asistencia')->textInput() ?>

    <?= $form->field($model, 'usu_registro_asistencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registro')->textInput() ?>

    <?= $form->field($model, 'ultima_modificacion')->textInput() ?>

    <?= $form->field($model, 'usu_pregistro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_umodif_registro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idMc')->textInput() ?>

    <?= $form->field($model, 'institucion_proviene')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'porcentaje_convalidacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exam_final_atrasado')->textInput() ?>

    <?= $form->field($model, 'exam_supl_atrasado')->textInput() ?>

    <?= $form->field($model, 'observacion_efa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observacion_espa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_habilita_efa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_habilita_espa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dpa_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
