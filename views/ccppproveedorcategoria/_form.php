<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\CcppProveedorCategoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ccpp-proveedor-categoria-form">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-lg-4 control-label'],
        ],
    ]); ?>

    <?php //= $form->field($model, 'ccpp_proveedor_id')->textInput() ?>

    <?= $form->field($model, 'ccpp_categoria_id')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\CcppCategoria::find()
            ->orderBy('categoria ASC')
            ->all(),
            'id',
            'categoria'
        ),
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php //= $form->field($model, 'status')->textInput() ?>

    <div class="form-group" align="center">
        <?= Html::submitButton('Agregar Categoría', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
