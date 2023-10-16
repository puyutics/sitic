<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\NominaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nomina-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'NOMINA_ID') ?>

    <?= $form->field($model, 'NOMINA_APE') ?>

    <?= $form->field($model, 'NOMINA_NOM') ?>

    <?= $form->field($model, 'NOMINA_CLAVE') ?>

    <?= $form->field($model, 'NOMINA_TELEFONO') ?>

    <?php // echo $form->field($model, 'NOMINA_SALVOCONDUCTO') ?>

    <?php // echo $form->field($model, 'NOMINA_COD') ?>

    <?php // echo $form->field($model, 'NOMINA_TIPO') ?>

    <?php // echo $form->field($model, 'NOMINA_CAL') ?>

    <?php // echo $form->field($model, 'NOMINA_AREA') ?>

    <?php // echo $form->field($model, 'NOMINA_DEP') ?>

    <?php // echo $form->field($model, 'NOMINA_CAL1') ?>

    <?php // echo $form->field($model, 'NOMINA_AREA1') ?>

    <?php // echo $form->field($model, 'NOMINA_DEP1') ?>

    <?php // echo $form->field($model, 'NOMINA_FING') ?>

    <?php // echo $form->field($model, 'NOMINA_FSAL') ?>

    <?php // echo $form->field($model, 'NOMINA_SUEL') ?>

    <?php // echo $form->field($model, 'NOMINA_COM') ?>

    <?php // echo $form->field($model, 'NOMINA_AUTI') ?>

    <?php // echo $form->field($model, 'NOMINA_ES') ?>

    <?php // echo $form->field($model, 'NOMINA_OBS') ?>

    <?php // echo $form->field($model, 'NOMINA_EMP') ?>

    <?php // echo $form->field($model, 'NOMINA_FINGER') ?>

    <?php // echo $form->field($model, 'NOMINA_F1') ?>

    <?php // echo $form->field($model, 'NOMINA_CED') ?>

    <?php // echo $form->field($model, 'NOMINA_FIR') ?>

    <?php // echo $form->field($model, 'NOMINA_HD1') ?>

    <?php // echo $form->field($model, 'NOMINA_HF1') ?>

    <?php // echo $form->field($model, 'NOMINA_HI1') ?>

    <?php // echo $form->field($model, 'NOMINA_HD2') ?>

    <?php // echo $form->field($model, 'NOMINA_HF2') ?>

    <?php // echo $form->field($model, 'NOMINA_HI2') ?>

    <?php // echo $form->field($model, 'NOMINA_SEL') ?>

    <?php // echo $form->field($model, 'NOMINA_EMPC') ?>

    <?php // echo $form->field($model, 'NOMINA_EMPE') ?>

    <?php // echo $form->field($model, 'NOMINA_P1') ?>

    <?php // echo $form->field($model, 'NOMINA_P2') ?>

    <?php // echo $form->field($model, 'NOMINA_P3') ?>

    <?php // echo $form->field($model, 'NOMINA_P4') ?>

    <?php // echo $form->field($model, 'NOMINA_P5') ?>

    <?php // echo $form->field($model, 'NOMINA_P6') ?>

    <?php // echo $form->field($model, 'NOMINA_P7') ?>

    <?php // echo $form->field($model, 'NOMINA_P8') ?>

    <?php // echo $form->field($model, 'NOMINA_P9') ?>

    <?php // echo $form->field($model, 'NOMINA_P10') ?>

    <?php // echo $form->field($model, 'NOMINA_P11') ?>

    <?php // echo $form->field($model, 'NOMINA_P12') ?>

    <?php // echo $form->field($model, 'NOMINA_P13') ?>

    <?php // echo $form->field($model, 'NOMINA_P14') ?>

    <?php // echo $form->field($model, 'NOMINA_P15') ?>

    <?php // echo $form->field($model, 'NOMINA_P16') ?>

    <?php // echo $form->field($model, 'NOMINA_P17') ?>

    <?php // echo $form->field($model, 'NOMINA_P18') ?>

    <?php // echo $form->field($model, 'NOMINA_P19') ?>

    <?php // echo $form->field($model, 'NOMINA_P20') ?>

    <?php // echo $form->field($model, 'NOMINA_DOC') ?>

    <?php // echo $form->field($model, 'NOMINA_PLA') ?>

    <?php // echo $form->field($model, 'NOMINA_F') ?>

    <?php // echo $form->field($model, 'NOMINA_CARD') ?>

    <?php // echo $form->field($model, 'NOMINA_FCARD') ?>

    <?php // echo $form->field($model, 'NOMINA_OBS1') ?>

    <?php // echo $form->field($model, 'NOMINA_NOW') ?>

    <?php // echo $form->field($model, 'NOMINA_CAFE') ?>

    <?php // echo $form->field($model, 'NOMINA_AUTO') ?>

    <?php // echo $form->field($model, 'NOMINA_P21') ?>

    <?php // echo $form->field($model, 'NOMINA_P22') ?>

    <?php // echo $form->field($model, 'NOMINA_P23') ?>

    <?php // echo $form->field($model, 'NOMINA_P24') ?>

    <?php // echo $form->field($model, 'NOMINA_P25') ?>

    <?php // echo $form->field($model, 'NOMINA_CONTROLAPB') ?>

    <?php // echo $form->field($model, 'NOMINA_STATUSAPB') ?>

    <?php // echo $form->field($model, 'NOMINA_LEVEL') ?>

    <?php // echo $form->field($model, 'NOMINA_TIPOID') ?>

    <?php // echo $form->field($model, 'NOMINA_TIPONOM') ?>

    <?php // echo $form->field($model, 'NOMINA_CAFECONTROL') ?>

    <?php // echo $form->field($model, 'NOMINA_CAFEMENU') ?>

    <?php // echo $form->field($model, 'NOMINA_HS1') ?>

    <?php // echo $form->field($model, 'NOMINA_HS2') ?>

    <?php // echo $form->field($model, 'NOMINA_HWSQ1') ?>

    <?php // echo $form->field($model, 'NOMINA_HWSQ2') ?>

    <?php // echo $form->field($model, 'NOMINA_ISO1') ?>

    <?php // echo $form->field($model, 'NOMINA_ISO2') ?>

    <?php // echo $form->field($model, 'NOMINA_TIPO_REGISTRO') ?>

    <?php // echo $form->field($model, 'NOMINA_CONTROLPASADAS') ?>

    <?php // echo $form->field($model, 'NOMINA_MAXPASADAS') ?>

    <?php // echo $form->field($model, 'NOMINA_DESBLOQUEA') ?>

    <?php // echo $form->field($model, 'NOMINA_PLACA') ?>

    <?php // echo $form->field($model, 'NOMINA_SYNC') ?>

    <?php // echo $form->field($model, 'NOMINA_SYNCID') ?>

    <?php // echo $form->field($model, 'NOMINA_ORIGEN') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
