<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblmodTurno */

$this->title = $model->MOD_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tblmod Turnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tblmod-turno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->MOD_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->MOD_ID], [
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
            'MOD_ID',
            'MOD_DES',
            'MOD_LUNES',
            'MOD_MARTES',
            'MOD_MIERCOLES',
            'MOD_JUEVES',
            'MOD_VIERNES',
            'MOD_SABADO',
            'MOD_DOMINGO',
        ],
    ]) ?>

</div>
