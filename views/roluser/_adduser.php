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

<script type="text/javascript">
    function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
    }
    document.onkeypress = stopRKey;
</script>