<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MatriculaPosgrado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matricula-posgrado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idMatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idMatricula_anual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idPer')->textInput() ?>

    <?= $form->field($model, 'CIInfPer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idCarr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idanio')->textInput() ?>

    <?= $form->field($model, 'idsemestre')->textInput() ?>

    <?= $form->field($model, 'FechaMatricula')->textInput() ?>

    <?= $form->field($model, 'idParalelo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idMatricula_ant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoMatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusMatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'anulada')->textInput() ?>

    <?= $form->field($model, 'observMatricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promocion')->textInput() ?>

    <?= $form->field($model, 'Usu_registra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Usu_legaliza')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_crea')->textInput() ?>

    <?= $form->field($model, 'Usu_modifica')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Fecha_ultima_modif')->textInput() ?>

    <?= $form->field($model, 'archivo_aprobado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archivo_retirado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archivo_anulado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'leg_observacion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
