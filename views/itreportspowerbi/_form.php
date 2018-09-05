<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ItReportsPowerbi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-reports-powerbi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'html_iframe')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'username')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\User::find()->all(), 'username', 'username'),
        'options' => ['placeholder' => 'Seleccionar usuario'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
