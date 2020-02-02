<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'USERID')->textInput() ?>

    <?= $form->field($model, 'BADGENUMBER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SSN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'GENDER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TITLE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PAGER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BIRTHDAY')->textInput() ?>

    <?= $form->field($model, 'HIREDDAY')->textInput() ?>

    <?= $form->field($model, 'STREET')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CITY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'STATE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ZIP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OPHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FPHONE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VERIFICATIONMETHOD')->textInput() ?>

    <?= $form->field($model, 'DEFAULTDEPTID')->textInput() ?>

    <?= $form->field($model, 'SECURITYFLAGS')->textInput() ?>

    <?= $form->field($model, 'ATT')->textInput() ?>

    <?= $form->field($model, 'INLATE')->textInput() ?>

    <?= $form->field($model, 'OUTEARLY')->textInput() ?>

    <?= $form->field($model, 'OVERTIME')->textInput() ?>

    <?= $form->field($model, 'SEP')->textInput() ?>

    <?= $form->field($model, 'HOLIDAY')->textInput() ?>

    <?= $form->field($model, 'MINZU')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PASSWORD')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LUNCHDURATION')->textInput() ?>

    <?= $form->field($model, 'MVerifyPass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PHOTO')->textInput() ?>

    <?= $form->field($model, 'Notes')->textInput() ?>

    <?= $form->field($model, 'privilege')->textInput() ?>

    <?= $form->field($model, 'InheritDeptSch')->textInput() ?>

    <?= $form->field($model, 'InheritDeptSchClass')->textInput() ?>

    <?= $form->field($model, 'AutoSchPlan')->textInput() ?>

    <?= $form->field($model, 'MinAutoSchInterval')->textInput() ?>

    <?= $form->field($model, 'RegisterOT')->textInput() ?>

    <?= $form->field($model, 'InheritDeptRule')->textInput() ?>

    <?= $form->field($model, 'EMPRIVILEGE')->textInput() ?>

    <?= $form->field($model, 'CardNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_IESSID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_Estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_FormaPago')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_1Quincena')->textInput() ?>

    <?= $form->field($model, 'sca_Nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_Apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_Cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_IdCentroCostos')->textInput() ?>

    <?= $form->field($model, 'sca_EstadoCivil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_Sexo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_FechaDespido')->textInput() ?>

    <?= $form->field($model, 'sca_CargasFamiliares')->textInput() ?>

    <?= $form->field($model, 'sca_Firma')->textInput() ?>

    <?= $form->field($model, 'Pin1')->textInput() ?>

    <?= $form->field($model, 'sca_Discapacidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_Correo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_MotivoInactivacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sca_WEB_MarcaManual')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
