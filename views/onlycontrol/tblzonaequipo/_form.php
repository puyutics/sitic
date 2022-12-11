<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonaequipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-zonaequipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ZM_ID')->textInput() ?>

    <?= $form->field($model, 'PRT_COD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRI_DES')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRT_SEL')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
