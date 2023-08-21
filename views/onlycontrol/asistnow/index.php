<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\AsistnowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros de acceso (Global)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistnow-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= $this->title ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' =>'Usuario',
                'attribute' =>'ASIS_ID',
                'value' => function ($model) {
                    $oc_user = \app\models\onlycontrol\Nomina::find()
                        ->where(['NOMINA_ID' => $model->ASIS_ID])
                        ->one();
                    if (isset($oc_user)) {
                        return $oc_user->NOMINA_ID .': '. $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM;
                    } else {
                        return $model->ASIS_ID;
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Nomina::find()
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
            [
                'label' =>'Puerta',
                'attribute' =>'ASIS_ZONA',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::find()
                        ->where(['PRI_IP' => $model->ASIS_ZONA])
                        ->one();
                    return $puerta->PRI_DES;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Puerta::find()
                    ->orderBy('PRI_DES ASC')
                    ->all(),
                    'PRI_IP',
                    'PRI_DES'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
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
                'value' => function ($model) {
                    return $model->ASIS_ZONA;
                }
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
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Asistnow::find()
                    ->all(),
                    'ASIS_TIPO',
                    'ASIS_TIPO'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
            ],
            [
                'label' =>'Registro',
                'attribute' =>'ASIS_RES',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Asistnow::find()
                    ->all(),
                    'ASIS_RES',
                    'ASIS_RES'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
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
