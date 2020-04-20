<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudiantesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$searchModel = new app\models\EstudiantesSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dni = $model->dni;
$dataProvider->query->Where('cedula_pasaporte = "' . $dni .'"');

?>
<div class="estudiantes-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'CIInfPer',
            //'num_expediente',
            'cedula_pasaporte',
            //'TipoDocInfPer',
            'ApellInfPer',
            'ApellMatInfPer',
            'NombInfPer',
            //'NacionalidadPer',
            //'EtniaPer',
            //'FechNacimPer',
            //'LugarNacimientoPer',
            //'GeneroPer',
            //'EstadoCivilPer',
            //'CiudadPer',
            //'DirecDomicilioPer',
            //'Telf1InfPer',
            //'CelularInfPer',
            //'TipoInfPer',
            //'statusper',
            //'mailPer',
            'mailInst',
            //'GrupoSanguineo',
            //'tipo_discapacidad',
            //'carnet_conadis',
            //'num_carnet_conadis',
            //'porcentaje_discapacidad',
            //'lateralidad',
            //'fotografia',
            //'codigo_dactilar',
            //'hd_posicion',
            //'huella_dactilar',
            //'ultima_actualizacion',
            //'codigo_verificacion',
            //'deshabilita_edicion',
            //'archivo',

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update' => function ($url, $model) {
                        return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i>Editar</span>',
                            Url::to(['estudiantes/update',
                                'id' => $model->CIInfPer
                            ]),
                            ['title' => Yii::t('yii', 'Editar Estudiante')]);
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
