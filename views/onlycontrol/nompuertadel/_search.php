<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuertaDelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nom-puerta-del-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'NOM_ID') ?>

    <?= $form->field($model, 'PUER_ID') ?>

    <?= $form->field($model, 'FLAG_T') ?>

    <?= $form->field($model, 'TURN_ESTADO_DEL') ?>

    <?= $form->field($model, 'TURN_FECHA_DEL') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
