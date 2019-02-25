<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ItAppsCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-apps-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\ItAppsCategory::find()->all(), 'id', 'category'),
        'options' => ['placeholder' => 'Seleccionar categoría padre'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'level')->textInput(['readOnly'=>true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
