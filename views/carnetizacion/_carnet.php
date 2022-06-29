<?php

/* @var $model app\controllers\CarnetizacionController */

use yii\helpers\Html;
use yii\helpers\Url;

//Datos de la Carrera
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

//Datos del período
$periodoDescriptivo = \app\models\Periodo::Periododescriptivo($model->idPer);

//Crear URL para el código QR
$url = Url::to('@web/index.php?r=carnetizacion/view&id='.base64_encode($model->id), 'https');

$finfo    = new finfo(FILEINFO_MIME);
$mimeType = $finfo->buffer($model->fotografia);
$mimeType = explode('; ',$mimeType);
$mimeType = $mimeType[0];
?>



<htmlpageheader name="myheader">
    <div style="text-align: center; padding-left: 0mm; padding-top: 0mm; padding-right: 0mm; padding-bottom: 0mm;">
        <?= Html::img('images/uea_carnet_39.jpg',['style' => 'width:600;height:700']); ?>
    </div>
</htmlpageheader>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />

<table width=100% border="0" style="font-size: 9pt; border-collapse:collapse">
    <tr align="center">
        <th height="128px" colspan="2" style="text-align: center">
            <br>
        </th>
    </tr>
    <tr align="center">
        <th height="135px" colspan="2" style="text-align: center">
            <?= '<img style="border:1px solid black;" height="138" src="data:'.$mimeType.';base64,'.base64_encode($model->fotografia).'"/>' ?>
        </th>
    </tr>
    <tr align="center">
        <th colspan="2" style="text-align: center">
            <br>
            <h4><?= $model->cedula_pasaporte?></h4>
            <h4><?= $model->ApellInfPer . ' ' . $model->ApellMatInfPer ?></h4>
            <h4><?= $model->NombInfPer?></h4>
            <br>
            <h6><?= $model->mailInst ?></h6>
            <h6><?= $model->FechNacimPer ?></h6>
            <br>
            <br>
        </th>
    </tr>
    <tr>
        <th width=50% style="text-align: right">
            <h6><b>Cód. Matrícula:</b></h6>
            <h6><b>Carrera:</b></h6>
            <h6><b>Período:</b></h6>
        </th>
        <th width=50% style="text-align: left">
            <h6><?= $model->idMatricula ?></h6>
            <h6><?= $carrera ?></h6>
            <h6><?= $periodoDescriptivo ?></h6>
        </th>
    </tr>
    <tr>
        <th colspan="2" style="text-align: center">
            <barcode code = "<?= $url ?>" type="QR" class="barcode" size="0.7" error="M" />
        </th>
    </tr>
    <tr>
        <th style="text-align: right">
            <br>
            <h6><?= 'Válido hasta: ' . $model->fechfinalperlec ?></h6>
        </th>
        <th style="text-align: left">
            <br>
        </th>
    </tr>
</table>