<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TthhAsistenciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tthh-asistencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_asistencia') ?>

    <?= $form->field($model, 'idx_servidor') ?>

    <?= $form->field($model, 'idx_tipoasistencia') ?>

    <?= $form->field($model, 'idx_motivo') ?>

    <?= $form->field($model, 'idx_tipodocumento') ?>

    <?php // echo $form->field($model, 'numero_documento') ?>

    <?php // echo $form->field($model, 'fecha_inicio') ?>

    <?php // echo $form->field($model, 'fecha_fin') ?>

    <?php // echo $form->field($model, 'dias') ?>

    <?php // echo $form->field($model, 'horas') ?>

    <?php // echo $form->field($model, 'minutos') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'status_envio') ?>

    <?php // echo $form->field($model, 'fecha_envio') ?>

    <?php // echo $form->field($model, 'status_revision') ?>

    <?php // echo $form->field($model, 'fecha_revision') ?>

    <?php // echo $form->field($model, 'status_aprobacion') ?>

    <?php // echo $form->field($model, 'fecha_aprobacion') ?>

    <?php // echo $form->field($model, 'ip_registrado') ?>

    <?php // echo $form->field($model, 'idx_usuario') ?>

    <?php // echo $form->field($model, 'hora_inicial') ?>

    <?php // echo $form->field($model, 'hora_final') ?>

    <?php // echo $form->field($model, 'vacaciones_st') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
