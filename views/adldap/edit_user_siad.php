<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model yii\web\View */

$dni = $model->dni;
$CIInfPer = $dni;
$estudiante_nivelacion = \app\models\Estudiantes::find()
    ->where(['CIInfPer' => $dni])
    ->orWhere(['cedula_pasaporte' => $dni])
    ->one();
if (isset($estudiante_nivelacion)) {
    $CIInfPer = $estudiante_nivelacion->CIInfPer;
}
$estudiante_pregrado = \app\models\Estudiantes::find()
    ->where(['CIInfPer' => $dni])
    ->orWhere(['cedula_pasaporte' => $dni])
    ->one();
if (isset($estudiante_nivelacion)) {
    $CIInfPer = $estudiante_pregrado->CIInfPer;
}
$estudiante_posgrado = \app\models\EstudiantesPosgrado::find()
    ->where(['CIInfPer' => $dni])
    ->orWhere(['cedula_pasaporte' => $dni])
    ->one();
if (isset($estudiante_posgrado)) {
    $CIInfPer = $estudiante_posgrado->CIInfPer;
}
$docente_pregrado = \app\models\Docentes::find()
    ->where(['CIInfPer' => $dni])
    ->orWhere(['cedula_pasaporte' => $dni])
    ->one();
if (isset($docente_pregrado)) {
    $CIInfPer = $docente_pregrado->CIInfPer;
}

////////SIAD NIVELACION//////////
$searchModelNivelacion = new \app\models\EstudiantesNivelacionSearch();
$dataProviderNivelacion = $searchModelNivelacion->search(Yii::$app->request->queryParams);
$dataProviderNivelacion->query
    ->Where('CIInfPer = "' . $CIInfPer .'"');

$searchModelMatriculaNivelacion = new \app\models\MatriculaNivelacionSearch();
$searchModelMatriculaNivelacion->CIInfPer = $CIInfPer;
$dataProviderMatriculaNivelacion = $searchModelMatriculaNivelacion->search(Yii::$app->request->queryParams);
$dataProviderMatriculaNivelacion->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idsemestre' => SORT_DESC,
];

////////SIAD PREGRADO//////////
$searchModelPregrado = new app\models\EstudiantesSearch();
$dataProviderPregrado = $searchModelPregrado->search(Yii::$app->request->queryParams);
$dataProviderPregrado->query
    ->Where('CIInfPer = "' . $CIInfPer .'"');

$searchModelMatriculaPregrado = new \app\models\MatriculaSearch();
$searchModelMatriculaPregrado->CIInfPer = $CIInfPer;
$dataProviderMatriculaPregrado = $searchModelMatriculaPregrado->search(Yii::$app->request->queryParams);
$dataProviderMatriculaPregrado->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idsemestre' => SORT_DESC,
];

////////SIAD POSGRADO//////////
$searchModelPosgrado = new app\models\EstudiantesPosgradoSearch();
$dataProviderPosgrado = $searchModelPosgrado->search(Yii::$app->request->queryParams);
$dataProviderPosgrado->query
    ->Where('CIInfPer = "' . $CIInfPer .'"');

$searchModelMatriculaPosgrado = new \app\models\MatriculaPosgradoSearch();
$searchModelMatriculaPosgrado->CIInfPer = $CIInfPer;
$dataProviderMatriculaPosgrado = $searchModelMatriculaPosgrado->search(Yii::$app->request->queryParams);
$dataProviderMatriculaPosgrado->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idsemestre' => SORT_DESC,
];

////////SIAD DOCENTE PREGRADO//////////
$searchModelDocentePregrado = new app\models\DocentesSearch();
$dataProviderDocentePregrado = $searchModelDocentePregrado->search(Yii::$app->request->queryParams);
$dataProviderDocentePregrado->query
    ->Where('CIInfPer = "' . $CIInfPer .'"');

?>

<?php if($dataProviderNivelacion->getTotalCount() == 0
         and $dataProviderPregrado->getTotalCount() == 0
         and $dataProviderPosgrado->getTotalCount() == 0
         and $dataProviderDocentePregrado->getTotalCount() == 0) { ?>
    <div class="alert alert-info" align="center">
        <h3 align="center">No existe información</h3>
    </div>
<?php } ?>

<?php if($dataProviderDocentePregrado->getTotalCount() > 0) { ?>
    <div class="estudiantes-pregrado-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="alert alert-danger" align="center">
            <h3 align="center"> SIAD PREGRADO - Información Docente </h3>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProviderDocentePregrado,
            //'filterModel' => $searchModelDocentePregrado,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                'CIInfPer',
                'cedula_pasaporte',
                //'TipoDocInfPer',
                'ApellInfPer',
                'ApellMatInfPer',
                'NombInfPer',
                //'NacionalidadPer',
                //'EtniaPer',
                'FechNacimPer',
                //'LugarNacimientoPer',
                //'GeneroPer',
                //'EstadoCivilPer',
                //'CiudadPer',
                //'DirecDomicilioPer',
                //'Telf1InfPer',
                //'Telf2InfPer',
                //'CelularInfPer',
                //'TipoInfPer',
                'StatusPer',
                //'mailPer',
                'mailInst',
                //'GrupoSanguineo',
                //'tipo_discapacidad',
                //'carnet_conadis',
                //'num_carnet_conadis',
                //'porcentaje_discapacidad',
                //'fotografia',
                //'codigo_dactilar',
                //'hd_posicion',
                //'huella_dactilar',
                //'ultima_actualizacion',
                //'LoginUsu',
                //'ClaveUsu',
                //'StatusUsu',
                //'idcarr',
                //'usa_biometrico',
                //'firma_1',
                //'firma_2',
                //'fecha_reg',
                //'fecha_ultimo_acceso',
                //'usu_registra',
                //'usu_modifica',
                //'fecha_ultima_modif',
                //'invitado',

                ['class' => 'kartik\grid\ActionColumn',
                    'template'=>'{update}',
                    'buttons'=>[
                        'update' => function ($url, $model) {
                            return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i></span>',
                                Url::to(['docentes/update',
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
<?php } ?>

<?php if($dataProviderPosgrado->getTotalCount() > 0) { ?>
    <div class="estudiantes-pregrado-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="alert alert-success" align="center">
            <h3 align="center"> SIAD POSGRADO - Información Estudiante </h3>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProviderPosgrado,
            //'filterModel' => $searchModelPosgrado,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'CIInfPer',
                //'num_expediente',
                'cedula_pasaporte',
                //'TipoDocInfPer',
                'ApellInfPer',
                'ApellMatInfPer',
                'NombInfPer',
                //'NacionalidadPer',
                //'EtniaPer',
                'FechNacimPer',
                //'LugarNacimientoPer',
                //'GeneroPer',
                //'EstadoCivilPer',
                //'CiudadPer',
                //'DirecDomicilioPer',
                //'Telf1InfPer',
                //'CelularInfPer',
                //'TipoInfPer',
                'statusper',
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
                            return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i></span>',
                                Url::to(['estudiantesposgrado/update',
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

        <div class="alert alert-success" align="center">
            <h3 align="center"> SIAD POSGRADO - Matrículas </h3>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProviderMatriculaPosgrado,
            //'filterModel' => $searchModelMatriculaPosgrado,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'idMatricula',
                //'idMatricula_anual',
                'CIInfPer',
                'idPer',
                'idCarr',
                //'idanio',
                'idsemestre',
                'FechaMatricula',
                //'idParalelo',
                //'idMatricula_ant',
                //'tipoMatricula',
                'statusMatricula',
                //'anulada',
                //'observMatricula',
                //'promocion',
                //'Usu_registra',
                //'Usu_legaliza',
                //'Fecha_crea',
                //'Usu_modifica',
                //'Fecha_ultima_modif',
                //'archivo_aprobado',
                //'archivo_retirado',
                //'archivo_anulado',
                //'leg_observacion',
                //'num_asig_repite',
                //'aprobacion_automatica',
                //'mail_enviado',

                //['class' => 'yii\grid\ActionColumn'],
            ],
            'containerOptions' => ['style'=>'overflow: auto'],
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
<?php } ?>

<?php if($dataProviderPregrado->getTotalCount() > 0) { ?>
    <div class="estudiantes-pregrado-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="alert alert-info" align="center">
            <h3 align="center"> SIAD PREGRADO - Información Estudiante </h3>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProviderPregrado,
            //'filterModel' => $searchModelPregrado,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'CIInfPer',
                //'num_expediente',
                'cedula_pasaporte',
                //'TipoDocInfPer',
                'ApellInfPer',
                'ApellMatInfPer',
                'NombInfPer',
                //'NacionalidadPer',
                //'EtniaPer',
                'FechNacimPer',
                //'LugarNacimientoPer',
                //'GeneroPer',
                //'EstadoCivilPer',
                //'CiudadPer',
                //'DirecDomicilioPer',
                //'Telf1InfPer',
                //'CelularInfPer',
                //'TipoInfPer',
                'statusper',
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
                            return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i></span>',
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

        <div class="alert alert-info" align="center">
            <h3 align="center"> SIAD PREGRADO - Matrículas </h3>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProviderMatriculaPregrado,
            //'filterModel' => $searchModelMatriculaPregrado,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'idMatricula',
                //'idMatricula_anual',
                'CIInfPer',
                'idPer',
                'idCarr',
                //'idanio',
                'idsemestre',
                'FechaMatricula',
                //'idParalelo',
                //'idMatricula_ant',
                //'tipoMatricula',
                'statusMatricula',
                //'anulada',
                //'observMatricula',
                //'promocion',
                //'Usu_registra',
                //'Usu_legaliza',
                //'Fecha_crea',
                //'Usu_modifica',
                //'Fecha_ultima_modif',
                //'archivo_aprobado',
                //'archivo_retirado',
                //'archivo_anulado',
                //'leg_observacion',
                //'num_asig_repite',
                //'aprobacion_automatica',
                //'mail_enviado',

                //['class' => 'yii\grid\ActionColumn'],
            ],
            'containerOptions' => ['style'=>'overflow: auto'],
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
<?php } ?>

<?php if($dataProviderNivelacion->getTotalCount() > 0) { ?>
    <div class="estudiantes-nivelacion-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="alert alert-warning" align="center">
            <h3 align="center"> SIAD NIVELACIÓN - Información Estudiante </h3>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProviderNivelacion,
            //'filterModel' => $searchModelNivelacion,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'CIInfPer',
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
                'statusper',
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
                            return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i></span>',
                                Url::to(['estudiantesnivelacion/update',
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

        <div class="alert alert-warning" align="center">
            <h3 align="center"> SIAD NIVELACIÓN - Matrículas </h3>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProviderMatriculaNivelacion,
            //'filterModel' => $searchModelMatriculaNivelacion,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'idMatricula',
                //'idMatricula_anual',
                'CIInfPer',
                'idPer',
                'idCarr',
                //'idanio',
                'idsemestre',
                'FechaMatricula',
                //'idParalelo',
                //'idMatricula_ant',
                //'tipoMatricula',
                'statusMatricula',
                //'anulada',
                //'observMatricula',
                //'promocion',
                //'Usu_registra',
                //'Usu_legaliza',
                //'Fecha_crea',
                //'Usu_modifica',
                //'Fecha_ultima_modif',
                //'archivo_aprobado',
                //'archivo_retirado',
                //'archivo_anulado',
                //'leg_observacion',
                //'num_asig_repite',
                //'aprobacion_automatica',
                //'mail_enviado',

                //['class' => 'yii\grid\ActionColumn'],
            ],
            'containerOptions' => ['style'=>'overflow: auto'],
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
<?php } ?>
