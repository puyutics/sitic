<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ItServicesResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="it-services-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (isset($_GET['it_services_id'])) { ?>
        <?= $form->field($model, 'it_services_id')->textInput
        (['value' => $_GET['it_services_id'],'readonly'=> true]) ?>
        <p>
            <?= print_r(\app\models\ItServices::find()
                ->where(['id' => $_GET['it_services_id']])
                ->one()->service,1); ?>
        </p>
    <?php } else { ?>
        <?= $form->field($model, 'it_services_id')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(\app\models\ItServices::find()->all(),
                'id', 'service'),
            'options' => ['placeholder' => 'Seleccionar Servicio'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    <?php } ?>

    <?php echo $form->field($model, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
        'yearStart' => 0,
        'yearEnd' => -20,
    ]);
    ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'percent')->textInput()->label('PORCENTAJE (Ej: 99.99)') ?>

    <?= $form->field($model, 'username')->textInput(
        [
            'maxlength' => true,
            'value' => Yii::$app->user->identity->username,
            'readOnly' => true
        ]
    ) ?>

    <?= $form->field($model, 'date')->textInput(
        [
            'maxlength' => true,
            'readOnly' => true,
            'value' => date('Y-m-d H:i:s')
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
