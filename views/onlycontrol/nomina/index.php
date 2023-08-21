<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\NominaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Onlycontrol - Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomina-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= $this->title ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'label' => 'Área',
                'attribute' => 'NOMINA_AREA1',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Nomina::find()
                    ->orderBy('NOMINA_AREA1 ASC')
                    ->all(),
                    'NOMINA_AREA1',
                    'NOMINA_AREA1'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'width' => '100px',
                'group' => true,
                'hAlign'=>'center',
                'vAlign'=>'middle',
            ],
            [
                'label' => 'Ubicación',
                'attribute' => 'NOMINA_DEP1',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Nomina::find()
                    ->orderBy('NOMINA_DEP1 ASC')
                    ->all(),
                    'NOMINA_DEP1',
                    'NOMINA_DEP1'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'width' => '100px',
                'group' => true,
                'hAlign'=>'center',
                'vAlign'=>'middle',
            ],
            /*[
                'label' => 'Código',
                'attribute' => 'NOMINA_ID',
                'width' => '100px',
            ],*/
            [
                'label' => 'Usuario',
                'attribute' => 'NOMINA_COD',
                'value' => function ($model) {
                    return $model->NOMINA_COD .': '. $model->NOMINA_APE .' '. $model->NOMINA_NOM;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\onlycontrol\Nomina::find()
                    ->orderBy('NOMINA_APE ASC, NOMINA_NOM ASC')
                    ->all(),
                    'NOMINA_COD',
                    'datosCompletos'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
            ],
            [
                'label' => 'Tipo',
                'attribute' => 'NOMINA_TIPO',
                'filter'=>['USUARIO'=>'USUARIO','ADMINISTRADOR'=>'ADMINISTRADOR'],
            ],
            [
                'label' => 'Estado',
                'attribute' => 'NOMINA_ES',
                'value' => function($model) {
                    if($model->NOMINA_ES == 0) return '<code>INACTIVO</code>';
                    if($model->NOMINA_ES == 1) return '<font color="green">ACTIVO</font>';
                    if($model->NOMINA_ES == -1) return '<font color="green">ACTIVO</font> ('.$model->NOMINA_ES.')';
                    return $model->NOMINA_ES;
                },
                'format' => 'raw',
            ],
            [
                'label' => 'Acciones',
                'value' => function ($model) {
                    return Html::a(Icon::show('eye') . 'Perfil',
                        ['onlycontrol/nomina/profile', 'oc_user_id'=>base64_encode($model->NOMINA_ID)],
                        ['class' => 'btn btn-primary','target' => '_blank']
                    ).' | '.Html::a(Icon::show('door-closed') . 'Puertas',
                        ['onlycontrol/nompuerta/indexuser', 'oc_user_id'=>base64_encode($model->NOMINA_ID)],
                        ['class' => 'btn btn-primary','target' => '_blank']
                    ).Html::a(Icon::show('fingerprint') . 'Accesos',
                            ['onlycontrol/asistnow/indexuser', 'oc_user_id'=>base64_encode($model->NOMINA_ID)],
                            ['class' => 'btn btn-primary','target' => '_blank']
                    ).' | '.Html::a(Icon::show('clipboard-list') . 'Logs',
                        ['onlycontrol/puertasta/indexuser', 'oc_user_id'=>base64_encode($model->NOMINA_ID)],
                        ['class' => 'btn btn-success','target' => '_blank']
                    );
                },
                'format' => 'raw',
            ],

            /*['class' => 'kartik\grid\ActionColumn',
                'template'=>'{profile}',
                'buttons'=>[
                    'profile' => function ($url, $model) {
                        return Html::a(Icon::show('eye') . 'Perfil',
                            ['onlycontrol/nomina/profile', 'oc_user_id'=>base64_encode($model->NOMINA_ID)],
                            ['class' => 'btn btn-primary','target' => '_blank']
                        );
                    },
                ]
            ],*/
            /*['class' => 'kartik\grid\ActionColumn',
                'template'=>'{doors}',
                'buttons'=>[
                    'doors' => function ($url, $model) {
                        return Html::a(Icon::show('door-closed') . 'Puertas',
                            ['onlycontrol/nompuerta/indexuser', 'oc_user_id'=>base64_encode($model->NOMINA_ID)],
                            ['class' => 'btn btn-primary','target' => '_blank']
                        );
                    },
                ]
            ],*/
            /*['class' => 'kartik\grid\ActionColumn',
                'template'=>'{access}',
                'buttons'=>[
                    'access' => function ($url, $model) {
                        return Html::a(Icon::show('fingerprint') . 'Accesos',
                            ['onlycontrol/asistnow/indexuser', 'oc_user_id'=>base64_encode($model->NOMINA_ID)],
                            ['class' => 'btn btn-primary','target' => '_blank']
                        );
                    },
                ]
            ],*/
            /*['class' => 'kartik\grid\ActionColumn',
                'template'=>'{logs}',
                'buttons'=>[
                    'logs' => function ($url, $model) {
                        return Html::a(Icon::show('clipboard-list') . 'Logs',
                            ['onlycontrol/puertasta/indexuser', 'oc_user_id'=>base64_encode($model->NOMINA_ID)],
                            ['class' => 'btn btn-success','target' => '_blank']
                        );
                    },
                ]
            ],*/


            //'NOMINA_FING',
            //'NOMINA_FSAL',
            //'NOMINA_CARD',
            //'NOMINA_FCARD',
            //'NOMINA_NOW',
            //'NOMINA_CONTROLAPB',
            //'NOMINA_TIPOID',
            //'NOMINA_TIPONOM',
            //'NOMINA_CAL1',
            //'NOMINA_CLAVE',
            //'NOMINA_CAL',
            //'NOMINA_AREA',
            //'NOMINA_DEP',
            //'NOMINA_SUEL',
            //'NOMINA_COM',
            //'NOMINA_AUTI',
            //'NOMINA_OBS',
            //'NOMINA_EMP',
            //'NOMINA_FINGER',
            //'NOMINA_F1',
            //'NOMINA_CED',
            //'NOMINA_FIR',
            //'NOMINA_HD1',
            //'NOMINA_HF1',
            //'NOMINA_HI1',
            //'NOMINA_HD2',
            //'NOMINA_HF2',
            //'NOMINA_HI2',
            //'NOMINA_SEL',
            //'NOMINA_EMPC',
            //'NOMINA_EMPE',
            //'NOMINA_P1',
            //'NOMINA_P2',
            //'NOMINA_P3',
            //'NOMINA_P4',
            //'NOMINA_P5',
            //'NOMINA_P6',
            //'NOMINA_P7',
            //'NOMINA_P8',
            //'NOMINA_P9',
            //'NOMINA_P10',
            //'NOMINA_P11',
            //'NOMINA_P12',
            //'NOMINA_P13',
            //'NOMINA_P14',
            //'NOMINA_P15',
            //'NOMINA_P16',
            //'NOMINA_P17',
            //'NOMINA_P18',
            //'NOMINA_P19',
            //'NOMINA_P20',
            //'NOMINA_DOC',
            //'NOMINA_PLA',
            //'NOMINA_F',
            //'NOMINA_OBS1',
            //'NOMINA_CAFE',
            //'NOMINA_AUTO',
            //'NOMINA_P21',
            //'NOMINA_P22',
            //'NOMINA_P23',
            //'NOMINA_P24',
            //'NOMINA_P25',
            //'NOMINA_CAFEMENU',
            //'NOMINA_LEVEL',
            //'NOMINA_HS1',
            //'NOMINA_HS2',
            //'NOMINA_CAFECONTROL',
            //'NOMINA_SERV1',
            //'NOMINA_SERV2',
            //'NOMINA_SERV3',
            //'NOMINA_SERV4',
            //'NOMINA_SERV5',
            //'NOMINA_SERV6',
            //'NOMINA_SERV7',
            //'NOMINA_SERV8',
            //'NOMINA_SERV9',
            //'NOMINA_CARDKEY',
            //'NOMINA_TIPO_REGISTRO',
            //'NOMINA_HWSQ1',
            //'NOMINA_HWSQ2',
            //'NOMINA_FACE',
            //'NOMINA_FACE_LEN',
            //'B_MATCHER_FLAG',
            //'NOMINA_P26',
            //'NOMINA_KEY_CONSULT',
            //'NOMINA_P27',
            //'NOMINA_ADMIN_BIO',
            //'NOMINA_STATUSAPB',

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
