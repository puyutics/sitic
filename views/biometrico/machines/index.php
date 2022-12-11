<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\biometrico\MachinesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Machines');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machines-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Create Machines'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'MachineAlias',
            'IP',
            'sn',
            //'SENSORID',
            //'SECURITY',

            //'ID',
            //'MachineAlias',
            //'ConnectType',
            //'IP',
            //'SerialPort',
            //'Port',
            //'Baudrate',
            //'MachineNumber',
            //'IsHost',
            //'Enabled',
            //'CommPassword',
            //'UILanguage',
            //'DateFormat',
            //'InOutRecordWarn',
            //'Idle',
            //'Voice',
            //'managercount',
            //'usercount',
            //'fingercount',
            //'SecretCount',
            //'FirmwareVersion',
            //'ProductType',
            //'LockControl',
            //'Purpose',
            //'ProduceKind',
            //'sn',
            //'PhotoStamp',
            //'IsIfChangeConfigServer2',
            //'SENSORID',
            //'SECURITY',

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{access}',
                'buttons'=>[
                    'access' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block">'.Icon::show('fingerprint') . 'Accesos'.'</span>',
                            Url::to(['biometrico/checkinout/indexsensor', 'sensor_id'=>base64_encode($model->SENSORID)]),
                            ['title' => Yii::t('yii', 'Accesos'),'target' => '_blank']);
                    },
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                        'class' => 'btn btn-default',
                        'title' => ('Reset Grid')
                    ]),
            ],
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
