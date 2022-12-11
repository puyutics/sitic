<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AuxNominaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aux-nomina-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ANOM_ID') ?>

    <?= $form->field($model, 'ANOM_APE') ?>

    <?= $form->field($model, 'ANOM_NOM') ?>

    <?= $form->field($model, 'ANOM_CED') ?>

    <?= $form->field($model, 'ANOM_EMP') ?>

    <?php // echo $form->field($model, 'ANOM_AREA') ?>

    <?php // echo $form->field($model, 'ANOM_DPTO') ?>

    <?php // echo $form->field($model, 'ANOM_CAR') ?>

    <?php // echo $form->field($model, 'ANOM_FECN') ?>

    <?php // echo $form->field($model, 'ANOM_OBS') ?>

    <?php // echo $form->field($model, 'ANOM_TIPO') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
