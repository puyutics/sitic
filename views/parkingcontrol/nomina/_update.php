<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\Nomina */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nomina-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?php echo $form->field($model, 'NOMINA_ID')->textInput(['readOnly' => true, 'maxlength' => true]) ?>

    <?php echo $form->field($model, 'NOMINA_PLACA')->textInput(['readOnly' => true,'maxlength' => true]) ?>

    <?php echo $form->field($model, 'NOMINA_APE')->textInput(['readOnly' => true, 'maxlength' => true]) ?>

    <?php echo $form->field($model, 'NOMINA_NOM')->textInput(['readOnly' => true, 'maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_CLAVE')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_TELEFONO')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_SALVOCONDUCTO')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_COD')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'NOMINA_TIPO')->textInput(['readOnly' => true, 'maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_CAL')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_AREA')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_DEP')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_CAL1')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_AREA1')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_DEP1')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_FING')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_FSAL')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_SUEL')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_COM')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_AUTI')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_ES')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_OBS')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_EMP')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_FINGER')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_F1')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_CED')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_FIR')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_HD1')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_HF1')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_HI1')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_HD2')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_HF2')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_HI2')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_SEL')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_EMPC')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_EMPE')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_P1')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P2')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P3')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P4')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P5')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P6')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P7')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P8')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P9')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P10')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P11')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P12')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P13')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P14')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P15')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P16')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P17')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P18')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P19')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P20')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_DOC')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_PLA')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_F')->textInput() ?>

    <?php echo $form->field($model, 'NOMINA_CARD')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_FCARD')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_OBS1')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_NOW')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_CAFE')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_AUTO')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_P21')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P22')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P23')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P24')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_P25')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_CONTROLAPB')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_STATUSAPB')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_LEVEL')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_TIPOID')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_TIPONOM')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_CAFECONTROL')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_CAFEMENU')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_HS1')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_HS2')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'NOMINA_HWSQ1')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_HWSQ2')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_ISO1')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_ISO2')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_TIPO_REGISTRO')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_CONTROLPASADAS')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_MAXPASADAS')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_DESBLOQUEA')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_SYNC')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_SYNCID')->textInput() ?>

    <?php //echo $form->field($model, 'NOMINA_ORIGEN')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-lg btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
