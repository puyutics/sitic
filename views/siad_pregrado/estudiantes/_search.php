<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\EstudiantesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudiantes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CIInfPer') ?>

    <?= $form->field($model, 'num_expediente') ?>

    <?= $form->field($model, 'cedula_pasaporte') ?>

    <?= $form->field($model, 'TipoDocInfPer') ?>

    <?= $form->field($model, 'ApellInfPer') ?>

    <?php // echo $form->field($model, 'ApellMatInfPer') ?>

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

    <?php // echo $form->field($model, 'CelularInfPer') ?>

    <?php // echo $form->field($model, 'TipoInfPer') ?>

    <?php // echo $form->field($model, 'statusper') ?>

    <?php // echo $form->field($model, 'mailPer') ?>

    <?php // echo $form->field($model, 'mailInst') ?>

    <?php // echo $form->field($model, 'GrupoSanguineo') ?>

    <?php // echo $form->field($model, 'tipo_discapacidad') ?>

    <?php // echo $form->field($model, 'carnet_conadis') ?>

    <?php // echo $form->field($model, 'num_carnet_conadis') ?>

    <?php // echo $form->field($model, 'porcentaje_discapacidad') ?>

    <?php // echo $form->field($model, 'lateralidad') ?>

    <?php // echo $form->field($model, 'fotografia') ?>

    <?php // echo $form->field($model, 'codigo_dactilar') ?>

    <?php // echo $form->field($model, 'hd_posicion') ?>

    <?php // echo $form->field($model, 'huella_dactilar') ?>

    <?php // echo $form->field($model, 'ultima_actualizacion') ?>

    <?php // echo $form->field($model, 'codigo_verificacion') ?>

    <?php // echo $form->field($model, 'deshabilita_edicion') ?>

    <?php // echo $form->field($model, 'archivo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
