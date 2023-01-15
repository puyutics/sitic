<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $oc_user_id */

$searchModelNomPuerta = new \app\models\onlycontrol\NomPuertaSearch();
$dataProviderNomPuerta = $searchModelNomPuerta->search(Yii::$app->request->queryParams);
$dataProviderNomPuerta->query->Where(['NOM_ID' => $oc_user_id]);
$dataProviderNomPuerta->sort->defaultOrder = ['TURN_NOW' => SORT_DESC,];
$countDataProvider = $dataProviderNomPuerta->getTotalCount();
$dataProviderNomPuerta->pagination = ['pageSize' => $countDataProvider];
?>
<div class="nom-puerta-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderNomPuerta,
        //'filterModel' => $searchModelNomPuerta,
        'pjax'=>false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'NOM_ID',
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
                                Url::to(['onlycontrol/nompuerta/revoca', 'oc_user_id'=>base64_encode($model->NOM_ID), 'oc_puerta_id'=>base64_encode($model->PUER_ID)]),
                                ['title' => Yii::t('yii', 'Revocar Acceso'),'target' => '_blank']);
                        }
                    },
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
