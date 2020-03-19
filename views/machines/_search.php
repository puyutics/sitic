<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MachinesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="machines-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'MachineAlias') ?>

    <?= $form->field($model, 'ConnectType') ?>

    <?= $form->field($model, 'IP') ?>

    <?= $form->field($model, 'SerialPort') ?>

    <?php // echo $form->field($model, 'Port') ?>

    <?php // echo $form->field($model, 'Baudrate') ?>

    <?php // echo $form->field($model, 'MachineNumber') ?>

    <?php // echo $form->field($model, 'IsHost') ?>

    <?php // echo $form->field($model, 'Enabled') ?>

    <?php // echo $form->field($model, 'CommPassword') ?>

    <?php // echo $form->field($model, 'UILanguage') ?>

    <?php // echo $form->field($model, 'DateFormat') ?>

    <?php // echo $form->field($model, 'InOutRecordWarn') ?>

    <?php // echo $form->field($model, 'Idle') ?>

    <?php // echo $form->field($model, 'Voice') ?>

    <?php // echo $form->field($model, 'managercount') ?>

    <?php // echo $form->field($model, 'usercount') ?>

    <?php // echo $form->field($model, 'fingercount') ?>

    <?php // echo $form->field($model, 'SecretCount') ?>

    <?php // echo $form->field($model, 'FirmwareVersion') ?>

    <?php // echo $form->field($model, 'ProductType') ?>

    <?php // echo $form->field($model, 'LockControl') ?>

    <?php // echo $form->field($model, 'Purpose') ?>

    <?php // echo $form->field($model, 'ProduceKind') ?>

    <?php // echo $form->field($model, 'sn') ?>

    <?php // echo $form->field($model, 'PhotoStamp') ?>

    <?php // echo $form->field($model, 'IsIfChangeConfigServer2') ?>

    <?php // echo $form->field($model, 'SENSORID') ?>

    <?php // echo $form->field($model, 'SECURITY') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
