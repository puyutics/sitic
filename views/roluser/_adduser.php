<?php

/* @var $model */
/* @var $users */

use yii\helpers\Html;
use kartik\form\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

<div class="alert alert-warning align="center">
<?= $form->field($model, 'search')->textInput()->label('Ingrese la Cédula / Pasaporte'); ?>
</div>

<?php ActiveForm::end(); ?>
