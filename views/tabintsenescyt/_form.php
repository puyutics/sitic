<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntSenescyt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tab-int-senescyt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fec_inicio')->textInput() ?>

    <?= $form->field($model, 'fec_fin')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cedula_pasaporte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'canton')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parroquia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nivel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carrera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'semestre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equipos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'computador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'portatil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tablet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'radio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'television')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smartphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mic_computador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cam_computador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'par_computador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mic_portatil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cam_portatil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'par_portatil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'internet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proveedor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'velocidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teletrabajo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estudios')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cant_usuarios')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'horas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
