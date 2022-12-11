<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Externoe */

$this->title = $model->EMPE_ID;
$this->params['breadcrumbs'][] = ['label' => 'Externoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="externoe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->EMPE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->EMPE_ID], [
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
            'EMPE_ID',
            'EMPE_NOM',
            'EMPE_DIR',
            'EMPE_RUC',
            'EMPE_REP',
            'EMPE_TELF',
            'EMPE_FAX',
            'EMPE_WEB',
            'EMPE_CONT',
            'EMPE_OBS',
            'EMPE_CODE',
        ],
    ]) ?>

</div>
