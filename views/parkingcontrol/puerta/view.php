<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\Puerta */

$this->title = $model->PRT_COD;
$this->params['breadcrumbs'][] = ['label' => 'Puertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="puerta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->PRT_COD], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->PRT_COD], [
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
            'PRT_COD',
            'PRI_DES',
            'PRI_LOC',
            'PRI_P',
            'PRI_AREA',
            'PRI_AREA1',
            'PRI_IP',
            'PRI_FEC',
            'PRI_STA',
            'PRI_ST',
            'PRI_PTO',
            'PRI_TIPO',
            'PRI_VIRDI',
            'PRI_TI',
            'PRI_TE',
            'PRI_PRINTER',
            'PRI_VALCLAVE',
            'PRI_TTRAN',
            'PRI_UTRAN',
            'PRI_OPEN',
            'PRI_OPENTIME',
            'PRI_LASTUSER',
            'PRI_LASTMARCA',
            'PRI_TIEMPO',
            'PRI_VERIFICA',
            'PRI_LAST_ID',
            'PRI_NOW',
            'PRI_VALIDA',
            'PRI_EVENTO',
            'PRI_ENVIA_ALERTA',
            'PRI_EMPRESA',
            'PRI_EMPRESA_NOM',
            'PRI_SEL',
            'PRI_CAM',
            'PRI_CAM_IP',
            'PRI_CAM_PASS',
            'PRI_CAM_USER',
            'PRI_PARQUEO',
            'PRI_ENTRY',
            'PRI_IDSTATION',
            'PRI_LASTRFID',
            'PRI_ULTIMALECTURA',
        ],
    ]) ?>

</div>
