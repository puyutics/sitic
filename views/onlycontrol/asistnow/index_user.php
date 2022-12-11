<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\AsistnowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros de Acceso';
$this->params['breadcrumbs'][] = $this->title;

if (isset($_GET['oc_user_id'])) {
    $oc_user_id = base64_decode($_GET['oc_user_id']);
} else {
    $oc_user_id = NULL;
}

if (isset($_GET['oc_zona'])) {
    $oc_zona = base64_decode($_GET['oc_zona']);
    $puerta = \app\models\onlycontrol\Puerta::find()
        ->where(['PRI_IP' => $oc_zona])
        ->one();
} else {
    $oc_zona = NULL;
}

//Buscar usuario en Onlycontrol
$oc_user = \app\models\onlycontrol\Nomina::find()
    ->where(['NOMINA_ID' => $oc_user_id])
    ->one();

if (isset($oc_user)) {
    $oc_user_admin_bio = $oc_user->NOMINA_ADMIN_BIO;
}

?>
<div class="asistnow-index">

    <div class="alert alert-warning" align="center">
        <h3 align="center"><?= $this->title ?></h3>
        <h3 align="center"><?= $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM ?></h3>
        <h4 align="center" style="color:palevioletred">Tipo: <?php if ($oc_user_admin_bio == 1) echo 'Administrador'; else echo 'Usuario'; ?></h4>
        <h4 align="center" style="color:palevioletred">Cédula: <?= $oc_user->NOMINA_COD ?></h4>
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
                    $puerta = \app\models\onlycontrol\Puerta::find()
                        ->where(['PRI_IP' => $model->ASIS_ZONA])
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
                    $puerta = \app\models\onlycontrol\Puerta::find()
                        ->where(['PRI_IP' => $model->ASIS_ZONA])
                        ->one();
                    return $puerta->PRI_DES;
                },
                'format' => 'html'
            ],
            [
                'label' =>'Conexión',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::find()
                        ->where(['PRI_IP' => $model->ASIS_ZONA])
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
                'label' =>'Modelo',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::find()
                        ->where(['PRI_IP' => $model->ASIS_ZONA])
                        ->one();
                    return $puerta->PRI_VIRDI;
                }
            ],
            [
                'label' =>'IP Address',
                'attribute' =>'ASIS_ZONA',
            ],
            [
                'label' =>'Fecha / Hora',
                'attribute' =>'ASIS_ING',
            ],
            //'ASIS_FECHA',
            //'ASIS_HORA',
            [
                'label' =>'Tipo',
                'attribute' =>'ASIS_TIPO',
            ],
            [
                'label' =>'Registro',
                'attribute' =>'ASIS_RES',
            ],
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
    ]); ?>
</div>
