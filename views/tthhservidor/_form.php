<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TthhServidor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tthh-servidor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?= $form->field($model, 'servidorpasante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_libretamilitar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nacionalidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sexo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_sangre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_civil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discapacidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_conadis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_discapacidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'servidor_carrera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numero_certificado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identificacion_etnica')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nacionalidad_indigena')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dir_calleprincipal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dir_numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dir_callesecundaria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dir_referencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_domicilio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_trabajo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_temp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'canton')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parroquia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto_apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto_nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto_telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto_celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaria_lugar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaria_numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notaria_fecha')->textInput() ?>

    <?= $form->field($model, 'institucion_bancaria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuenta_tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuenta_numero')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
