<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $model app\models\RolUser */

$filefolder = $model->filefolder;
$filename = $model->filename;
$filetype = $model->filetype;

$this->title = 'Rol de Pago';
//$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['user/perfil']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="documents-view">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= \yii2assets\pdfjs\PdfJs::widget([
        'width'=>'100%',
        'height'=> '1000px',
        'url'=> '@web/'. $filefolder . $filename . '.' . $filetype
    ]); ?>

</div>
