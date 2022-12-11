<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\ExternoeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="externoe-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'EMPE_ID') ?>

    <?= $form->field($model, 'EMPE_NOM') ?>

    <?= $form->field($model, 'EMPE_DIR') ?>

    <?= $form->field($model, 'EMPE_RUC') ?>

    <?= $form->field($model, 'EMPE_REP') ?>

    <?php // echo $form->field($model, 'EMPE_TELF') ?>

    <?php // echo $form->field($model, 'EMPE_FAX') ?>

    <?php // echo $form->field($model, 'EMPE_WEB') ?>

    <?php // echo $form->field($model, 'EMPE_CONT') ?>

    <?php // echo $form->field($model, 'EMPE_OBS') ?>

    <?php // echo $form->field($model, 'EMPE_CODE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
