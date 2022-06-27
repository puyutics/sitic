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

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= \yii2assets\pdfjs\PdfJs::widget([
        'url'=> Url::to($model->filefolder . $model->filename . $model->filetype)
    ]); ?>

</div>
