<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysProvincia */

$this->title = 'Create Sys Provincia';
$this->params['breadcrumbs'][] = ['label' => 'Sys Provincias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-provincia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
