<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonaequipo */

$this->title = $model->PRT_COD;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Zonaequipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-zonaequipo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'PRT_COD' => $model->PRT_COD, 'ZM_ID' => $model->ZM_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'PRT_COD' => $model->PRT_COD, 'ZM_ID' => $model->ZM_ID], [
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
            'AREA_ZM_ID',
            'ZM_ID',
            'PRT_COD',
            'PRI_DES',
            'PRT_SEL',
        ],
    ]) ?>

</div>
