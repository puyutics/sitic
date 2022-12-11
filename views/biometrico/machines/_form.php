<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\biometrico\Machines */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="machines-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'MachineAlias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ConnectType')->textInput() ?>

    <?= $form->field($model, 'IP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SerialPort')->textInput() ?>

    <?= $form->field($model, 'Port')->textInput() ?>

    <?= $form->field($model, 'Baudrate')->textInput() ?>

    <?= $form->field($model, 'MachineNumber')->textInput() ?>

    <?= $form->field($model, 'IsHost')->textInput() ?>

    <?= $form->field($model, 'Enabled')->textInput() ?>

    <?= $form->field($model, 'CommPassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'UILanguage')->textInput() ?>

    <?= $form->field($model, 'DateFormat')->textInput() ?>

    <?= $form->field($model, 'InOutRecordWarn')->textInput() ?>

    <?= $form->field($model, 'Idle')->textInput() ?>

    <?= $form->field($model, 'Voice')->textInput() ?>

    <?= $form->field($model, 'managercount')->textInput() ?>

    <?= $form->field($model, 'usercount')->textInput() ?>

    <?= $form->field($model, 'fingercount')->textInput() ?>

    <?= $form->field($model, 'SecretCount')->textInput() ?>

    <?= $form->field($model, 'FirmwareVersion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ProductType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LockControl')->textInput() ?>

    <?= $form->field($model, 'Purpose')->textInput() ?>

    <?= $form->field($model, 'ProduceKind')->textInput() ?>

    <?= $form->field($model, 'sn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PhotoStamp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IsIfChangeConfigServer2')->textInput() ?>

    <?= $form->field($model, 'SENSORID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SECURITY')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
