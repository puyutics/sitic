<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NewCredencialMaestro */

$this->title = $model->CR_ID;
$this->params['breadcrumbs'][] = ['label' => 'New Credencial Maestros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="new-credencial-maestro-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CR_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CR_ID], [
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
            'CR_ID',
            'CR_DES',
            'CR_IMG',
            'CR_FIRMA',
            'CR_FOTO',
            'CR_TIPO',
            'CR_FOTOF',
            'CR_CBARRA',
            'CR_UCREA',
            'CR_FCREA',
            'CR_UserRI',
            'CR_ClaveRI',
            'CR_IMGATRAS',
        ],
    ]) ?>

</div>
