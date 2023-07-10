<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\PlanificacionAsignaturaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planificacion-asignatura-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_plasig') ?>

    <?= $form->field($model, 'dpa_id') ?>

    <?= $form->field($model, 'num_unidad') ?>

    <?= $form->field($model, 'desc_unidad') ?>

    <?= $form->field($model, 'tema_clase') ?>

    <?php // echo $form->field($model, 'contenido') ?>

    <?php // echo $form->field($model, 'metodologia') ?>

    <?php // echo $form->field($model, 'num_encuentro') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'hora_ini_planif') ?>

    <?php // echo $form->field($model, 'hora_fin_planif') ?>

    <?php // echo $form->field($model, 'fecha_reg') ?>

    <?php // echo $form->field($model, 'objetivo_plasig') ?>

    <?php // echo $form->field($model, 'fecha_rcd') ?>

    <?php // echo $form->field($model, 'hora_inicio') ?>

    <?php // echo $form->field($model, 'hora_fin') ?>

    <?php // echo $form->field($model, 'fecha_cierre') ?>

    <?php // echo $form->field($model, 'hora_cierre') ?>

    <?php // echo $form->field($model, 'hc_periodo') ?>

    <?php // echo $form->field($model, 'num_periodos') ?>

    <?php // echo $form->field($model, 'ip_pcacceso') ?>

    <?php // echo $form->field($model, 'nomb_pcacceso') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'atraso') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'ps_id') ?>

    <?php // echo $form->field($model, 'fecha_recp') ?>

    <?php // echo $form->field($model, 'hora_ini_recp') ?>

    <?php // echo $form->field($model, 'hora_fin_recp') ?>

    <?php // echo $form->field($model, 'autorizacion_recp') ?>

    <?php // echo $form->field($model, 'estado_asist') ?>

    <?php // echo $form->field($model, 'acceso') ?>

    <?php // echo $form->field($model, 'id_amb') ?>

    <?php // echo $form->field($model, 'habilita_asist') ?>

    <?php // echo $form->field($model, 'usu_habilita_asist') ?>

    <?php // echo $form->field($model, 'usu_habilita_pldoc') ?>

    <?php // echo $form->field($model, 'id_actdist') ?>

    <?php // echo $form->field($model, 'habilita_frec') ?>

    <?php // echo $form->field($model, 'usu_habilita_frec') ?>

    <?php // echo $form->field($model, 'ce_id') ?>

    <?php // echo $form->field($model, 'bloqueado_x_parcial') ?>

    <?php // echo $form->field($model, 'usu_dicta') ?>

    <?php // echo $form->field($model, 'extra') ?>

    <?php // echo $form->field($model, 'excluida_x_disposicion') ?>

    <?php // echo $form->field($model, 'archivo_justificativo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
