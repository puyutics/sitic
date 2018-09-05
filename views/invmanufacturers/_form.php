<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvManufacturers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inv-manufacturers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
