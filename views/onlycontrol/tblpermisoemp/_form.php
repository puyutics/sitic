<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblPermisoemp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-permisoemp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMINA_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'P_CAPTURAH')->textInput() ?>

    <?= $form->field($model, 'P_CAPTURAF')->textInput() ?>

    <?= $form->field($model, 'P_PERMISOS')->textInput() ?>

    <?= $form->field($model, 'P_NOTIFICACION')->textInput() ?>

    <?= $form->field($model, 'P_DOCUMENTOS')->textInput() ?>

    <?= $form->field($model, 'P_CREDENCIAL')->textInput() ?>

    <?= $form->field($model, 'P_MUEVEUSER')->textInput() ?>

    <?= $form->field($model, 'P_EXPORTA')->textInput() ?>

    <?= $form->field($model, 'P_CAMBIOMASIVO')->textInput() ?>

    <?= $form->field($model, 'P_LISTOCONTROL')->textInput() ?>

    <?= $form->field($model, 'P_IMPORTAVIRDI')->textInput() ?>

    <?= $form->field($model, 'P_RESTRICCION')->textInput() ?>

    <?= $form->field($model, 'P_REPORTE')->textInput() ?>

    <?= $form->field($model, 'P_CAPTURAR')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
