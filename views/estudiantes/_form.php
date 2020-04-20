<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiantes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudiantes-form">

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

    <?= $form->field($model, 'CelularInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusper')->textInput() ?>

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

    <?= $form->field($model, 'codigo_verificacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deshabilita_edicion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
