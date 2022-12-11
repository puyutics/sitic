<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\NotasAlumnoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notas-alumno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idnaa') ?>

    <?= $form->field($model, 'CIInfPer') ?>

    <?= $form->field($model, 'idAsig') ?>

    <?= $form->field($model, 'idPer') ?>

    <?= $form->field($model, 'CAC1') ?>

    <?php // echo $form->field($model, 'CAC2') ?>

    <?php // echo $form->field($model, 'CAC3') ?>

    <?php // echo $form->field($model, 'TCAC') ?>

    <?php // echo $form->field($model, 'CEF') ?>

    <?php // echo $form->field($model, 'CSP') ?>

    <?php // echo $form->field($model, 'CCR') ?>

    <?php // echo $form->field($model, 'CSP2') ?>

    <?php // echo $form->field($model, 'CalifFinal') ?>

    <?php // echo $form->field($model, 'asistencia') ?>

    <?php // echo $form->field($model, 'StatusCalif') ?>

    <?php // echo $form->field($model, 'idMatricula') ?>

    <?php // echo $form->field($model, 'VRepite') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'op1') ?>

    <?php // echo $form->field($model, 'op2') ?>

    <?php // echo $form->field($model, 'op3') ?>

    <?php // echo $form->field($model, 'pierde_x_asistencia') ?>

    <?php // echo $form->field($model, 'pierde_x_ppf') ?>

    <?php // echo $form->field($model, 'repite') ?>

    <?php // echo $form->field($model, 'retirado') ?>

    <?php // echo $form->field($model, 'excluidaxrepitencia') ?>

    <?php // echo $form->field($model, 'excluidaxreingreso') ?>

    <?php // echo $form->field($model, 'excluidaxresolucion') ?>

    <?php // echo $form->field($model, 'excluidaxcambiomalla') ?>

    <?php // echo $form->field($model, 'convalidacion') ?>

    <?php // echo $form->field($model, 'convalida_ppf') ?>

    <?php // echo $form->field($model, 'aprobada') ?>

    <?php // echo $form->field($model, 'anulada') ?>

    <?php // echo $form->field($model, 'arrastre') ?>

    <?php // echo $form->field($model, 'registro_asistencia') ?>

    <?php // echo $form->field($model, 'usu_registro_asistencia') ?>

    <?php // echo $form->field($model, 'registro') ?>

    <?php // echo $form->field($model, 'ultima_modificacion') ?>

    <?php // echo $form->field($model, 'usu_pregistro') ?>

    <?php // echo $form->field($model, 'usu_umodif_registro') ?>

    <?php // echo $form->field($model, 'archivo') ?>

    <?php // echo $form->field($model, 'archivo_conv_ppf') ?>

    <?php // echo $form->field($model, 'idMc') ?>

    <?php // echo $form->field($model, 'institucion_proviene') ?>

    <?php // echo $form->field($model, 'observacion_conv') ?>

    <?php // echo $form->field($model, 'porcentaje_convalidacion') ?>

    <?php // echo $form->field($model, 'usuario_conv') ?>

    <?php // echo $form->field($model, 'observacion_conv_ppf') ?>

    <?php // echo $form->field($model, 'usuario_conv_ppf') ?>

    <?php // echo $form->field($model, 'exam_final_atrasado') ?>

    <?php // echo $form->field($model, 'exam_supl_atrasado') ?>

    <?php // echo $form->field($model, 'exam_supl_sancion') ?>

    <?php // echo $form->field($model, 'observacion_efa') ?>

    <?php // echo $form->field($model, 'observacion_espa') ?>

    <?php // echo $form->field($model, 'observacion_sps') ?>

    <?php // echo $form->field($model, 'observacion_op3') ?>

    <?php // echo $form->field($model, 'usu_habilita_efa') ?>

    <?php // echo $form->field($model, 'usu_habilita_espa') ?>

    <?php // echo $form->field($model, 'usu_habilita_sps') ?>

    <?php // echo $form->field($model, 'usu_habilita_op3') ?>

    <?php // echo $form->field($model, 'dpa_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
