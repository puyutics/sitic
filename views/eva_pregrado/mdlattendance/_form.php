<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdl-attendance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade')->textInput() ?>

    <?= $form->field($model, 'timemodified')->textInput() ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'introformat')->textInput() ?>

    <?= $form->field($model, 'subnet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sessiondetailspos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'showsessiondetails')->textInput() ?>

    <?= $form->field($model, 'showextrauserdetails')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
