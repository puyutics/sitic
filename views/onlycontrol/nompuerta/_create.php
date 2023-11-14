<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuerta */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="nom-puerta-form">

    <div class="col-sm-offset-2 col-sm-8"><?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nomPuertas')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(\app\models\onlycontrol\Puerta::find()
                ->all(),
                'PRT_COD',
                'datosCompletos'),
            'options' => [
                'placeholder' => 'Seleccionar',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]); ?>

        <div class="form-group" align="center">
            <?= Html::a('Regresar',
                Url::toRoute([
                    'onlycontrol/nompuerta/indexuser',
                    'oc_user_id' => base64_encode($model->NOM_ID)
                ]),
                ['class' => 'btn btn-warning']) ?>
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
