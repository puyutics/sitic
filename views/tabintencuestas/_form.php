<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntEncuestas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tab-int-encuestas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ObjectID')->textInput() ?>

    <?= $form->field($model, 'GlobalID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CreationDate')->textInput() ?>

    <?= $form->field($model, 'Creator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EditDate')->textInput() ?>

    <?= $form->field($model, 'Editor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CedulaPasaporte')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Campus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Carrera')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Operadora')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Internet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoInternet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Computador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TipoComputador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PropiedadComputador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'x')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'y')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Beneficio')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
