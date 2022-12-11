<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\DocentesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docentes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CIInfPer') ?>

    <?= $form->field($model, 'cedula_pasaporte') ?>

    <?= $form->field($model, 'TipoDocInfPer') ?>

    <?= $form->field($model, 'ApellInfPer') ?>

    <?= $form->field($model, 'ApellMatInfPer') ?>

    <?php // echo $form->field($model, 'NombInfPer') ?>

    <?php // echo $form->field($model, 'NacionalidadPer') ?>

    <?php // echo $form->field($model, 'EtniaPer') ?>

    <?php // echo $form->field($model, 'FechNacimPer') ?>

    <?php // echo $form->field($model, 'LugarNacimientoPer') ?>

    <?php // echo $form->field($model, 'GeneroPer') ?>

    <?php // echo $form->field($model, 'EstadoCivilPer') ?>

    <?php // echo $form->field($model, 'CiudadPer') ?>

    <?php // echo $form->field($model, 'DirecDomicilioPer') ?>

    <?php // echo $form->field($model, 'Telf1InfPer') ?>

    <?php // echo $form->field($model, 'Telf2InfPer') ?>

    <?php // echo $form->field($model, 'CelularInfPer') ?>

    <?php // echo $form->field($model, 'TipoInfPer') ?>

    <?php // echo $form->field($model, 'StatusPer') ?>

    <?php // echo $form->field($model, 'mailPer') ?>

    <?php // echo $form->field($model, 'mailInst') ?>

    <?php // echo $form->field($model, 'GrupoSanguineo') ?>

    <?php // echo $form->field($model, 'tipo_discapacidad') ?>

    <?php // echo $form->field($model, 'carnet_conadis') ?>

    <?php // echo $form->field($model, 'num_carnet_conadis') ?>

    <?php // echo $form->field($model, 'porcentaje_discapacidad') ?>

    <?php // echo $form->field($model, 'fotografia') ?>

    <?php // echo $form->field($model, 'codigo_dactilar') ?>

    <?php // echo $form->field($model, 'hd_posicion') ?>

    <?php // echo $form->field($model, 'huella_dactilar') ?>

    <?php // echo $form->field($model, 'ultima_actualizacion') ?>

    <?php // echo $form->field($model, 'LoginUsu') ?>

    <?php // echo $form->field($model, 'ClaveUsu') ?>

    <?php // echo $form->field($model, 'StatusUsu') ?>

    <?php // echo $form->field($model, 'idcarr') ?>

    <?php // echo $form->field($model, 'usa_biometrico') ?>

    <?php // echo $form->field($model, 'firma_1') ?>

    <?php // echo $form->field($model, 'firma_2') ?>

    <?php // echo $form->field($model, 'fecha_reg') ?>

    <?php // echo $form->field($model, 'fecha_ultimo_acceso') ?>

    <?php // echo $form->field($model, 'usu_registra') ?>

    <?php // echo $form->field($model, 'usu_modifica') ?>

    <?php // echo $form->field($model, 'fecha_ultima_modif') ?>

    <?php // echo $form->field($model, 'invitado') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
