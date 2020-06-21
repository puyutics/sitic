<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Roles de Usuarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administración'), 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'item_name',
                'value' => 'authItemChild.child',
            ],
            [
                'attribute' => 'user_id',
                'value' => 'user.username',
            ],
            [
                'label' => 'NOMBRES',
                'attribute' => 'user_id',
                'value' => 'user.userProfile.commonname',
            ],
            [
                'label' => 'EMAIL',
                'attribute' => 'user_id',
                'value' => 'user.userProfile.mail',
            ],
            [
                'attribute' => 'created_at',
                'value'=>function ($model) {
                    return date("Y-m-d h:i:s", $model->created_at);
                },
            ],



            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        if ($model->user_id != 1){
                            return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i>Editar</span>',
                                Url::to(['update',
                                    'item_name' => $model->item_name,
                                    'user_id' => $model->user_id
                                ]),
                                ['title' => Yii::t('yii', 'Editar Rol')]);
                        }
                    },
                ]
            ],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
                        'class' => 'btn btn-success',
                        'title' => ('Agregar Rol')
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
