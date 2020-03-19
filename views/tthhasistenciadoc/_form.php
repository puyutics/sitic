<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TthhAsistenciaDoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tthh-asistencia-doc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idx_servidor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idx_tipoasistencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idx_motivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idx_tipodocumento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_inicio')->textInput() ?>

    <?= $form->field($model, 'fecha_fin')->textInput() ?>

    <?= $form->field($model, 'dias')->textInput() ?>

    <?= $form->field($model, 'horas')->textInput() ?>

    <?= $form->field($model, 'minutos')->textInput() ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status_envio')->textInput() ?>

    <?= $form->field($model, 'fecha_envio')->textInput() ?>

    <?= $form->field($model, 'status_revision')->textInput() ?>

    <?= $form->field($model, 'fecha_revision')->textInput() ?>

    <?= $form->field($model, 'status_aprobacion')->textInput() ?>

    <?= $form->field($model, 'fecha_aprobacion')->textInput() ?>

    <?= $form->field($model, 'ip_registrado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idx_usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hora_inicial')->textInput() ?>

    <?= $form->field($model, 'hora_final')->textInput() ?>

    <?= $form->field($model, 'vacaciones_st')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
