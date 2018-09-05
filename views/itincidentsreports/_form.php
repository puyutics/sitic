<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ItIncidentsReports */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-incidents-reports-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issue')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'date_reported')->widget(DateTimePicker::className(), [
        'options' => ['placeholder' => 'Seleccionar fecha'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd H:i:s',
            'todayBtn' => true
        ]
    ]) ?>

    <?= $form->field($model, 'date_solved')->widget(DateTimePicker::className(), [
        'options' => ['placeholder' => 'Seleccionar fecha'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd H:i:s',
            'todayBtn' => true
        ]
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
