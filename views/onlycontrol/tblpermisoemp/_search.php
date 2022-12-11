<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblPermisoempSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-permisoemp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'NOMINA_ID') ?>

    <?= $form->field($model, 'P_CAPTURAH') ?>

    <?= $form->field($model, 'P_CAPTURAF') ?>

    <?= $form->field($model, 'P_PERMISOS') ?>

    <?= $form->field($model, 'P_NOTIFICACION') ?>

    <?php // echo $form->field($model, 'P_DOCUMENTOS') ?>

    <?php // echo $form->field($model, 'P_CREDENCIAL') ?>

    <?php // echo $form->field($model, 'P_MUEVEUSER') ?>

    <?php // echo $form->field($model, 'P_EXPORTA') ?>

    <?php // echo $form->field($model, 'P_CAMBIOMASIVO') ?>

    <?php // echo $form->field($model, 'P_LISTOCONTROL') ?>

    <?php // echo $form->field($model, 'P_IMPORTAVIRDI') ?>

    <?php // echo $form->field($model, 'P_RESTRICCION') ?>

    <?php // echo $form->field($model, 'P_REPORTE') ?>

    <?php // echo $form->field($model, 'P_CAPTURAR') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
