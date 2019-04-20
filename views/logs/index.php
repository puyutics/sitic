<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\ipinfo\IpInfo;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Registros del sistema');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <?php Pjax::begin(); ?>

    <div align="center">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'type',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\Logs::find()->all(), 'type', 'type'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar tipo'],
                'format'=>'raw'
            ],
            'username',
            'datetime',
            'description:ntext',
            'ipaddress',
            'external_id',
            [
                'attribute'=>'external_type',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\Logs::find()->all(), 'external_type', 'external_type'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar tipo'],
                'format'=>'raw'
            ],

            /*['class' => 'kartik\grid\ActionColumn',
                'template'=>'{ipinfo}',
                'buttons'=>[
                    'ipinfo' => function ($url, $model) {
                        return Html::a(
                                '<span class="btn btn-primary center-block">
                                        <i class="fa fa-fw fa-info"></i>
                                         IP</span>',
                            Url::to(['logs/ipinfo', 'ipaddress' => $model->ipaddress]),
                            [
                                'title' => Yii::t('yii', 'IP info'),
                                'target'=>'_blank',
                                'data-pjax'=>"0",
                            ]);
                    },
                ]
            ],*/

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        if ($model->external_type == 'adldap') {
                            return Html::a(
                                '<span class="btn btn-success center-block">
                                        <i class="fa fa-fw fa-folder"></i>
                                         Usuario</span>',

                                Url::to(['adldap/edituser', 'search' => $model->external_id]),

                                [
                                    'title' => Yii::t('yii', 'Editar Usuario'),
                                    'target'=>'_blank',
                                    'data-pjax'=>"0",
                                ]);
                        } else if ($model->external_type == 'adldapGroup') {
                            return Html::a(
                                '<span class="btn btn-success center-block">
                                        <i class="fa fa-fw fa-folder"></i>
                                         Grupo</span>',

                                Url::to(['adldap/viewgroups', 'search' => $model->external_id]),

                                [
                                    'title' => Yii::t('yii', 'Editar Grupo'),
                                    'target'=>'_blank',
                                    'data-pjax'=>"0",
                                ]);
                        } else {
                            return Html::a(
                                '<span class="btn btn-success center-block">
                                        <i class="fa fa-fw fa-folder"></i>
                                         Abrir</span>',

                                Url::to([strtolower($model->external_type) . '/view', 'id' => $model->external_id]),

                                [
                                    'title' => Yii::t('yii', 'Abrir'),
                                    'target'=>'_blank',
                                    'data-pjax'=>"0",
                                ]);
                        }

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
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
