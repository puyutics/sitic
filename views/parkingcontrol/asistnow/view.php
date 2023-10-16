<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\Asistnow */

$this->title = $model->ASIS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Asistnows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asistnow-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ASIS_ID' => $model->ASIS_ID, 'ASIS_ING' => $model->ASIS_ING, 'ASIS_ZONA' => $model->ASIS_ZONA], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ASIS_ID' => $model->ASIS_ID, 'ASIS_ING' => $model->ASIS_ING, 'ASIS_ZONA' => $model->ASIS_ZONA], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ASIS_ID',
            'ASIS_ING',
            'ASIS_ZONA',
            'ASIS_FECHA',
            'ASIS_HORA',
            'ASIS_TIPO',
            'ASIS_RES',
            'ASIS_F',
            'ASIS_FN',
            'ASIS_HN',
            'ASIS_PRINT',
            'ASIS_NOVEDAD',
            'ASIS_MM',
        ],
    ]) ?>

</div>
