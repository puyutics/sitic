<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdldapNewUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adldap-new-users-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'options' => ['autocomplete' => 'off'],
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fec_nacimiento')->textInput() ?>

    <?= $form->field($model, 'campus')->dropDownList([
        'PUYO'=>'PUYO',
        'LAGO AGRIO'=>'LAGO AGRIO',
        'PANGUI'=>'PANGUI',
    ]) ?>

    <?= $form->field($model, 'carrera')->dropDownList([
        'AGROINDUSTRIAL'=>'AGROINDUSTRIAL',
        'AGROPECUARIA'=>'AGROPECUARIA',
        'AMBIENTAL'=>'AMBIENTAL',
        'BIOLOGIA'=>'BIOLOGIA',
        'COMUNICACION'=>'COMUNICACION',
        'FORESTAL'=>'FORESTAL',
        'TURISMO'=>'TURISMO',
    ]) ?>

    <?= $form->field($model, 'email_personal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([
        '1'=>'1 - Cuenta no creada',
        '2'=>'2 - Email Personal Verificado',
        '3'=>'3 - Password pendiente',
        '4'=>'4 - Cuenta creada',
    ]) ?>

    <div class="form-group" align="center">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
