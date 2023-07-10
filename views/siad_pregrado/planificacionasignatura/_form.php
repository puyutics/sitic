<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\PlanificacionAsignatura */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="planificacion-asignatura-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dpa_id')->textInput() ?>

    <?= $form->field($model, 'num_unidad')->textInput() ?>

    <?= $form->field($model, 'desc_unidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tema_clase')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metodologia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_encuentro')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'hora_ini_planif')->textInput() ?>

    <?= $form->field($model, 'hora_fin_planif')->textInput() ?>

    <?= $form->field($model, 'fecha_reg')->textInput() ?>

    <?= $form->field($model, 'objetivo_plasig')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha_rcd')->textInput() ?>

    <?= $form->field($model, 'hora_inicio')->textInput() ?>

    <?= $form->field($model, 'hora_fin')->textInput() ?>

    <?= $form->field($model, 'fecha_cierre')->textInput() ?>

    <?= $form->field($model, 'hora_cierre')->textInput() ?>

    <?= $form->field($model, 'hc_periodo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_periodos')->textInput() ?>

    <?= $form->field($model, 'ip_pcacceso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomb_pcacceso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observacion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'atraso')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'ps_id')->textInput() ?>

    <?= $form->field($model, 'fecha_recp')->textInput() ?>

    <?= $form->field($model, 'hora_ini_recp')->textInput() ?>

    <?= $form->field($model, 'hora_fin_recp')->textInput() ?>

    <?= $form->field($model, 'autorizacion_recp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_asist')->textInput() ?>

    <?= $form->field($model, 'acceso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_amb')->textInput() ?>

    <?= $form->field($model, 'habilita_asist')->textInput() ?>

    <?= $form->field($model, 'usu_habilita_asist')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_habilita_pldoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_actdist')->textInput() ?>

    <?= $form->field($model, 'habilita_frec')->textInput() ?>

    <?= $form->field($model, 'usu_habilita_frec')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ce_id')->textInput() ?>

    <?= $form->field($model, 'bloqueado_x_parcial')->textInput() ?>

    <?= $form->field($model, 'usu_dicta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extra')->textInput() ?>

    <?= $form->field($model, 'excluida_x_disposicion')->textInput() ?>

    <?= $form->field($model, 'archivo_justificativo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
