<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendanceSessions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdl-attendance-sessions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'attendanceid')->textInput() ?>

    <?= $form->field($model, 'groupid')->textInput() ?>

    <?= $form->field($model, 'sessdate')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'lasttaken')->textInput() ?>

    <?= $form->field($model, 'lasttakenby')->textInput() ?>

    <?= $form->field($model, 'timemodified')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'descriptionformat')->textInput() ?>

    <?= $form->field($model, 'studentscanmark')->textInput() ?>

    <?= $form->field($model, 'allowupdatestatus')->textInput() ?>

    <?= $form->field($model, 'studentsearlyopentime')->textInput() ?>

    <?= $form->field($model, 'autoassignstatus')->textInput() ?>

    <?= $form->field($model, 'studentpassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subnet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'automark')->textInput() ?>

    <?= $form->field($model, 'automarkcompleted')->textInput() ?>

    <?= $form->field($model, 'statusset')->textInput() ?>

    <?= $form->field($model, 'absenteereport')->textInput() ?>

    <?= $form->field($model, 'preventsharedip')->textInput() ?>

    <?= $form->field($model, 'preventsharediptime')->textInput() ?>

    <?= $form->field($model, 'caleventid')->textInput() ?>

    <?= $form->field($model, 'calendarevent')->textInput() ?>

    <?= $form->field($model, 'includeqrcode')->textInput() ?>

    <?= $form->field($model, 'rotateqrcode')->textInput() ?>

    <?= $form->field($model, 'rotateqrcodesecret')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'automarkcmid')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
