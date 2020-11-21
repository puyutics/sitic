<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SysEmailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Servicio de Email';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-email-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'from:ntext',
            'replyto:ntext',
            //'to:ntext',
            //'cc:ntext',
            //'cco:ntext',
            'subject',
            //'body:ntext',
            //'attach:ntext',
            'datetime',
            'status',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{view}',
                'buttons'=>[
                    'view' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Abrir</span>',
                            Url::to('index.php?r=sysemail/view&id=' . base64_encode($model->id)), [
                                'title' => Yii::t('yii', 'Ver Email'),
                            ]);
                    },
                ]
            ],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        ['sysemail/create'], [
                            'class' => 'btn btn-success',
                            'title' => ('Crear Email')
                        ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'responsive' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>
</div>
