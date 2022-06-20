<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TthhServidorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tthh-servidor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tipo_documento') ?>

    <?= $form->field($model, 'id_documento') ?>

    <?= $form->field($model, 'nombres') ?>

    <?= $form->field($model, 'apellidos') ?>

    <?= $form->field($model, 'fecha_nacimiento') ?>

    <?php // echo $form->field($model, 'servidorpasante') ?>

    <?php // echo $form->field($model, 'num_libretamilitar') ?>

    <?php // echo $form->field($model, 'nacionalidad') ?>

    <?php // echo $form->field($model, 'sexo') ?>

    <?php // echo $form->field($model, 'tipo_sangre') ?>

    <?php // echo $form->field($model, 'estado_civil') ?>

    <?php // echo $form->field($model, 'discapacidad') ?>

    <?php // echo $form->field($model, 'numero_conadis') ?>

    <?php // echo $form->field($model, 'tipo_discapacidad') ?>

    <?php // echo $form->field($model, 'servidor_carrera') ?>

    <?php // echo $form->field($model, 'numero_certificado') ?>

    <?php // echo $form->field($model, 'identificacion_etnica') ?>

    <?php // echo $form->field($model, 'nacionalidad_indigena') ?>

    <?php // echo $form->field($model, 'dir_calleprincipal') ?>

    <?php // echo $form->field($model, 'dir_numero') ?>

    <?php // echo $form->field($model, 'dir_callesecundaria') ?>

    <?php // echo $form->field($model, 'dir_referencia') ?>

    <?php // echo $form->field($model, 'tel_domicilio') ?>

    <?php // echo $form->field($model, 'tel_celular') ?>

    <?php // echo $form->field($model, 'tel_trabajo') ?>

    <?php // echo $form->field($model, 'tel_extension') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'email_temp') ?>

    <?php // echo $form->field($model, 'provincia') ?>

    <?php // echo $form->field($model, 'canton') ?>

    <?php // echo $form->field($model, 'parroquia') ?>

    <?php // echo $form->field($model, 'contacto_apellidos') ?>

    <?php // echo $form->field($model, 'contacto_nombres') ?>

    <?php // echo $form->field($model, 'contacto_telefono') ?>

    <?php // echo $form->field($model, 'contacto_celular') ?>

    <?php // echo $form->field($model, 'notaria_lugar') ?>

    <?php // echo $form->field($model, 'notaria_numero') ?>

    <?php // echo $form->field($model, 'notaria_fecha') ?>

    <?php // echo $form->field($model, 'institucion_bancaria') ?>

    <?php // echo $form->field($model, 'cuenta_tipo') ?>

    <?php // echo $form->field($model, 'cuenta_numero') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
