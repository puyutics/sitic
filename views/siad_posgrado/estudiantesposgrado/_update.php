<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_posgrado\EstudiantesPosgrado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudiantes-posgrado-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'mailInst')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusper')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group" align="center">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-lg btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
