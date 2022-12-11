<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\Docentes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docentes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CIInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cedula_pasaporte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoDocInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ApellInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ApellMatInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NombInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NacionalidadPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EtniaPer')->textInput() ?>

    <?= $form->field($model, 'FechNacimPer')->textInput() ?>

    <?= $form->field($model, 'LugarNacimientoPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GeneroPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstadoCivilPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CiudadPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DirecDomicilioPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telf1InfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telf2InfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CelularInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StatusPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mailPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mailInst')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GrupoSanguineo')->textInput() ?>

    <?= $form->field($model, 'tipo_discapacidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carnet_conadis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_carnet_conadis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'porcentaje_discapacidad')->textInput() ?>

    <?= $form->field($model, 'fotografia')->textInput() ?>

    <?= $form->field($model, 'codigo_dactilar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hd_posicion')->textInput() ?>

    <?= $form->field($model, 'huella_dactilar')->textInput() ?>

    <?= $form->field($model, 'ultima_actualizacion')->textInput() ?>

    <?= $form->field($model, 'LoginUsu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ClaveUsu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StatusUsu')->textInput() ?>

    <?= $form->field($model, 'idcarr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usa_biometrico')->textInput() ?>

    <?= $form->field($model, 'fecha_reg')->textInput() ?>

    <?= $form->field($model, 'fecha_ultimo_acceso')->textInput() ?>

    <?= $form->field($model, 'usu_registra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usu_modifica')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_ultima_modif')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
