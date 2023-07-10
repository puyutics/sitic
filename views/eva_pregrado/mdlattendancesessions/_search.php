<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\eva_pregrado\MdlAttendanceSessionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mdl-attendance-sessions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'attendanceid') ?>

    <?= $form->field($model, 'groupid') ?>

    <?= $form->field($model, 'sessdate') ?>

    <?= $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'lasttaken') ?>

    <?php // echo $form->field($model, 'lasttakenby') ?>

    <?php // echo $form->field($model, 'timemodified') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'descriptionformat') ?>

    <?php // echo $form->field($model, 'studentscanmark') ?>

    <?php // echo $form->field($model, 'allowupdatestatus') ?>

    <?php // echo $form->field($model, 'studentsearlyopentime') ?>

    <?php // echo $form->field($model, 'autoassignstatus') ?>

    <?php // echo $form->field($model, 'studentpassword') ?>

    <?php // echo $form->field($model, 'subnet') ?>

    <?php // echo $form->field($model, 'automark') ?>

    <?php // echo $form->field($model, 'automarkcompleted') ?>

    <?php // echo $form->field($model, 'statusset') ?>

    <?php // echo $form->field($model, 'absenteereport') ?>

    <?php // echo $form->field($model, 'preventsharedip') ?>

    <?php // echo $form->field($model, 'preventsharediptime') ?>

    <?php // echo $form->field($model, 'caleventid') ?>

    <?php // echo $form->field($model, 'calendarevent') ?>

    <?php // echo $form->field($model, 'includeqrcode') ?>

    <?php // echo $form->field($model, 'rotateqrcode') ?>

    <?php // echo $form->field($model, 'rotateqrcodesecret') ?>

    <?php // echo $form->field($model, 'automarkcmid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
