<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MdlRoleAssignments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdl-role-assignments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'roleid')->textInput() ?>

    <?= $form->field($model, 'contextid')->textInput() ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'timemodified')->textInput() ?>

    <?= $form->field($model, 'modifierid')->textInput() ?>

    <?= $form->field($model, 'component')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'itemid')->textInput() ?>

    <?= $form->field($model, 'sortorder')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
