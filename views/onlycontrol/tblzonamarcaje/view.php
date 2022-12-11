<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TblZonamarcaje */

$this->title = $model->ZM_DES;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Zonamarcajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-zonamarcaje-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ZM_DES], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ZM_DES], [
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
            'ZM_ID',
            'ZM_DES',
            'ZM_SEL',
            'ZM_EMPE',
            'ZM_EMPE_NOM',
        ],
    ]) ?>

</div>
