<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\InvPurchaseItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inv-purchase-item-form">

    <?php $fieldOptions3 = [
        'options' => ['class' => 'form-group has-feedback'],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-user form-control-feedback'></span>"
    ]; ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'amount')->textInput(['value' => 0]) ?>

    <?= $form->field($model, 'control_code')->textInput(['value' => 0,'maxlength' => true]) ?>

    <?= $form->field($model, 'inv_models_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(app\models\InvModels::find()->all(), 'id', 'model'),
        'options' => ['placeholder' => 'Seleccionar modelo'],
        'pluginOptions' => [
            'allowClear' => true,
            'todayBtn' => true
        ],
    ]); ?>

    <?= $form->field($model, 'serial_number')->textInput(['value' => 'S/N','maxlength' => true]) ?>

    <?php if (isset($_GET['id_invpurchase'])) { ?>
        <?= $form->field($model, 'inv_purchase_id')->textInput
            (['value' => $_GET['id_invpurchase'],'readonly'=> true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'inv_purchase_id')->widget(Select2::classname(), [
            //'value' => 'inv_purchase_id',
            'data' =>ArrayHelper::map(app\models\InvPurchase::find()->all(), 'id', 'code'),
            'options' => ['placeholder' => 'Seleccionar compra'],
            'pluginOptions' => [
                'allowClear' => true,
                'todayBtn' => true
            ],
        ]); ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
