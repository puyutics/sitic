<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntSenescytSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tab-int-senescyt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fec_inicio') ?>

    <?= $form->field($model, 'fec_fin') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'nombres') ?>

    <?php // echo $form->field($model, 'cedula_pasaporte') ?>

    <?php // echo $form->field($model, 'provincia') ?>

    <?php // echo $form->field($model, 'canton') ?>

    <?php // echo $form->field($model, 'parroquia') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'nivel') ?>

    <?php // echo $form->field($model, 'carrera') ?>

    <?php // echo $form->field($model, 'semestre') ?>

    <?php // echo $form->field($model, 'equipos') ?>

    <?php // echo $form->field($model, 'computador') ?>

    <?php // echo $form->field($model, 'portatil') ?>

    <?php // echo $form->field($model, 'tablet') ?>

    <?php // echo $form->field($model, 'radio') ?>

    <?php // echo $form->field($model, 'television') ?>

    <?php // echo $form->field($model, 'smartphone') ?>

    <?php // echo $form->field($model, 'mic_computador') ?>

    <?php // echo $form->field($model, 'cam_computador') ?>

    <?php // echo $form->field($model, 'par_computador') ?>

    <?php // echo $form->field($model, 'mic_portatil') ?>

    <?php // echo $form->field($model, 'cam_portatil') ?>

    <?php // echo $form->field($model, 'par_portatil') ?>

    <?php // echo $form->field($model, 'internet') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'proveedor') ?>

    <?php // echo $form->field($model, 'velocidad') ?>

    <?php // echo $form->field($model, 'teletrabajo') ?>

    <?php // echo $form->field($model, 'estudios') ?>

    <?php // echo $form->field($model, 'cant_usuarios') ?>

    <?php // echo $form->field($model, 'horas') ?>

    <?php // echo $form->field($model, 'accion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
