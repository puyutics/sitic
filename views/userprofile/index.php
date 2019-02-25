<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Perfiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Create User Profile'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div align="center">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'dni',
            'username',
            'firstname',
            'lastname',
            //'commonname',
            //'displayname',
            'mail',
            'personalmail',
            'mobile',

            //['class' => 'yii\grid\ActionColumn'],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Perfil</span>',
                            Url::to(['/userprofile/admin', 'username' => $model->username]), [
                                'title' => Yii::t('yii', 'Abrir Perfil'),
                            ]);
                    },
                ]
            ],
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
