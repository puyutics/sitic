<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormulario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tab-int-formulario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cedula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo_postal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'canton')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parroquia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_principal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calle_secundaria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencia_texto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencia_foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cel_contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siad_matriculado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siad_semestre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'siad_carrera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ficha_escasos_recursos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'encuesta_beneficiario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cobertura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smartphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'responsabilidad_uso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condiciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_cedula_pasaporte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_servicio_basico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_responsabilidad_uso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_contrato')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qrcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fec_registro')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
