<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormularioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tab-int-formulario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'autocomplete' => 'off'
        ],
    ]); ?>

    <?php //= $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'fecha_inicio')->widget(DateTimePicker::className(), [
        'options' => [
            'placeholder' => 'Seleccionar fecha',
        ],
        'pluginOptions' => [
            'autoclose'=>true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd HH:ii'
        ]
    ]); ?>

    <?php echo $form->field($model, 'fecha_fin')->widget(DateTimePicker::className(), [
        'options' => [
            'placeholder' => 'Seleccionar fecha',
        ],
        'pluginOptions' => [
            'autoclose'=>true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd HH:ii'
        ]
    ]); ?>

    <?= $form->field($model, 'cedula')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\TabIntFormulario::find()
            ->orderBy('cedula ASC')
            ->all(),
            'cedula',
                function ($model) {
                    return $model->cedula .
                        ' -- ' .
                        $model->apellidos .
                        ' ' .
                        $model->nombres;
                }
            ),
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Beneficiario'); ?>

    <?php //= $form->field($model, 'username') ?>

    <?php //= $form->field($model, 'email') ?>

    <?php //= $form->field($model, 'nombres') ?>

    <?php //= $form->field($model, 'apellidos') ?>

    <?php // echo $form->field($model, 'codigo_postal') ?>

    <?= $form->field($model, 'provincia')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\TabIntFormulario::find()
            ->orderBy('provincia ASC')
            ->all(),
            'provincia',
            'provincia'
        ),
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php //= $form->field($model, 'canton') ?>

    <?php //= $form->field($model, 'parroquia') ?>

    <?php // echo $form->field($model, 'calle_principal') ?>

    <?php // echo $form->field($model, 'calle_secundaria') ?>

    <?php // echo $form->field($model, 'referencia_texto') ?>

    <?php // echo $form->field($model, 'referencia_foto') ?>

    <?php // echo $form->field($model, 'cel_contacto') ?>

    <?php // echo $form->field($model, 'tel_contacto') ?>

    <?php // echo $form->field($model, 'siad_matriculado') ?>

    <?php // echo $form->field($model, 'siad_semestre') ?>

    <?php // echo $form->field($model, 'siad_carrera') ?>

    <?php // echo $form->field($model, 'ficha_escasos_recursos') ?>

    <?= $form->field($model, 'encuesta_beneficiario')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\TabIntFormulario::find()
            ->orderBy('encuesta_beneficiario ASC')
            ->all(),
            'encuesta_beneficiario',
            'encuesta_beneficiario'
        ),
        'options' => ['placeholder' => 'Seleccionar'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Recursos Académicos'); ?>

    <?php // echo $form->field($model, 'cobertura') ?>

    <?php // echo $form->field($model, 'smartphone') ?>

    <?php // echo $form->field($model, 'responsabilidad_uso') ?>

    <?php // echo $form->field($model, 'condiciones') ?>

    <?php // echo $form->field($model, 'doc_cedula_pasaporte') ?>

    <?php // echo $form->field($model, 'doc_servicio_basico') ?>

    <?php // echo $form->field($model, 'doc_responsabilidad_uso') ?>

    <?php // echo $form->field($model, 'doc_contrato') ?>

    <?php // echo $form->field($model, 'qrcode') ?>

    <?php // echo $form->field($model, 'fec_registro') ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), [
        'data' =>ArrayHelper::map(\app\models\TabIntFormulario::find()
            ->orderBy('status DESC')
            ->all(),
            'status',
            function ($model) {
                if ($model->status == 1) {
                    return 'CONTRATO CREADO';
                } elseif ($model->status == 2) {
                    return 'BENEFICIO ENTREGADO';
                } elseif ($model->status == 3) {
                    return 'ENVIADO POR SERVIENTREGA';
                } elseif ($model->status == 4) {
                    return 'ENVIADO SEDE EL PANGUI';
                } elseif ($model->status == 5) {
                    return 'ENVIADO SEDE LAGO AGRIO';
                } elseif ($model->status == 6) {
                    return 'ENTREGADO SEDE EL PANGUI';
                } elseif ($model->status == 7) {
                    return 'ENTREGADO SEDE LAGO AGRIO';
                }
            }
        ),
        'options' => ['placeholder' => 'Seleccionar estado'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('Estado'); ?>

    <div class="form-group" align="center">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="btn btn-outline-secondary">Reset</span>',
            Url::to(['/tabintformulario/index']),
            ['title' => Yii::t('yii', 'Reset')]);
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
