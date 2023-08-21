<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\NomPuertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Acceso a Usuario - Activos (Global)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nom-puerta-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= $this->title ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Ubicación',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                    return $puerta->PRI_EMPRESA_NOM
                        .'<br>('. $puerta->PRI_AREA1 .')';
                },
                'format' => 'html',
                'width' => '200px',
                'group' => true,
                'hAlign'=>'center',
                'vAlign'=>'middle',
            ],
            [
                'label' =>'Usuario',
                'attribute' =>'NOM_ID',
                'value' => function ($model) {
                    $oc_user = \app\models\onlycontrol\Nomina::find()
                        ->where(['NOMINA_ID' => $model->NOM_ID])
                        ->one();
                    if (isset($oc_user)) {
                        return $oc_user->NOMINA_ID .': '. $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM;
                    } else {
                        return $model->NOM_ID;
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
                'label' => 'Código',
                'attribute' => 'PUER_ID',
                'width' => '100px',
            ],
            [
                'label' =>'Puerta',
                'attribute' =>'PUER_ID',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                    return $puerta->PRI_DES;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Puerta::find()
                    ->orderBy('PRI_DES ASC')
                    ->all(),
                    'PRT_COD',
                    'PRI_DES'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format' => 'html',
                'width' => '150px',
            ],
            [
                'label' =>'Conexión',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
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
                    $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                    return
                        '<b>Modelo: </b>'.$puerta->PRI_VIRDI.'<br>'.
                        '<b>Uso: </b>'.$puerta->PRI_TI.'<br>'.
                        '<b>IP Address: </b>'.$puerta->PRI_IP;
                },
                'format' => 'html'
            ],
            [
                'label' => 'Fecha / Hora',
                'attribute' => 'TURN_NOW',
                'width' => '50px',
            ],
            [
                'label' => 'Tipo',
                'attribute' => 'TURN_TCOD',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\NomPuerta::find()
                    ->orderBy('TURN_TCOD ASC')
                    ->all(),
                    'TURN_TCOD',
                    'TURN_TCOD'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'width' => '10px',
            ],
            [
                'label' => 'Estado',
                'attribute' => 'TURN_ESTADO_UP',
                'value' => function ($model) {
                    if ($model->TURN_ESTADO_UP == 0) {
                        return '<p style="color:darkgreen">Online '.Icon::show('cloud').'</p>';
                    } elseif ($model->TURN_ESTADO_UP == 1) {
                        return '<p style="color:darkgreen">Online '. Icon::show('cloud').'<br>Local '.Icon::show('download').'</p>';
                    } else {
                        return '<p style="color:#f4c01a">'. $model->TURN_ESTADO_UP .' '.Icon::show('question').'</p>';
                    }
                },
                'filter'=>['0'=>'Online','1'=>'Online / Local'],
                'width' => '80px',
                'format' => 'html'
            ],
            //'TURN_FECHA_UP',
            //'TURN_ID',
            //'TURN_FECI',
            //'TURN_FECF',
            //'TURN_TIPO',
            //'TURN_STA',
            //'TURN_MARCA',
            //'TURN_SEL',
            //'ES_SINCRONIZADO',
            //'ES_UPDATE',
            //'TURN_CONFSIMILAR',

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{access}{delete}',
                'buttons'=>[
                    'access' => function ($url, $model) {
                        $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                        return Html::a('<span class="btn btn-primary center-block">'.Icon::show('fingerprint') . 'Accesos'.'</span>',
                            Url::to(['onlycontrol/asistnow/indexuser', 'oc_user_id'=>base64_encode($model->NOM_ID), 'oc_zona'=>base64_encode($puerta->PRI_IP)]),
                            ['title' => Yii::t('yii', 'Accesos'),'target' => '_blank']);
                    },
                    'delete' => function ($url, $model) {
                        if ($model->TURN_ESTADO_UP == 0 ) {
                            return Html::a('<span class="btn btn-danger center-block">'.Icon::show('trash').' Revocar'.'</span>',
                                Url::to(['onlycontrol/nompuerta/revocar', 'oc_user_id'=>base64_encode($model->NOM_ID), 'oc_puerta_id'=>base64_encode($model->PUER_ID)]),
                                ['title' => Yii::t('yii', 'Revocar Acceso'),'target' => '_blank']);
                        }
                    },
                ]
            ],

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
