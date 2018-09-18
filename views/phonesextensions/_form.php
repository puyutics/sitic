<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\PhonesExtensions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phones-extensions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ipv4_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\User::find()->all(), 'username', 'username'),
        'options' => ['placeholder' => 'Seleccionar usuario'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'department_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\Department::find()->all(), 'id', 'department'),
        'options' => ['placeholder' => 'Seleccionar departamento'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'inv_purchase_item_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\InvPurchaseItem::find()->all(), 'id', 'description'),
        'options' => ['placeholder' => 'Seleccionar item'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
