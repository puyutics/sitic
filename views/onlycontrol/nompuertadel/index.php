<?php

use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\NomPuertaDelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Acceso a Usuarios - Revocados (Global)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nom-puerta-del-index">

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
            'PUER_ID',
            [
                'label' =>'Puerta',
                'attribute' => 'PUER_ID',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::find()
                        ->where(['PRT_COD' => $model->PUER_ID])
                        ->one();
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
                'label' =>'Modelo',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                    return $puerta->PRI_VIRDI;
                }
            ],
            [
                'label' =>'Uso',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                    return $puerta->PRI_TI;
                }
            ],
            [
                'label' =>'IP Address',
                'value' => function ($model) {
                    $puerta = \app\models\onlycontrol\Puerta::findOne($model->PUER_ID);
                    return $puerta->PRI_IP;
                }
            ],
            'TURN_FECHA_DEL',
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
                'filter'=>['0'=>'Pendiente','1'=>'Sincronizado'],
                'format' => 'html'
            ],
            //'FLAG_T',

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
