<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\siad_pregrado\Docentes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="docentes-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'mailInst')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StatusPer')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group" align="center">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-lg btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
