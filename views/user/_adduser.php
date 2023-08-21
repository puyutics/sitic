<?php

/* @var $model */
/* @var $users */

use kartik\form\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

<div class="alert alert-warning align="center">
<?php try {
    echo $form->field($model, 'search')
        ->textInput()
        ->label('Ingrese la Cédula / Pasaporte');
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
} ?>
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