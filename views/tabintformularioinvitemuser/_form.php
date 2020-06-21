<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormularioInvItemUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tab-int-formulario-inv-item-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tab_int_formulario_id')->textInput() ?>

    <?= $form->field($model, 'inv_item_user_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
