<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\NomPuertaDel */

$this->title = $model->NOM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Nom Puerta Dels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nom-puerta-del-view">

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
            'FLAG_T',
            'TURN_ESTADO_DEL',
            'TURN_FECHA_DEL',
        ],
    ]) ?>

</div>
