<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Asistencia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-info-index">

    <h1><?php //= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a(Yii::t('app', 'Create User Info'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'USERID',
            'BADGENUMBER',
            'SSN',
            'sca_Nombre',
            'sca_Apellido',
            'sca_Correo',

            //'USERID',
            //'BADGENUMBER',
            //'SSN',
            //'NAME',
            //'GENDER',
            //'TITLE',
            //'PAGER',
            //'BIRTHDAY',
            //'HIREDDAY',
            //'STREET',
            //'CITY',
            //'STATE',
            //'ZIP',
            //'OPHONE',
            //'FPHONE',
            //'VERIFICATIONMETHOD',
            //'DEFAULTDEPTID',
            //'SECURITYFLAGS',
            //'ATT',
            //'INLATE',
            //'OUTEARLY',
            //'OVERTIME:datetime',
            //'SEP',
            //'HOLIDAY',
            //'MINZU',
            //'PASSWORD',
            //'LUNCHDURATION',
            //'MVerifyPass',
            //'PHOTO',
            //'Notes',
            //'privilege',
            //'InheritDeptSch',
            //'InheritDeptSchClass',
            //'AutoSchPlan',
            //'MinAutoSchInterval',
            //'RegisterOT',
            //'InheritDeptRule',
            //'EMPRIVILEGE',
            //'CardNo',
            //'sca_IESSID',
            //'sca_Estado',
            //'sca_FormaPago',
            //'sca_1Quincena',
            //'sca_Nombre',
            //'sca_Apellido',
            //'sca_Cargo',
            //'sca_IdCentroCostos',
            //'sca_EstadoCivil',
            //'sca_Sexo',
            //'sca_FechaDespido',
            //'sca_CargasFamiliares',
            //'sca_Firma',
            //'Pin1',
            //'sca_Discapacidad',
            //'sca_Correo',
            //'sca_MotivoInactivacion',
            //'sca_WEB_MarcaManual',

            //['class' => 'yii\grid\ActionColumn'],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Reporte</span>', $url, [
                            'title' => Yii::t('yii', 'Ver Reporte'),
                        ]);
                    }
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
</div>
