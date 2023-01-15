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

        <div class="alert alert-danger" align="center">
            <?php echo $form->field($model, 'revocar_puerta')->checkBox([
                'checked' => false,
                'required' => true,
                'label' => '<b>Confirmo que deseo eliminar el acceso a esta puerta</b>'
            ]) ?>
        </div>

        <div class="form-group" align="center">
            <?= Html::submitButton('Eliminar', ['class' => 'btn btn-danger']) ?>
        </div>

        <div class="form-group" align="center">
            <?= Html::a('Regresar',
                Url::toRoute([
                    'onlycontrol/nompuerta/indexuser',
                    'oc_user_id' => base64_encode($model->NOM_ID)
                ]),
                ['class' => 'btn btn-warning']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
