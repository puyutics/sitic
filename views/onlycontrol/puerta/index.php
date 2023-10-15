<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\PuertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Puertas (Global)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puerta-index">

    <div class="alert alert-info" align="center">
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
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Puerta::find()
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
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Puerta::find()
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
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Puerta::find()
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
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Puerta::find()
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


            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{users}{access}',
                'buttons'=>[
                    'users' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">'.Icon::show('users') . 'Usuarios'.'</span>',
                            Url::to(['onlycontrol/nompuerta/indexpuerta', 'oc_zona'=>base64_encode($model->PRT_COD)]),
                            ['title' => Yii::t('yii', 'Accesos'),'target' => '_blank']);
                    },
                    'access' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">'.Icon::show('fingerprint') . 'Accesos'.'</span>',
                            Url::to(['onlycontrol/asistnow/indexpuerta', 'oc_zona'=>base64_encode($model->PRI_IP)]),
                            ['title' => Yii::t('yii', 'Accesos'),'target' => '_blank']);
                    },
                ]
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}{logs}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-danger center-block">'.Icon::show('edit') . 'Editar'.'</span>',
                            Url::to(['onlycontrol/puerta/update', 'id'=>base64_encode($model->PRT_COD)]),
                            ['title' => Yii::t('yii', 'Editar'),'target' => '_blank']);
                    },
                    'logs' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">'.Icon::show('clipboard-list') . 'Logs'.'</span>',
                            Url::to(['onlycontrol/puertasta/indexpuerta', 'oc_zona'=>base64_encode($model->PRT_COD)]),
                            ['title' => Yii::t('yii', 'Accesos'),'target' => '_blank']);
                    },
                ]
            ],


            //'PRI_LOC',
            //'PRI_P',
            //'PRI_AREA',
            //'PRI_AREA1',
            //'PRI_FEC',
            //'PRI_ST',
            //'PRI_PTO',
            //'PRI_TIPO',
            //'PRI_TE',
            //'PRI_PRINTER',
            //'PRI_VALCLAVE',
            //'PRI_SEL',
            //'PRI_LASTUSER',
            //'PRI_LASTMARCA',
            //'PRI_OPEN',
            //'PRI_TIEMPO',
            //'PRI_VERIFICA',
            //'PRI_LAST_ID',
            //'PRI_NOW',
            //'PRI_VALIDA',
            //'PRI_EVENTO',
            //'PRI_ENVIA_ALERTA',
            //'PRI_EMPRESA',
            //'PRI_SERVER',
            //'PRI_CAM',
            //'PRI_CAM_IP',
            //'PRI_CAM_PASS',
            //'PRI_CAM_USER',
            //'PRI_CAM_URL:url',
            //'PRI_CONTROL_MARCA',
            //'PRI_MAC',
            //'PRI_MAC_KEY',
            //'PRI_ESTADO_LICENCIA',
            //'PRI_RA',
            //'PRI_LAT',
            //'PRI_LON',
            //'PRI_PER',
            //'PRI_SERV',
            //'PRI_ACTIVAGPS',
            //'PRI_ALTITUD',
            //'PRI_LONGITUD',
            //'PRI_DISTANCIA',
            //'PRI_KEYEQUIPO',
            //'PRI_DPTO',
            //'PRI_ENROLA',

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
