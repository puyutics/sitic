<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $oc_user_id */

$searchModelNomPuertaLog = new \app\models\onlycontrol\NomPuertalogSearch();
$dataProviderNomPuertaLog = $searchModelNomPuertaLog->search(Yii::$app->request->queryParams);
$dataProviderNomPuertaLog->query->Where(['NOM_ID' => $oc_user_id]);
$dataProviderNomPuertaLog->sort->defaultOrder = ['TURN_DELNOW' => SORT_DESC,'TURN_NOW' => SORT_DESC];
$countDataProvider = $dataProviderNomPuertaLog->getTotalCount();
$dataProviderNomPuertaLog->pagination = ['pageSize' => $countDataProvider];
?>
<div class="nom-puerta-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderNomPuertaLog,
        //'filterModel' => $searchModelNomPuertaLog,
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
                    $puerta = \app\models\onlycontrol\Puerta::find()
                        ->where(['PRT_COD' => $model->PUER_ID])
                        ->one();
                    return $puerta->PRI_DES;
                },
                'format' => 'html'
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
                'label' => 'Creado',
                'attribute' => 'TURN_NOW',
                'width' => '50px',
            ],
            [
                'label' => 'Revocado',
                'attribute' => 'TURN_DELNOW',
                'width' => '50px',
            ],
            //'TURN_TIPO',
            //'TURN_STA',
            //'TURN_ID',
            //'TURN_FECI',
            //'TURN_FECF',

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
