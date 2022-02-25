<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\RolUser */
/* @var $form yii\widgets\ActiveForm */

$anio_inicio = date('Y');
$anio_fin = ('2021');
$anio_array = [];
$i=0;
foreach (range($anio_inicio, $anio_fin, -1) as $anio) {
    $anio_array[$anio] = $anio;
    $i++;
}

$mes_array = [];
$mes_array[1] = 'Enero';
$mes_array[2] = 'Febrero';
$mes_array[3] = 'Marzo';
$mes_array[4] = 'Abril';
$mes_array[5] = 'Mayo';
$mes_array[6] = 'Junio';
$mes_array[7] = 'Julio';
$mes_array[8] = 'Agosto';
$mes_array[9] = 'Septiembre';
$mes_array[10] = 'Octubre';
$mes_array[11] = 'Noviembre';
$mes_array[12] = 'Diciembre';

?>

<div class="rol-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\UserProfile::find()
            ->orderBy('lastname ASC, firstname ASC')
            ->all(),
            'username',
            'datosCompletos'),
        'options' => ['placeholder' => 'Seleccionar Usuario'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Usuario'); ?>

    <?= $form->field($model, 'rol_tipo_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(\app\models\RolTipo::find()
            ->orderBy('nombre ASC')
            ->all(),
            'id',
            'nombre'),
        'options' => ['placeholder' => 'Seleccionar Tipo'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Tipo Rol'); ?>

    <?= $form->field($model, 'anio')->widget(Select2::classname(), [
        'data' => $anio_array,
        'options' => ['placeholder' => 'Seleccionar Año'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Año'); ?>

    <?= $form->field($model, 'mes')->widget(Select2::classname(), [
        'data' => $mes_array,
        'options' => ['placeholder' => 'Seleccionar Mes'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Mes'); ?>

    <?php //echo $form->field($model, 'filefolder')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'filetype')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'upload_rol')->widget(FileInput::classname(), [
        'options'=>[
            'accept' => 'application/pdf',
            'multiple'=>false
        ],
        'pluginOptions' => [
            'browseLabel' =>  'SUBIR ROL',
            'dropZoneEnabled' => false,
            'showUpload' => false,
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
        ]
    ]); ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>
