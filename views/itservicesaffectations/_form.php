<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ItServicesAffectations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-services-affectations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'it_services_id')->textInput() ?>

    <?= $form->field($model, 'it_incidents_reports_id')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'affected_users')->textInput() ?>

    <?= $form->field($model, 'affected_time')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
