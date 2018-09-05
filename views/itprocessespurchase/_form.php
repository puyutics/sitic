<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ItProcessesPurchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-processes-purchase-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (isset($_GET['it_processes_id'])) { ?>
        <?= $form->field($model, 'it_processes_id')->textInput
        (['value' => $_GET['it_processes_id'],'readonly'=> true]) ?>
        <p>
            <?= print_r(\app\models\ItProcesses::find()
                ->where(['id' => $_GET['it_processes_id']])
                ->one()->process,1); ?>
        </p>
    <?php } else { ?>
        <?= $form->field($model, 'it_processes_id')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(\app\models\ItProcesses::find()->all(), 'id', 'process'),
            'options' => ['placeholder' => 'Seleccionar proceso'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?php } ?>

    <?php if (isset($_GET['inv_purchase_id'])) { ?>
        <?= $form->field($model, 'inv_purchase_id')->textInput
        (['value' => $_GET['inv_purchase_id'],'readonly'=> true]) ?>
        <p>
            <?= print_r(\app\models\InvPurchase::find()
                ->where(['id' => $_GET['inv_purchase_id']])
                ->one()->description,1); ?>
        </p>
    <?php } else { ?>
        <?= $form->field($model, 'inv_purchase_id')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(\app\models\InvPurchase::find()->all(), 'id', 'description'),
            'options' => ['placeholder' => 'Seleccionar compra'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?php } ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
