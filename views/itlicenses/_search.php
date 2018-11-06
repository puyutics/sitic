<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItLicensesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-licenses-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'license') ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'serial_number') ?>

    <?php // echo $form->field($model, 'valid_since') ?>

    <?php // echo $form->field($model, 'valid_until') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'inv_manufacturers_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
