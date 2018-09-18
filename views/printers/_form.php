<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Printers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="printers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'printer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ipv4_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\Department::find()->all(), 'id', 'department'),
        'options' => ['placeholder' => 'Seleccionar departamento'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'inv_models_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\InvModels::find()->all(), 'id', 'model'),
        'options' => ['placeholder' => 'Seleccionar modelo'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
