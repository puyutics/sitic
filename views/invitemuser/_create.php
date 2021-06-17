<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\InvItemUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inv-item-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\User::find()->all(), 'username', 'username'),
        'options' => ['placeholder' => 'Seleccionar usuario'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php if (isset($_GET['inv_purchase_item_id'])) { ?>
        <?= $form->field($model, 'inv_purchase_item_id')->textInput
        (['value' => $_GET['inv_purchase_item_id'],'readonly'=> true]) ?>
        <p>
        <?= print_r(\app\models\InvPurchaseItem::find()
            ->where(['id' => $_GET['inv_purchase_item_id']])
            ->one()->description,1); ?>
        </p>
    <?php } else { ?>
        <?= $form->field($model, 'inv_purchase_item_id')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(\app\models\InvPurchaseItem::find()->all(), 'id', 'description'),
            'options' => ['placeholder' => 'Seleccionar item'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]); ?>
    <?php } ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'date_asigned')->widget(DatePicker::className(), [
        'options' => ['placeholder' => 'Seleccionar fecha'],
        'pluginOptions' => [
            'autoclose'=>true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'date_released')->widget(DatePicker::className(), [
        'options' => ['placeholder' => 'Seleccionar fecha'],
        'pluginOptions' => [
            'autoclose'=>true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
