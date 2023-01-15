<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\PuertaSta */

$this->title = $model->P_Fecha;
$this->params['breadcrumbs'][] = ['label' => 'Puerta Stas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="puerta-sta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'P_Fecha' => $model->P_Fecha, 'P_ID' => $model->P_ID, 'P_User' => $model->P_User], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'P_Fecha' => $model->P_Fecha, 'P_ID' => $model->P_ID, 'P_User' => $model->P_User], [
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
            'P_ID',
            'P_Fecha',
            'P_Status',
            'P_User',
            'P_Maq',
        ],
    ]) ?>

</div>
