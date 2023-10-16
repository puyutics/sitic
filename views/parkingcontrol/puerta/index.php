<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\parkingcontrol\PuertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Barreras (Global)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puerta-index">

    <div class="alert alert-info" align="center">
        <h1 align="center"><?= Icon::show('parking') ?></h1>
        <h3 align="center"><?= $this->title ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'PRT_COD',
            [
                'label' => 'Ubicación',
                'attribute' => 'PRI_AREA1',
                'value' => function ($model) {
                    return $model->PRI_EMPRESA_NOM
                        .'<br>('. $model->PRI_AREA1 .')';
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\parkingcontrol\Puerta::find()
                    ->orderBy('PRI_AREA1')
                    ->all(),
                    'PRI_AREA1',
                    'PRI_AREA1'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format' => 'html',
                'group' => true,
                'hAlign'=>'center',
                'vAlign'=>'middle',
            ],
            [
                'label' => 'Código',
                'attribute' => 'PRT_COD',
                'width' => '100px',
            ],
            [
                'label' => 'Descripción',
                'attribute' => 'PRI_DES',
            ],
            [
                'label' =>'Conexión',
                'attribute' => 'PRI_STA',
                'value' => function ($model) {
                    if ($model->PRI_STA == 'OK') {
                        return '<p style="color:darkgreen">'. $model->PRI_STA .' '.Icon::show('plug').'</p>';
                    } elseif ($model->PRI_STA == 'UNPLUG') {
                        return '<p style="color:darkred">'. $model->PRI_STA .' '.Icon::show('plug').'</p>';
                    } else {
                        return '<p style="color:#f4c01a">'. $model->PRI_STA .' '.Icon::show('question').'</p>';
                    }
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\parkingcontrol\Puerta::find()
                    ->orderBy('PRI_STA')
                    ->all(),
                    'PRI_STA',
                    'PRI_STA'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format' => 'html',
            ],
            [
                'label' => 'Modelo',
                'attribute' => 'PRI_VIRDI',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\parkingcontrol\Puerta::find()
                    ->orderBy('PRI_VIRDI')
                    ->all(),
                    'PRI_VIRDI',
                    'PRI_VIRDI'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
            ],
            [
                'label' => 'Uso',
                'attribute' => 'PRI_TI',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\parkingcontrol\Puerta::find()
                    ->orderBy('PRI_TI')
                    ->all(),
                    'PRI_TI',
                    'PRI_TI'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
            ],
            [
                'label' => 'IP Address',
                'attribute' => 'PRI_IP',
            ],
            [
                'label' => 'IP Station',
                'attribute' => 'PRI_PARQUEO',
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{users}{access}',
                'buttons'=>[
                    'users' => function ($url, $model) {
                        return Html::a('<span class="btn btn-lg btn-primary center-block">'.Icon::show('car').'</span>',
                            Url::to(['parkingcontrol/nompuerta/indexpuerta', 'oc_zona'=>base64_encode($model->PRT_COD)]),
                            ['title' => Yii::t('yii', 'Vehículos'),'target' => '_blank']);
                    },
                    'access' => function ($url, $model) {
                        return Html::a('<span class="btn btn-lg btn-primary center-block">'.Icon::show('fingerprint').'</span>',
                            Url::to(['parkingcontrol/asistnow/indexpuerta', 'oc_zona'=>base64_encode($model->PRI_IP), 'oc_zona_parqueo'=>base64_encode($model->PRI_PARQUEO)]),
                            ['title' => Yii::t('yii', 'Accesos'),'target' => '_blank']);
                    },
                ]
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}{logs}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-lg btn-primary center-block">'.Icon::show('edit').'</span>',
                            Url::to(['parkingcontrol/puerta/update', 'id'=>base64_encode($model->PRT_COD)]),
                            ['title' => Yii::t('yii', 'Editar'),'target' => '_blank']);
                    },
                    'logs' => function ($url, $model) {
                        return Html::a('<span class="btn btn-lg btn-success center-block">'.Icon::show('clipboard-list').'</span>',
                            Url::to(['parkingcontrol/puertasta/indexpuerta', 'oc_zona'=>base64_encode($model->PRT_COD)]),
                            ['title' => Yii::t('yii', 'Logs'),'target' => '_blank']);
                    },
                ]
            ],

            //'PRI_DES',
            //'PRI_LOC',
            //'PRI_P',
            //'PRI_AREA',
            //'PRI_AREA1',
            //'PRI_IP',
            //'PRI_FEC',
            //'PRI_STA',
            //'PRI_ST',
            //'PRI_PTO',
            //'PRI_TIPO',
            //'PRI_VIRDI',
            //'PRI_TI',
            //'PRI_TE',
            //'PRI_PRINTER',
            //'PRI_VALCLAVE',
            //'PRI_TTRAN',
            //'PRI_UTRAN',
            //'PRI_OPEN',
            //'PRI_OPENTIME',
            //'PRI_LASTUSER',
            //'PRI_LASTMARCA',
            //'PRI_TIEMPO',
            //'PRI_VERIFICA',
            //'PRI_LAST_ID',
            //'PRI_NOW',
            //'PRI_VALIDA',
            //'PRI_EVENTO',
            //'PRI_ENVIA_ALERTA',
            //'PRI_EMPRESA',
            //'PRI_EMPRESA_NOM',
            //'PRI_SEL',
            //'PRI_CAM',
            //'PRI_CAM_IP',
            //'PRI_CAM_PASS',
            //'PRI_CAM_USER',
            //'PRI_PARQUEO',
            //'PRI_ENTRY',
            //'PRI_IDSTATION',
            //'PRI_LASTRFID',
            //'PRI_ULTIMALECTURA',

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
