<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TipoPermiso */

$this->title = $model->TIPO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-permiso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'TIPO_ID' => $model->TIPO_ID, 'TIPO_NOM' => $model->TIPO_NOM], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'TIPO_ID' => $model->TIPO_ID, 'TIPO_NOM' => $model->TIPO_NOM], [
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
            'TIPO_ID',
            'TIPO_NOM',
            'TIPO_COD_N',
            'TIPO_COD_A',
            'TIPO_FACE',
            'TIPO_IRIS',
        ],
    ]) ?>

</div>
