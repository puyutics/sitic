<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Carnetizacion */
/* @var $form yii\widgets\ActiveForm */

$finfo    = new finfo(FILEINFO_MIME);
$mimeType = $finfo->buffer($model->fotografia);
$mimeType = explode('; ',$mimeType);
$mimeType = $mimeType[0];

?>

<?php if ($model->CIInfPer != NULL) { ?>
    <div class="carnetizacion-form" align="center">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-3">
        </div>
        <div class="col-lg-6">
            <div class="alert alert-success" align="center">
                <h5 align="center">Por favor revisar que todos sus datos sean correctos.
                    <br>
                    <br>
                    <code>En caso de que necesite actualizar su información o subir una nueva fotografía, debe ingresar al sistema académico</code><br><br><a target="_blank" href="https://www.uea.edu.ec/siad2">>> SIAD PREGRADO <<</a></h5>
            </div>

            <?php if ($model->fotografia == NULL) { ?>
                <div class="alert alert-danger" align="center">
                    <h4 align="center">
                        Para poder continuar y generar su Carnet Digital, debe subir una foto de perfil en el sistema SIAD Pregrado.
                        <br>
                        <br>
                        Luego de subir la foto de perfil regrese a esta página y actualícela.
                    </h4>
                </div>
            <?php } ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'username',
                    [
                        'attribute' => 'fotografia',
                        'value' => 'data:'.$mimeType.';base64,'.base64_encode($model->fotografia),
                        'format' => ['image', ['height' => '140']],
                        'options'=>['class'=>'text-left',],
                    ],
                    [
                        'label' => 'MIME Type',
                        'value' => $mimeType,
                    ],
                    //'CIInfPer',
                    'cedula_pasaporte',
                    //'TipoDocInfPer',
                    'ApellInfPer',
                    'ApellMatInfPer',
                    'NombInfPer',
                    'mailInst',
                    'FechNacimPer',
                    'idMatricula',
                    [
                        'attribute' => 'idCarr',
                        'value' => call_user_func(function($model) {
                            if ($model->idCarr == 'AGI') {
                                $carrera = 'AGROINDUSTRIAS';
                            }
                            if ($model->idCarr == 'AGR') {
                                $carrera = 'AGROPECUARIA';
                            }
                            if ($model->idCarr == 'AMB') {
                                $carrera = 'AMBIENTAL';
                            }
                            if ($model->idCarr == 'COM') {
                                $carrera = 'COMUNICACION';
                            }
                            if ($model->idCarr == 'FRT') {
                                $carrera = 'FORESTAL';
                            }
                            if ($model->idCarr == 'BLG'
                                or $model->idCarr == 'BLGEL'
                                or $model->idCarr == 'BLGEP') {
                                $carrera = 'BIOLOGIA';
                            }
                            if ($model->idCarr == 'TUR'
                                or $model->idCarr == 'LTUR'
                                or $model->idCarr == 'LTUREL'
                                or $model->idCarr == 'LTUREP') {
                                $carrera = 'TURISMO';
                            }
                            if (isset($carrera)) {
                                return $carrera;
                            } else {
                                return $model->idCarr;
                            }
                        }, $model),
                    ],
                    [
                        'attribute' => 'idPer',
                        'value' => call_user_func(function($model) {
                            $periodoDescriptivo = \app\models\Periodo::Periododescriptivo($model->idPer);
                            if (isset($periodoDescriptivo)) {
                                return $periodoDescriptivo;
                            } else {
                                return $model->idPer;
                            }
                        }, $model),
                    ],
                    'fechfinalperlec',
                    //'filefolder',
                    //'filename',
                    //'filetype',
                    //'fec_registro',
                    //'status',
                ],
                'bordered' => true,
                'condensed'=>true,
                'enableEditMode'=>false,
                'mode'=>DetailView::MODE_VIEW,
                'panel'=>[
                    'type'=>DetailView::TYPE_PRIMARY,
                ],
            ]) ?>

            <div class="alert alert-success" align="center">
                <?php echo $form->field($model, 'status')->checkBox([
                    'checked' => false,
                    'required' => true,
                    'label' => '<b>Acepto que he revisado todos mis datos y estoy de acuerdo en generar mi carnet digital.</b>'
                ]) ?>
            </div>
            <div class="form-group" align="center">
                <?= Html::submitButton('Generar Carnet', ['class' => 'btn btn-md btn-danger']) ?>
            </div>

        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php } else { ?>
    <div class="alert alert-danger" align="center">
        <h3 align="center">No existen datos del estudiante o no existe una matrícula vigente.</a></h3>
    </div>
<?php } ?>
