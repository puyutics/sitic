<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$searchModel = new app\models\LogsSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$external_id = explode("@", $model->samaccountname);
$external_id = $external_id[0];
$dataProvider->query->Where('username = "' . $external_id .'"');
$dataProvider->query->orWhere('external_id = "' . $external_id .'"');
$dataProvider->query->andwhere('external_type = "adldap"');
$dataProvider->sort->defaultOrder = [
    'datetime' => SORT_DESC,
];
?>

<div class="logs-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'type',
            'username',
            'datetime',
            'description:ntext',
            'ipaddress',

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

</div>
