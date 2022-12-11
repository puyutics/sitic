<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\Puerta */

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
            'PRI_SEL',
            'PRI_LASTUSER',
            'PRI_LASTMARCA',
            'PRI_OPEN',
            'PRI_TIEMPO',
            'PRI_VERIFICA',
            'PRI_LAST_ID',
            'PRI_NOW',
            'PRI_VALIDA',
            'PRI_EVENTO',
            'PRI_ENVIA_ALERTA',
            'PRI_EMPRESA',
            'PRI_EMPRESA_NOM',
            'PRI_SERVER',
            'PRI_CAM',
            'PRI_CAM_IP',
            'PRI_CAM_PASS',
            'PRI_CAM_USER',
            'PRI_CAM_URL:url',
            'PRI_CONTROL_MARCA',
            'PRI_MAC',
            'PRI_MAC_KEY',
            'PRI_ESTADO_LICENCIA',
            'PRI_RA',
            'PRI_LAT',
            'PRI_LON',
            'PRI_PER',
            'PRI_SERV',
            'PRI_ACTIVAGPS',
            'PRI_ALTITUD',
            'PRI_LONGITUD',
            'PRI_DISTANCIA',
            'PRI_KEYEQUIPO',
            'PRI_DPTO',
            'PRI_ENROLA',
        ],
    ]) ?>

</div>
