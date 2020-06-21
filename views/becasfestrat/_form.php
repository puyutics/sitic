<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BecasFestrat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="becas-festrat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cedula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres_comp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'periodo')->textInput() ?>

    <?= $form->field($model, 'p11')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p12')->textInput() ?>

    <?= $form->field($model, 'p13')->textInput() ?>

    <?= $form->field($model, 'p14')->textInput() ?>

    <?= $form->field($model, 'p15')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'p21')->textInput() ?>

    <?= $form->field($model, 'p22')->textInput() ?>

    <?= $form->field($model, 'p23')->textInput() ?>

    <?= $form->field($model, 'p24')->textInput() ?>

    <?= $form->field($model, 'p31')->textInput() ?>

    <?= $form->field($model, 'p32')->textInput() ?>

    <?= $form->field($model, 'p33')->textInput() ?>

    <?= $form->field($model, 'p34')->textInput() ?>

    <?= $form->field($model, 'p35')->textInput() ?>

    <?= $form->field($model, 'p36')->textInput() ?>

    <?= $form->field($model, 'p37')->textInput() ?>

    <?= $form->field($model, 'p41')->textInput() ?>

    <?= $form->field($model, 'p42')->textInput() ?>

    <?= $form->field($model, 'p43')->textInput() ?>

    <?= $form->field($model, 'p44')->textInput() ?>

    <?= $form->field($model, 'p45')->textInput() ?>

    <?= $form->field($model, 'p51')->textInput() ?>

    <?= $form->field($model, 'p61')->textInput() ?>

    <?= $form->field($model, 'p62')->textInput() ?>

    <?= $form->field($model, 'p63')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'valoracion')->textInput() ?>

    <?= $form->field($model, 'Grupo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_reg')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
