<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\AuxNomina */

$this->title = $model->ANOM_ID;
$this->params['breadcrumbs'][] = ['label' => 'Aux Nominas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="aux-nomina-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ANOM_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ANOM_ID], [
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
            'ANOM_ID',
            'ANOM_APE',
            'ANOM_NOM',
            'ANOM_CED',
            'ANOM_EMP',
            'ANOM_AREA',
            'ANOM_DPTO',
            'ANOM_CAR',
            'ANOM_FECN',
            'ANOM_OBS',
            'ANOM_TIPO',
        ],
    ]) ?>

</div>
