<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\NomPuerta */

$this->title = $model->NOM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Nom Puertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nom-puerta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'NOM_ID' => $model->NOM_ID, 'PUER_ID' => $model->PUER_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'NOM_ID' => $model->NOM_ID, 'PUER_ID' => $model->PUER_ID], [
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
            'NOM_ID',
            'PUER_ID',
            'TURN_ID',
            'TURN_FECI',
            'TURN_FECF',
            'TURN_TIPO',
            'TURN_STA',
            'TURN_NOW',
            'TURN_MARCA',
            'TURN_TCOD',
            'TURN_SEL',
            'TURN_ESTADO_UP',
            'TURN_FECHA_UP',
        ],
    ]) ?>

</div>
