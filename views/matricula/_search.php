<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatriculaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matricula-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idMatricula') ?>

    <?= $form->field($model, 'idMatricula_anual') ?>

    <?= $form->field($model, 'idPer') ?>

    <?= $form->field($model, 'CIInfPer') ?>

    <?= $form->field($model, 'idCarr') ?>

    <?php // echo $form->field($model, 'idanio') ?>

    <?php // echo $form->field($model, 'idsemestre') ?>

    <?php // echo $form->field($model, 'FechaMatricula') ?>

    <?php // echo $form->field($model, 'idParalelo') ?>

    <?php // echo $form->field($model, 'idMatricula_ant') ?>

    <?php // echo $form->field($model, 'tipoMatricula') ?>

    <?php // echo $form->field($model, 'statusMatricula') ?>

    <?php // echo $form->field($model, 'anulada') ?>

    <?php // echo $form->field($model, 'observMatricula') ?>

    <?php // echo $form->field($model, 'promocion') ?>

    <?php // echo $form->field($model, 'Usu_registra') ?>

    <?php // echo $form->field($model, 'Usu_legaliza') ?>

    <?php // echo $form->field($model, 'Fecha_crea') ?>

    <?php // echo $form->field($model, 'Usu_modifica') ?>

    <?php // echo $form->field($model, 'Fecha_ultima_modif') ?>

    <?php // echo $form->field($model, 'archivo_aprobado') ?>

    <?php // echo $form->field($model, 'archivo_retirado') ?>

    <?php // echo $form->field($model, 'archivo_anulado') ?>

    <?php // echo $form->field($model, 'leg_observacion') ?>

    <?php // echo $form->field($model, 'num_asig_repite') ?>

    <?php // echo $form->field($model, 'aprobacion_automatica') ?>

    <?php // echo $form->field($model, 'mail_enviado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
