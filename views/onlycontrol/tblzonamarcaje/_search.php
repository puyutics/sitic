<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonamarcajeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-zonamarcaje-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ZM_ID') ?>

    <?= $form->field($model, 'ZM_DES') ?>

    <?= $form->field($model, 'ZM_SEL') ?>

    <?= $form->field($model, 'ZM_EMPE') ?>

    <?= $form->field($model, 'ZM_EMPE_NOM') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
