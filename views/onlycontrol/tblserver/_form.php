<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Tblserver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblserver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'PR_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_SE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_COD')->textInput() ?>

    <?= $form->field($model, 'PR_Log')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_LHora')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_IP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_FINGER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_LD')->textInput() ?>

    <?= $form->field($model, 'PR_LT')->textInput() ?>

    <?= $form->field($model, 'PR_F1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_F2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_F3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_F4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_UCOD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_CODA')->textInput() ?>

    <?= $form->field($model, 'BASE')->textInput() ?>

    <?= $form->field($model, 'PR_DOWNPER')->textInput() ?>

    <?= $form->field($model, 'PR_ANTIPASS')->textInput() ?>

    <?= $form->field($model, 'PR_RANDOM')->textInput() ?>

    <?= $form->field($model, 'VE_IP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_ANTIPASSGEN')->textInput() ?>

    <?= $form->field($model, 'PR_ESCLAVO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_COMIDADIARIA')->textInput() ?>

    <?= $form->field($model, 'PR_HUELLASMATCHER')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_RESTRICCION')->textInput() ?>

    <?= $form->field($model, 'PR_KEY_MIFARE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_CANTCOMIDA')->textInput() ?>

    <?= $form->field($model, 'PR_IP_SERVER2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_IP_SERVER3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_IP_SERVER4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PR_TIPOLOG')->textInput() ?>

    <?= $form->field($model, 'PR_GRABAIMAGENCAMARA')->textInput() ?>

    <?= $form->field($model, 'PR_DELETELOG')->textInput() ?>

    <?= $form->field($model, 'PR_CLAVE_ENCRIPTADA')->textInput() ?>

    <?= $form->field($model, 'PR_CONTROL_TIEMPO')->textInput() ?>

    <?= $form->field($model, 'PR_CONTROL_MARCA')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
