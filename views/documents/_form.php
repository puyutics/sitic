<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Documents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'attachment')->widget(FileInput::classname(), [
        'options'=>[
            'accept' => 'pdf',
            'multiple'=>false
        ],
        'pluginOptions' => [
            //'uploadUrl' => Url::to(['uploads/documents']),
            'browseLabel' =>  'ARCHIVO PDF',
            'dropZoneEnabled' => false,
            'showUpload' => false,
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
        ]
    ]); ?>

    <?php //= $form->field($model, 'attachment')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'filename')->textInput([
        'value' => $_GET['external_type'] . '@' . $_GET['external_id']
            . '@' . md5(date('Y-m-d H:i:s')),
        'readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'filetype')->textInput(['maxlength' => true,
        'value' => 'pdf',
        'readOnly' => true
    ]) ?>

    <?= $form->field($model, 'date')->textInput(
        [
            'maxlength' => true,
            'readOnly' => true,
            'value' => date('Y-m-d H:i:s')
        ]
    ) ?>

    <?php if (isset($_GET['external_id'])) { ?>
        <?= $form->field($model, 'external_id')->textInput
        (['value' => $_GET['external_id'],'readonly'=> true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'external_id')->textInput() ?>
    <?php } ?>

    <?php if (isset($_GET['external_type'])) { ?>
        <?= $form->field($model, 'external_type')->textInput
        (['value' => $_GET['external_type'],'readonly'=> true]) ?>
    <?php } else { ?>
        <?= $form->field($model, 'external_type')->textInput() ?>
    <?php } ?>

    <?= $form->field($model, 'username')->textInput(
        [
            'maxlength' => true,
            'value' => Yii::$app->user->identity->username,
            'readOnly' => true
        ]
    ) ?>

    <?= $form->field($model, 'status')->dropDownList(['1'=>'ACTIVO','0'=>'INACTIVO']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
