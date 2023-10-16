<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\Nomina */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nomina-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NOMINA_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_APE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_CLAVE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_TELEFONO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_SALVOCONDUCTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_COD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_TIPO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_CAL')->textInput() ?>

    <?= $form->field($model, 'NOMINA_AREA')->textInput() ?>

    <?= $form->field($model, 'NOMINA_DEP')->textInput() ?>

    <?= $form->field($model, 'NOMINA_CAL1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_AREA1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_DEP1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_FING')->textInput() ?>

    <?= $form->field($model, 'NOMINA_FSAL')->textInput() ?>

    <?= $form->field($model, 'NOMINA_SUEL')->textInput() ?>

    <?= $form->field($model, 'NOMINA_COM')->textInput() ?>

    <?= $form->field($model, 'NOMINA_AUTI')->textInput() ?>

    <?= $form->field($model, 'NOMINA_ES')->textInput() ?>

    <?= $form->field($model, 'NOMINA_OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_EMP')->textInput() ?>

    <?= $form->field($model, 'NOMINA_FINGER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_F1')->textInput() ?>

    <?= $form->field($model, 'NOMINA_CED')->textInput() ?>

    <?= $form->field($model, 'NOMINA_FIR')->textInput() ?>

    <?= $form->field($model, 'NOMINA_HD1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_HF1')->textInput() ?>

    <?= $form->field($model, 'NOMINA_HI1')->textInput() ?>

    <?= $form->field($model, 'NOMINA_HD2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_HF2')->textInput() ?>

    <?= $form->field($model, 'NOMINA_HI2')->textInput() ?>

    <?= $form->field($model, 'NOMINA_SEL')->textInput() ?>

    <?= $form->field($model, 'NOMINA_EMPC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_EMPE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_P1')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P2')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P3')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P4')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P5')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P6')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P7')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P8')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P9')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P10')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P11')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P12')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P13')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P14')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P15')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P16')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P17')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P18')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P19')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P20')->textInput() ?>

    <?= $form->field($model, 'NOMINA_DOC')->textInput() ?>

    <?= $form->field($model, 'NOMINA_PLA')->textInput() ?>

    <?= $form->field($model, 'NOMINA_F')->textInput() ?>

    <?= $form->field($model, 'NOMINA_CARD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_FCARD')->textInput() ?>

    <?= $form->field($model, 'NOMINA_OBS1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_NOW')->textInput() ?>

    <?= $form->field($model, 'NOMINA_CAFE')->textInput() ?>

    <?= $form->field($model, 'NOMINA_AUTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_P21')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P22')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P23')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P24')->textInput() ?>

    <?= $form->field($model, 'NOMINA_P25')->textInput() ?>

    <?= $form->field($model, 'NOMINA_CONTROLAPB')->textInput() ?>

    <?= $form->field($model, 'NOMINA_STATUSAPB')->textInput() ?>

    <?= $form->field($model, 'NOMINA_LEVEL')->textInput() ?>

    <?= $form->field($model, 'NOMINA_TIPOID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_TIPONOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_CAFECONTROL')->textInput() ?>

    <?= $form->field($model, 'NOMINA_CAFEMENU')->textInput() ?>

    <?= $form->field($model, 'NOMINA_HS1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_HS2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_HWSQ1')->textInput() ?>

    <?= $form->field($model, 'NOMINA_HWSQ2')->textInput() ?>

    <?= $form->field($model, 'NOMINA_ISO1')->textInput() ?>

    <?= $form->field($model, 'NOMINA_ISO2')->textInput() ?>

    <?= $form->field($model, 'NOMINA_TIPO_REGISTRO')->textInput() ?>

    <?= $form->field($model, 'NOMINA_CONTROLPASADAS')->textInput() ?>

    <?= $form->field($model, 'NOMINA_MAXPASADAS')->textInput() ?>

    <?= $form->field($model, 'NOMINA_DESBLOQUEA')->textInput() ?>

    <?= $form->field($model, 'NOMINA_PLACA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NOMINA_SYNC')->textInput() ?>

    <?= $form->field($model, 'NOMINA_SYNCID')->textInput() ?>

    <?= $form->field($model, 'NOMINA_ORIGEN')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
