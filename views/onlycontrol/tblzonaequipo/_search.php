<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonaequipoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-zonaequipo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AREA_ZM_ID') ?>

    <?= $form->field($model, 'ZM_ID') ?>

    <?= $form->field($model, 'PRT_COD') ?>

    <?= $form->field($model, 'PRI_DES') ?>

    <?= $form->field($model, 'PRT_SEL') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
