<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\InvModels */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inv-models-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'inv_manufacturers_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\InvManufacturers::find()->all(), 'id', 'manufacturer'),
        'options' => ['placeholder' => 'Seleccionar marca'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consumables')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
