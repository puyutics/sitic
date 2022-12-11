<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Califica */

$this->title = $model->CALI_ID;
$this->params['breadcrumbs'][] = ['label' => 'Calificas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="califica-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'CALI_ID' => $model->CALI_ID, 'CALI_NOM' => $model->CALI_NOM], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'CALI_ID' => $model->CALI_ID, 'CALI_NOM' => $model->CALI_NOM], [
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
            'CALI_ID',
            'CALI_NOM',
            'CALI_DES',
        ],
    ]) ?>

</div>
