<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Carnetizacion */

$this->title = 'Carnet Digital';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carnetizacion-create">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>


</div>
