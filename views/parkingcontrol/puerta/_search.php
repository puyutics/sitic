<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\PuertaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puerta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'PRT_COD') ?>

    <?= $form->field($model, 'PRI_DES') ?>

    <?= $form->field($model, 'PRI_LOC') ?>

    <?= $form->field($model, 'PRI_P') ?>

    <?= $form->field($model, 'PRI_AREA') ?>

    <?php // echo $form->field($model, 'PRI_AREA1') ?>

    <?php // echo $form->field($model, 'PRI_IP') ?>

    <?php // echo $form->field($model, 'PRI_FEC') ?>

    <?php // echo $form->field($model, 'PRI_STA') ?>

    <?php // echo $form->field($model, 'PRI_ST') ?>

    <?php // echo $form->field($model, 'PRI_PTO') ?>

    <?php // echo $form->field($model, 'PRI_TIPO') ?>

    <?php // echo $form->field($model, 'PRI_VIRDI') ?>

    <?php // echo $form->field($model, 'PRI_TI') ?>

    <?php // echo $form->field($model, 'PRI_TE') ?>

    <?php // echo $form->field($model, 'PRI_PRINTER') ?>

    <?php // echo $form->field($model, 'PRI_VALCLAVE') ?>

    <?php // echo $form->field($model, 'PRI_TTRAN') ?>

    <?php // echo $form->field($model, 'PRI_UTRAN') ?>

    <?php // echo $form->field($model, 'PRI_OPEN') ?>

    <?php // echo $form->field($model, 'PRI_OPENTIME') ?>

    <?php // echo $form->field($model, 'PRI_LASTUSER') ?>

    <?php // echo $form->field($model, 'PRI_LASTMARCA') ?>

    <?php // echo $form->field($model, 'PRI_TIEMPO') ?>

    <?php // echo $form->field($model, 'PRI_VERIFICA') ?>

    <?php // echo $form->field($model, 'PRI_LAST_ID') ?>

    <?php // echo $form->field($model, 'PRI_NOW') ?>

    <?php // echo $form->field($model, 'PRI_VALIDA') ?>

    <?php // echo $form->field($model, 'PRI_EVENTO') ?>

    <?php // echo $form->field($model, 'PRI_ENVIA_ALERTA') ?>

    <?php // echo $form->field($model, 'PRI_EMPRESA') ?>

    <?php // echo $form->field($model, 'PRI_EMPRESA_NOM') ?>

    <?php // echo $form->field($model, 'PRI_SEL') ?>

    <?php // echo $form->field($model, 'PRI_CAM') ?>

    <?php // echo $form->field($model, 'PRI_CAM_IP') ?>

    <?php // echo $form->field($model, 'PRI_CAM_PASS') ?>

    <?php // echo $form->field($model, 'PRI_CAM_USER') ?>

    <?php // echo $form->field($model, 'PRI_PARQUEO') ?>

    <?php // echo $form->field($model, 'PRI_ENTRY') ?>

    <?php // echo $form->field($model, 'PRI_IDSTATION') ?>

    <?php // echo $form->field($model, 'PRI_LASTRFID') ?>

    <?php // echo $form->field($model, 'PRI_ULTIMALECTURA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
