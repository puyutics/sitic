<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\PuertaSearch */
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

    <?php // echo $form->field($model, 'PRI_SEL') ?>

    <?php // echo $form->field($model, 'PRI_LASTUSER') ?>

    <?php // echo $form->field($model, 'PRI_LASTMARCA') ?>

    <?php // echo $form->field($model, 'PRI_OPEN') ?>

    <?php // echo $form->field($model, 'PRI_TIEMPO') ?>

    <?php // echo $form->field($model, 'PRI_VERIFICA') ?>

    <?php // echo $form->field($model, 'PRI_LAST_ID') ?>

    <?php // echo $form->field($model, 'PRI_NOW') ?>

    <?php // echo $form->field($model, 'PRI_VALIDA') ?>

    <?php // echo $form->field($model, 'PRI_EVENTO') ?>

    <?php // echo $form->field($model, 'PRI_ENVIA_ALERTA') ?>

    <?php // echo $form->field($model, 'PRI_EMPRESA') ?>

    <?php // echo $form->field($model, 'PRI_EMPRESA_NOM') ?>

    <?php // echo $form->field($model, 'PRI_SERVER') ?>

    <?php // echo $form->field($model, 'PRI_CAM') ?>

    <?php // echo $form->field($model, 'PRI_CAM_IP') ?>

    <?php // echo $form->field($model, 'PRI_CAM_PASS') ?>

    <?php // echo $form->field($model, 'PRI_CAM_USER') ?>

    <?php // echo $form->field($model, 'PRI_CAM_URL') ?>

    <?php // echo $form->field($model, 'PRI_CONTROL_MARCA') ?>

    <?php // echo $form->field($model, 'PRI_MAC') ?>

    <?php // echo $form->field($model, 'PRI_MAC_KEY') ?>

    <?php // echo $form->field($model, 'PRI_ESTADO_LICENCIA') ?>

    <?php // echo $form->field($model, 'PRI_RA') ?>

    <?php // echo $form->field($model, 'PRI_LAT') ?>

    <?php // echo $form->field($model, 'PRI_LON') ?>

    <?php // echo $form->field($model, 'PRI_PER') ?>

    <?php // echo $form->field($model, 'PRI_SERV') ?>

    <?php // echo $form->field($model, 'PRI_ACTIVAGPS') ?>

    <?php // echo $form->field($model, 'PRI_ALTITUD') ?>

    <?php // echo $form->field($model, 'PRI_LONGITUD') ?>

    <?php // echo $form->field($model, 'PRI_DISTANCIA') ?>

    <?php // echo $form->field($model, 'PRI_KEYEQUIPO') ?>

    <?php // echo $form->field($model, 'PRI_DPTO') ?>

    <?php // echo $form->field($model, 'PRI_ENROLA') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
