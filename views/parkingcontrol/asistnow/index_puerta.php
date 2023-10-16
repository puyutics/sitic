<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\parkingcontrol\AsistnowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros de acceso';
$this->params['breadcrumbs'][] = $this->title;

if (isset($_GET['oc_zona'])) {
    $oc_zona = base64_decode($_GET['oc_zona']);
    $puerta = \app\models\parkingcontrol\Puerta::find()
        ->orWhere(['PRI_IP' => $oc_zona])
        ->orWhere(['PRI_PARQUEO' => $oc_zona])
        ->one();
} else {
    $oc_zona = NULL;
}

?>
<div class="asistnow-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= $this->title ?></h3>
        <h3 align="center"><?= $puerta->PRI_DES ?></h3>
        <h4 align="center" style="color:palevioletred">Empresa: <?= $puerta->PRI_EMPRESA_NOM ?></h4>
        <h4 align="center" style="color:palevioletred">Área: <?= $puerta->PRI_AREA1 ?></h4>
        <h4 align="center" style="color:palevioletred">IP Address: <?= $puerta->PRI_IP ?></h4>
        <h4 align="center" style="color:palevioletred">IP Parqueo: <?= $puerta->PRI_PARQUEO ?></h4>
        <h4 align="center" style="color:palevioletred">Modelo: <?= $puerta->PRI_VIRDI ?></h4>
        <h4 align="center" style="color:palevioletred">Conexión: <?= $puerta->PRI_STA ?></h4>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' =>'Usuario',
                'attribute' =>'ASIS_ID',
                'value' => function ($model) {
                    $oc_user = \app\models\parkingcontrol\Nomina::find()
                        ->where(['NOMINA_ID' => $model->ASIS_ID])
                        ->one();
                    if (isset($oc_user)) {
                        return $oc_user->NOMINA_ID .': '. $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM;
                    } else {
                        return $model->ASIS_ID;
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\parkingcontrol\Nomina::find()
                    ->orderBy('NOMINA_APE ASC, NOMINA_NOM ASC')
                    ->all(),
                    'NOMINA_ID',
                    'datosCompletos'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format' => 'html',
            ],
            'ASIS_ZONA',
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
