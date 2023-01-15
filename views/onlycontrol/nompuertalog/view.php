<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\NomPuertalog */

$this->title = $model->TURN_NOW;
$this->params['breadcrumbs'][] = ['label' => 'Nom Puertalogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nom-puertalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->TURN_NOW], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->TURN_NOW], [
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
            'TURN_DELNOW',
        ],
    ]) ?>

</div>
