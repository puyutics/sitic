<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\AsistnowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros de Acceso - Vehículo';
$this->params['breadcrumbs'][] = $this->title;

if (isset($_GET['oc_user_id'])) {
    $oc_user_id = base64_decode($_GET['oc_user_id']);
} else {
    $oc_user_id = NULL;
}

if (isset($_GET['oc_zona'])) {
    $oc_zona = base64_decode($_GET['oc_zona']);
    $puerta = \app\models\parkingcontrol\Puerta::find()
        ->where(['PRI_IP' => $oc_zona])
        ->one();
} else {
    $oc_zona = NULL;
}

//Buscar usuario en Parking Control
$oc_user = \app\models\parkingcontrol\Nomina::find()
    ->where(['NOMINA_ID' => $oc_user_id])
    ->one();

?>
<div class="asistnow-index">

    <div class="alert alert-warning" align="center">
        <h3 align="center"><?= 'PLACA: '.$oc_user->NOMINA_PLACA ?></h3>
        <h3 align="center"><?= $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM ?></h3>
        <h4 align="center" style="color:palevioletred">Tipo: <?= $oc_user->NOMINA_TIPO ?></h4>
        <h4 align="center" style="color:palevioletred">Cédula: <?= $oc_user->NOMINA_COD ?></h4>
        <h4 align="center" style="color:palevioletred">TAG / RF: <?= $oc_user->NOMINA_CARD ?></h4>
        <h4 align="center" style="color:palevioletred">Código: <?= $oc_user->NOMINA_ID ?></h4>
    </div>

    <h4 align="center">
        <code>Filtro:</code> <?php if ($oc_zona == NULL) echo 'Todos los equipos'; else echo $puerta->PRI_DES; ?>
    </h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ASIS_ID',
            [
                'label' => 'Ubicación',
                'value' => function ($model) {
                    $puerta = \app\models\parkingcontrol\Puerta::find()
                        ->orWhere(['PRI_PARQUEO' => $model->ASIS_ZONA])
                        ->orWhere(['PRI_IP' => $model->ASIS_ZONA])
                        ->one();
                    return $puerta->PRI_EMPRESA_NOM
                        .'<br>('. $puerta->PRI_AREA1 .')';
                },
                'format' => 'html',
                'group' => true,
                'hAlign'=>'center',
                'vAlign'=>'middle',
            ],
            [
                'label' =>'Puerta',
                'value' => function ($model) {
                    $puerta = \app\models\parkingcontrol\Puerta::find()
                        ->orWhere(['PRI_PARQUEO' => $model->ASIS_ZONA])
                        ->orWhere(['PRI_IP' => $model->ASIS_ZONA])
                        ->one();
                    return $puerta->PRI_DES;
                },
                'format' => 'html'
            ],
            [
                'label' =>'Conexión',
                'value' => function ($model) {
                    $puerta = \app\models\parkingcontrol\Puerta::find()
                        ->orWhere(['PRI_PARQUEO' => $model->ASIS_ZONA])
                        ->orWhere(['PRI_IP' => $model->ASIS_ZONA])
                        ->one();
                    if ($puerta->PRI_STA == 'OK') {
                        return '<p style="color:darkgreen">'. $puerta->PRI_STA .' '.Icon::show('plug').'</p>';
                    } elseif ($puerta->PRI_STA == 'UNPLUG') {
                        return '<p style="color:darkred">'. $puerta->PRI_STA .' '.Icon::show('plug').'</p>';
                    } else {
                        return '<p style="color:#f4c01a">'. $puerta->PRI_STA .' '.Icon::show('question').'</p>';
                    }
                },
                'format' => 'html',
            ],
            [
                'label' =>'Detalles',
                'value' => function ($model) {
                    $puerta = \app\models\parkingcontrol\Puerta::find()
                        ->orWhere(['PRI_PARQUEO' => $model->ASIS_ZONA])
                        ->orWhere(['PRI_IP' => $model->ASIS_ZONA])
                        ->one();
                    return
                        '<b>Modelo: </b>'.$puerta->PRI_VIRDI.'<br>'.
                        '<b>Uso: </b>'.$puerta->PRI_TI.'<br>'.
                        '<b>IP: </b>'.$puerta->PRI_IP.'<br>'.
                        '<b>IP Station: </b>'.$puerta->PRI_PARQUEO;
                },
                'format' => 'html'
            ],
            [
                'label' =>'Fecha / Hora',
                'attribute' =>'ASIS_ING',
            ],
            [
                'label' =>'Tipo',
                'value' => function($model) {
                    $puerta = \app\models\parkingcontrol\Puerta::find()
                        ->orWhere(['PRI_PARQUEO' => $model->ASIS_ZONA])
                        ->orWhere(['PRI_IP' => $model->ASIS_ZONA])
                        ->one();
                    if (isset($puerta)) {
                        return $puerta->PRI_TI;
                    }
                    return '-';
                },
                'format' => 'raw'
            ],
            [
                'label' =>'Registro',
                'attribute' =>'ASIS_RES',
            ],
            //'ASIS_FECHA',
            //'ASIS_HORA',
            //'ASIS_F',
            //'ASIS_FN',
            //'ASIS_HN',
            //'ASIS_PRINT',
            //'ASIS_NOVEDAD',
            //'ASIS_MM',
            //'ASIS_MAIL',
            //'ASIS_CORRIGE',
            //'ASIS_TEMPERATURA',
            //'ASIS_SIMILARIDAD',
            //'ASIS_EVO',
            //'ASIS_EMPRESA',

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            '{export}',
            '{toggleData}'
        ],
        'pjax' => false,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>
</div>
