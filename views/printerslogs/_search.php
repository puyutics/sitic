<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PrintersLogsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="printers-logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'pages') ?>

    <?= $form->field($model, 'copies') ?>

    <?php // echo $form->field($model, 'printer') ?>

    <?php // echo $form->field($model, 'document') ?>

    <?php // echo $form->field($model, 'client') ?>

    <?php // echo $form->field($model, 'paper') ?>

    <?php // echo $form->field($model, 'protocol') ?>

    <?php // echo $form->field($model, 'high') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'duplex') ?>

    <?php // echo $form->field($model, 'grayscale') ?>

    <?php // echo $form->field($model, 'size') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
