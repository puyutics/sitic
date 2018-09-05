<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\ItIncidentsReportsUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-incidents-reports-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (isset($_GET['id_itincidentsreports'])) { ?>
        <?= $form->field($model, 'it_incidents_reports_id')->textInput
        (['value' => $_GET['id_itincidentsreports'],'readonly'=> true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'it_incidents_reports_id')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(app\models\ItIncidentsReports::find()->all(), 'id', 'subject'),
            'options' => ['placeholder' => 'Seleccionar Incidente'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?php } ?>

    <?= $form->field($model, 'username')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\User::find()->all(), 'username', 'username'),
        'options' => ['placeholder' => 'Seleccionar usuario'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'date_assigned')->widget(DateTimePicker::className(), [
        'options' => ['placeholder' => 'Seleccionar fecha'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd H:i:s',
            'todayBtn' => true
        ]
    ]) ?>

    <?= $form->field($model, 'date_released')->widget(DateTimePicker::className(), [
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
