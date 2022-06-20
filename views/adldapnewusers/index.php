<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

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
            [
                'attribute' => 'dni',
                'value' => 'DatosCompletos',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\AdldapNewUsers::find()
                    ->orderBy('apellidos ASC, nombres ASC')
                    ->all(),
                    'dni',
                    'DatosCompletos'
                ),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],
            /*[
                'attribute'=>'dni',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\AdldapNewUsers::find()
                    ->all(), 'dni', 'dni'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],*/
            /*[
                'attribute'=>'nombres',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\AdldapNewUsers::find()
                    ->all(), 'nombres', 'nombres'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],*/
            /*[
                'attribute'=>'apellidos',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\AdldapNewUsers::find()
                    ->all(), 'apellidos', 'apellidos'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],*/
            'fec_nacimiento',
            [
                'attribute'=>'campus',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\AdldapNewUsers::find()
                    ->all(), 'campus', 'campus'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],
            [
                'attribute'=>'carrera',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\AdldapNewUsers::find()
                    ->orderBy('carrera ASC')
                    ->all(), 'carrera', 'carrera'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],
            [
                'label' => 'Email institucional',
                'value' => function($model) {
                    $estudiante = \app\models\Estudiantes::find()
                        ->select('mailInst')
                        ->where(['CIInfPer' => $model->dni])
                        ->orWhere((['cedula_pasaporte' => $model->dni]))
                        ->one();
                    if (isset($estudiante)) {
                        return $estudiante->mailInst;
                    } else {
                        return '-';
                    }
                },
            ],
            'email_personal:email',
            'celular',
            [
                'attribute'=>'proceso',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\AdldapNewUsers::find()
                    ->all(), 'proceso', 'proceso'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Seleccionar'],
                'format'=>'raw',
            ],
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
                            ['target'=>'_blank','title' => Yii::t('yii', 'Editar')]);
                    },
                ]
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{edituser}',
                'buttons'=>[
                    'edituser' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block"><i class="fa fa-fw fa-folder"></i>Cuenta</span>',
                            Url::to(['adldap/edituser', 'search' => $model->dni]),
                            ['target'=>'_blank','title' => Yii::t('yii', 'Cuenta')]);
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
