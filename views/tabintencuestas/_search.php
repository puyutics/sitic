<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntEncuestasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tab-int-encuestas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'ObjectID') ?>

    <?= $form->field($model, 'GlobalID') ?>

    <?= $form->field($model, 'CreationDate') ?>

    <?= $form->field($model, 'Creator') ?>

    <?php // echo $form->field($model, 'EditDate') ?>

    <?php // echo $form->field($model, 'Editor') ?>

    <?php // echo $form->field($model, 'CedulaPasaporte') ?>

    <?php // echo $form->field($model, 'Nombres') ?>

    <?php // echo $form->field($model, 'Apellidos') ?>

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'Campus') ?>

    <?php // echo $form->field($model, 'Carrera') ?>

    <?php // echo $form->field($model, 'Telefono') ?>

    <?php // echo $form->field($model, 'Operadora') ?>

    <?php // echo $form->field($model, 'Internet') ?>

    <?php // echo $form->field($model, 'TipoInternet') ?>

    <?php // echo $form->field($model, 'Computador') ?>

    <?php // echo $form->field($model, 'TipoComputador') ?>

    <?php // echo $form->field($model, 'PropiedadComputador') ?>

    <?php // echo $form->field($model, 'x') ?>

    <?php // echo $form->field($model, 'y') ?>

    <?php // echo $form->field($model, 'Beneficio') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
