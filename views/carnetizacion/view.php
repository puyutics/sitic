<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Carnetizacion */

$this->title = 'Carnet Digital';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="carnetizacion-view">

    <?php $fecha_actual = date('Y-m-d');
    $estudiante = \app\models\siad_pregrado\Estudiantes::findOne($model->CIInfPer);
    $matricula = \app\models\siad_pregrado\Matricula::findOne($model->idMatricula);
    if ($matricula->statusMatricula == 'APROBADA'
        AND $estudiante->statusper == 1
        AND $fecha_actual < $model->fechfinalperlec) {?>
        <div class="alert alert-success" align="center">
            <h3 align="center">Carnet Digital Vigente</h3>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" align="center">
            <h3 align="center">Carnet Digital Caducado</h3>
        </div>
    <?php } ?>

    <?= \yii2assets\pdfjs\PdfJs::widget([
        'width'=>'100%',
        'height'=> '810px',
        'url'=> Url::to($model->filefolder . $model->filename . $model->filetype)
    ]); ?>

</div>
