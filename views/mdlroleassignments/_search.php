<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MdlRoleAssignmentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdl-role-assignments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'roleid') ?>

    <?= $form->field($model, 'contextid') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'timemodified') ?>

    <?php // echo $form->field($model, 'modifierid') ?>

    <?php // echo $form->field($model, 'component') ?>

    <?php // echo $form->field($model, 'itemid') ?>

    <?php // echo $form->field($model, 'sortorder') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
