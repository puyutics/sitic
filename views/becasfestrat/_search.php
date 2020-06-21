<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BecasFestratSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="becas-festrat-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idficha_sa') ?>

    <?= $form->field($model, 'cedula') ?>

    <?= $form->field($model, 'nombres_comp') ?>

    <?= $form->field($model, 'periodo') ?>

    <?= $form->field($model, 'p11') ?>

    <?php // echo $form->field($model, 'p12') ?>

    <?php // echo $form->field($model, 'p13') ?>

    <?php // echo $form->field($model, 'p14') ?>

    <?php // echo $form->field($model, 'p15') ?>

    <?php // echo $form->field($model, 'p21') ?>

    <?php // echo $form->field($model, 'p22') ?>

    <?php // echo $form->field($model, 'p23') ?>

    <?php // echo $form->field($model, 'p24') ?>

    <?php // echo $form->field($model, 'p31') ?>

    <?php // echo $form->field($model, 'p32') ?>

    <?php // echo $form->field($model, 'p33') ?>

    <?php // echo $form->field($model, 'p34') ?>

    <?php // echo $form->field($model, 'p35') ?>

    <?php // echo $form->field($model, 'p36') ?>

    <?php // echo $form->field($model, 'p37') ?>

    <?php // echo $form->field($model, 'p41') ?>

    <?php // echo $form->field($model, 'p42') ?>

    <?php // echo $form->field($model, 'p43') ?>

    <?php // echo $form->field($model, 'p44') ?>

    <?php // echo $form->field($model, 'p45') ?>

    <?php // echo $form->field($model, 'p51') ?>

    <?php // echo $form->field($model, 'p61') ?>

    <?php // echo $form->field($model, 'p62') ?>

    <?php // echo $form->field($model, 'p63') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'valoracion') ?>

    <?php // echo $form->field($model, 'Grupo') ?>

    <?php // echo $form->field($model, 'fecha_reg') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
