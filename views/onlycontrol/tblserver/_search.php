<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblserverSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblserver-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PR_ID') ?>

    <?= $form->field($model, 'PR_SE') ?>

    <?= $form->field($model, 'PR_COD') ?>

    <?= $form->field($model, 'PR_Log') ?>

    <?= $form->field($model, 'PR_LHora') ?>

    <?php // echo $form->field($model, 'PR_IP') ?>

    <?php // echo $form->field($model, 'PR_FINGER') ?>

    <?php // echo $form->field($model, 'PR_LD') ?>

    <?php // echo $form->field($model, 'PR_LT') ?>

    <?php // echo $form->field($model, 'PR_F1') ?>

    <?php // echo $form->field($model, 'PR_F2') ?>

    <?php // echo $form->field($model, 'PR_F3') ?>

    <?php // echo $form->field($model, 'PR_F4') ?>

    <?php // echo $form->field($model, 'PR_UCOD') ?>

    <?php // echo $form->field($model, 'PR_CODA') ?>

    <?php // echo $form->field($model, 'BASE') ?>

    <?php // echo $form->field($model, 'PR_DOWNPER') ?>

    <?php // echo $form->field($model, 'PR_ANTIPASS') ?>

    <?php // echo $form->field($model, 'PR_RANDOM') ?>

    <?php // echo $form->field($model, 'VE_IP') ?>

    <?php // echo $form->field($model, 'PR_ANTIPASSGEN') ?>

    <?php // echo $form->field($model, 'PR_ESCLAVO') ?>

    <?php // echo $form->field($model, 'PR_COMIDADIARIA') ?>

    <?php // echo $form->field($model, 'PR_HUELLASMATCHER') ?>

    <?php // echo $form->field($model, 'PR_RESTRICCION') ?>

    <?php // echo $form->field($model, 'PR_KEY_MIFARE') ?>

    <?php // echo $form->field($model, 'PR_CANTCOMIDA') ?>

    <?php // echo $form->field($model, 'PR_IP_SERVER2') ?>

    <?php // echo $form->field($model, 'PR_IP_SERVER3') ?>

    <?php // echo $form->field($model, 'PR_IP_SERVER4') ?>

    <?php // echo $form->field($model, 'PR_TIPOLOG') ?>

    <?php // echo $form->field($model, 'PR_GRABAIMAGENCAMARA') ?>

    <?php // echo $form->field($model, 'PR_DELETELOG') ?>

    <?php // echo $form->field($model, 'PR_CLAVE_ENCRIPTADA') ?>

    <?php // echo $form->field($model, 'PR_CONTROL_TIEMPO') ?>

    <?php // echo $form->field($model, 'PR_CONTROL_MARCA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
