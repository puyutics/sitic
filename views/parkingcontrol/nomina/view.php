<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\parkingcontrol\Nomina */

$this->title = $model->NOMINA_ID;
$this->params['breadcrumbs'][] = ['label' => 'Nominas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nomina-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->NOMINA_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->NOMINA_ID], [
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
            'NOMINA_ID',
            'NOMINA_APE',
            'NOMINA_NOM',
            'NOMINA_CLAVE',
            'NOMINA_TELEFONO',
            'NOMINA_SALVOCONDUCTO',
            'NOMINA_COD',
            'NOMINA_TIPO',
            'NOMINA_CAL',
            'NOMINA_AREA',
            'NOMINA_DEP',
            'NOMINA_CAL1',
            'NOMINA_AREA1',
            'NOMINA_DEP1',
            'NOMINA_FING',
            'NOMINA_FSAL',
            'NOMINA_SUEL',
            'NOMINA_COM',
            'NOMINA_AUTI',
            'NOMINA_ES',
            'NOMINA_OBS',
            'NOMINA_EMP',
            'NOMINA_FINGER',
            'NOMINA_F1',
            'NOMINA_CED',
            'NOMINA_FIR',
            'NOMINA_HD1',
            'NOMINA_HF1',
            'NOMINA_HI1',
            'NOMINA_HD2',
            'NOMINA_HF2',
            'NOMINA_HI2',
            'NOMINA_SEL',
            'NOMINA_EMPC',
            'NOMINA_EMPE',
            'NOMINA_P1',
            'NOMINA_P2',
            'NOMINA_P3',
            'NOMINA_P4',
            'NOMINA_P5',
            'NOMINA_P6',
            'NOMINA_P7',
            'NOMINA_P8',
            'NOMINA_P9',
            'NOMINA_P10',
            'NOMINA_P11',
            'NOMINA_P12',
            'NOMINA_P13',
            'NOMINA_P14',
            'NOMINA_P15',
            'NOMINA_P16',
            'NOMINA_P17',
            'NOMINA_P18',
            'NOMINA_P19',
            'NOMINA_P20',
            'NOMINA_DOC',
            'NOMINA_PLA',
            'NOMINA_F',
            'NOMINA_CARD',
            'NOMINA_FCARD',
            'NOMINA_OBS1',
            'NOMINA_NOW',
            'NOMINA_CAFE',
            'NOMINA_AUTO',
            'NOMINA_P21',
            'NOMINA_P22',
            'NOMINA_P23',
            'NOMINA_P24',
            'NOMINA_P25',
            'NOMINA_CONTROLAPB',
            'NOMINA_STATUSAPB',
            'NOMINA_LEVEL',
            'NOMINA_TIPOID',
            'NOMINA_TIPONOM',
            'NOMINA_CAFECONTROL',
            'NOMINA_CAFEMENU',
            'NOMINA_HS1',
            'NOMINA_HS2',
            'NOMINA_HWSQ1',
            'NOMINA_HWSQ2',
            'NOMINA_ISO1',
            'NOMINA_ISO2',
            'NOMINA_TIPO_REGISTRO',
            'NOMINA_CONTROLPASADAS',
            'NOMINA_MAXPASADAS',
            'NOMINA_DESBLOQUEA',
            'NOMINA_PLACA',
            'NOMINA_SYNC',
            'NOMINA_SYNCID',
            'NOMINA_ORIGEN',
        ],
    ]) ?>

</div>
