<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Puerta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puerta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PRT_COD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_DES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_LOC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_P')->textInput() ?>

    <?= $form->field($model, 'PRI_AREA')->textInput() ?>

    <?= $form->field($model, 'PRI_AREA1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_IP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_FEC')->textInput() ?>

    <?= $form->field($model, 'PRI_STA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_ST')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_PTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_TIPO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_VIRDI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_TI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_TE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_PRINTER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_VALCLAVE')->textInput() ?>

    <?= $form->field($model, 'PRI_SEL')->textInput() ?>

    <?= $form->field($model, 'PRI_LASTUSER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_LASTMARCA')->textInput() ?>

    <?= $form->field($model, 'PRI_OPEN')->textInput() ?>

    <?= $form->field($model, 'PRI_TIEMPO')->textInput() ?>

    <?= $form->field($model, 'PRI_VERIFICA')->textInput() ?>

    <?= $form->field($model, 'PRI_LAST_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_NOW')->textInput() ?>

    <?= $form->field($model, 'PRI_VALIDA')->textInput() ?>

    <?= $form->field($model, 'PRI_EVENTO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_ENVIA_ALERTA')->textInput() ?>

    <?= $form->field($model, 'PRI_EMPRESA')->textInput() ?>

    <?= $form->field($model, 'PRI_EMPRESA_NOM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_SERVER')->textInput() ?>

    <?= $form->field($model, 'PRI_CAM')->textInput() ?>

    <?= $form->field($model, 'PRI_CAM_IP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_CAM_PASS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_CAM_USER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_CAM_URL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_CONTROL_MARCA')->textInput() ?>

    <?= $form->field($model, 'PRI_MAC')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_MAC_KEY')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_ESTADO_LICENCIA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_RA')->textInput() ?>

    <?= $form->field($model, 'PRI_LAT')->textInput() ?>

    <?= $form->field($model, 'PRI_LON')->textInput() ?>

    <?= $form->field($model, 'PRI_PER')->textInput() ?>

    <?= $form->field($model, 'PRI_SERV')->textInput() ?>

    <?= $form->field($model, 'PRI_ACTIVAGPS')->textInput() ?>

    <?= $form->field($model, 'PRI_ALTITUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_LONGITUD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_DISTANCIA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_KEYEQUIPO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_DPTO')->textInput() ?>

    <?= $form->field($model, 'PRI_ENROLA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
