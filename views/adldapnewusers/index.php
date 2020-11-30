<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdldapNewUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estudiantes SENESCYT';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adldap-new-users-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'dni',
            'nombres',
            'apellidos',
            //'fec_nacimiento',
            [
                'attribute' => 'campus',
                'filter'=>[
                    'PUYO'=>'PUYO',
                    'LAGO AGRIO'=>'LAGO AGRIO',
                    'PANGUI'=>'PANGUI',
                ],
            ],
            [
                'attribute' => 'carrera',
                'filter'=>[
                    'AGROINDUSTRIAL'=>'AGROINDUSTRIAL',
                    'AGROPECUARIA'=>'AGROPECUARIA',
                    'AMBIENTAL'=>'AMBIENTAL',
                    'BIOLOGIA'=>'BIOLOGIA',
                    'COMUNICACION'=>'COMUNICACION',
                    'FORESTAL'=>'FORESTAL',
                    'TURISMO'=>'TURISMO',
                ],
            ],
            //'email_personal:email',
            //'celular',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    if ($model->status == 1) {
                        return '1 - Cuenta no creada';
                    }
                    if ($model->status == 2) {
                        return '2 - Email Personal Verificado';
                    }
                    if ($model->status == 3) {
                        return '3 - Password pendiente';
                    }
                    if ($model->status == 4) {
                        return '4 - Cuenta creada';
                    }
                },
                'filter'=>[
                    '1'=>'1 - Cuenta no creada',
                    '2'=>'2 - Email Personal Verificado',
                    '3'=>'3 - Password pendiente',
                    '4'=>'4 - Cuenta creada',
                ],

            ],

            //['class' => 'kartik\grid\ActionColumn'],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-folder"></i>Editar</span>',
                            Url::to(['update', 'id' => $model->id]),
                            ['title' => Yii::t('yii', 'Editar')]);
                    },
                ]
            ],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        ['create'], [
                            'class' => 'btn btn-success',
                            'title' => ('Nuevo Estudiante')
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
