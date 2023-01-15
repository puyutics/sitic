<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $oc_user_id */

$searchModelNomPuertaDel = new \app\models\onlycontrol\NomPuertaDelSearch();
$dataProviderNomPuertaDel = $searchModelNomPuertaDel->search(Yii::$app->request->queryParams);
$dataProviderNomPuertaDel->query->Where(['NOM_ID' => $oc_user_id]);
$dataProviderNomPuertaDel->sort->defaultOrder = ['TURN_FECHA_DEL' => SORT_DESC,];
$countDataProvider = $dataProviderNomPuertaDel->getTotalCount();
$dataProviderNomPuertaDel->pagination = ['pageSize' => $countDataProvider];
?>
<div class="nom-puerta-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderNomPuertaDel,
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
                'attribute' => 'PUER_ID',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::find()
                        ->where(['PRT_COD' => $model->PUER_ID])
                        ->one();
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
                'label' => 'Revocado',
                'attribute' => 'TURN_FECHA_DEL',
                'width' => '50px',
            ],
            [
                'label' => 'Estado',
                'attribute' => 'TURN_ESTADO_DEL',
                'value' => function ($model) {
                    if ($model->TURN_ESTADO_DEL == 1) {
                        return '<p style="color:darkgreen">Sincronizado '.Icon::show('sync').'</p>';
                    } elseif ($model->TURN_ESTADO_DEL == 0) {
                        return '<p style="color:darkred">Pendiente '.Icon::show('exclamation').'</p>';
                    } else {
                        return '<p style="color:#f4c01a">'. $model->TURN_ESTADO_DEL .' '.Icon::show('question').'</p>';
                    }
                },
                'format' => 'html',
                'width' => '80px',
            ],
            //'FLAG_T',

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{access}',
                'buttons'=>[
                    'access' => function ($url, $model) {
                        $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                        return Html::a('<span class="btn btn-primary center-block">'.Icon::show('fingerprint') . 'Accesos'.'</span>',
                            Url::to(['onlycontrol/asistnow/indexuser', 'oc_user_id'=>base64_encode($model->NOM_ID), 'oc_zona'=>base64_encode($puerta->PRI_IP)]),
                            ['title' => Yii::t('yii', 'Accesos'),'target' => '_blank']);
                    },
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
