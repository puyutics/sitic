<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Puerta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puerta-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?php //echo $form->field($model, 'PRT_COD')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'PRI_DES')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'PRI_LOC')->textInput(['readOnly' => true, 'maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_P')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_AREA')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_AREA1')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'PRI_IP')->textInput(['readOnly' => true, 'maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_FEC')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_STA')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_ST')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_PTO')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_TIPO')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_VIRDI')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_TI')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_TE')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_PRINTER')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_VALCLAVE')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_SEL')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_LASTUSER')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_LASTMARCA')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_OPEN')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_TIEMPO')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_VERIFICA')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_LAST_ID')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_NOW')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_VALIDA')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_EVENTO')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_ENVIA_ALERTA')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_EMPRESA')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_EMPRESA_NOM')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_SERVER')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_CAM')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_CAM_IP')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_CAM_PASS')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_CAM_USER')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_CAM_URL')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_CONTROL_MARCA')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_MAC')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_MAC_KEY')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_ESTADO_LICENCIA')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_RA')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_LAT')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_LON')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_PER')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_SERV')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_ACTIVAGPS')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_ALTITUD')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_LONGITUD')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_DISTANCIA')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_KEYEQUIPO')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'PRI_DPTO')->textInput() ?>

    <?php //echo $form->field($model, 'PRI_ENROLA')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-lg btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
