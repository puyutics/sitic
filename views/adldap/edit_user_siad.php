<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model yii\web\View */

$dni = $model->dni;
$CIInfPer = $dni;
$estudiante_nivelacion = \app\models\siad_pregrado\Estudiantes::find()
    ->select('CIInfPer, cedula_pasaporte, ApellInfPer, ApellMatInfPer, NombInfPer, FechNacimPer, StatusPer, mailInst')
    ->where(['CIInfPer' => $dni])
    ->orWhere(['cedula_pasaporte' => $dni])
    ->one();
if (isset($estudiante_nivelacion)) {
    $CIInfPer = $estudiante_nivelacion->CIInfPer;
}
$estudiante_pregrado = \app\models\siad_pregrado\Estudiantes::find()
    ->select('CIInfPer, cedula_pasaporte, ApellInfPer, ApellMatInfPer, NombInfPer, FechNacimPer, StatusPer, mailInst')
    ->where(['CIInfPer' => $dni])
    ->orWhere(['cedula_pasaporte' => $dni])
    ->one();
if (isset($estudiante_nivelacion)) {
    $CIInfPer = $estudiante_pregrado->CIInfPer;
}
$estudiante_posgrado = \app\models\siad_posgrado\EstudiantesPosgrado::find()
    ->select('CIInfPer, cedula_pasaporte, ApellInfPer, ApellMatInfPer, NombInfPer, FechNacimPer, StatusPer, mailInst')
    ->where(['CIInfPer' => $dni])
    ->orWhere(['cedula_pasaporte' => $dni])
    ->one();
if (isset($estudiante_posgrado)) {
    $CIInfPer = $estudiante_posgrado->CIInfPer;
}
$docente_pregrado = \app\models\siad_pregrado\Docentes::find()
    ->select('CIInfPer, cedula_pasaporte, ApellInfPer, ApellMatInfPer, NombInfPer, FechNacimPer, StatusPer, mailInst')
    ->where(['CIInfPer' => $dni])
    ->orWhere(['cedula_pasaporte' => $dni])
    ->one();
if (isset($docente_pregrado)) {
    $CIInfPer = $docente_pregrado->CIInfPer;
}

////////SIAD ESTUDIANTE NIVELACION//////////
$searchModelNivelacion = new \app\models\siad_nivelacion\EstudiantesNivelacionSearch();
$dataProviderNivelacion = $searchModelNivelacion->search(Yii::$app->request->queryParams);
$dataProviderNivelacion->query
    ->Where('CIInfPer = "' . $CIInfPer .'"');

$searchModelMatriculaNivelacion = new \app\models\siad_nivelacion\MatriculaNivelacionSearch();
$searchModelMatriculaNivelacion->CIInfPer = $CIInfPer;
$dataProviderMatriculaNivelacion = $searchModelMatriculaNivelacion->search(Yii::$app->request->queryParams);
$dataProviderMatriculaNivelacion->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idsemestre' => SORT_DESC,
];

////////SIAD ESTUDIANTE PREGRADO//////////
$searchModelPregrado = new app\models\siad_pregrado\EstudiantesSearch();
$dataProviderPregrado = $searchModelPregrado->search(Yii::$app->request->queryParams);
$dataProviderPregrado->query
    ->Where('CIInfPer = "' . $CIInfPer .'"');

$searchModelMatriculaPregrado = new \app\models\siad_pregrado\MatriculaSearch();
$searchModelMatriculaPregrado->CIInfPer = $CIInfPer;
$dataProviderMatriculaPregrado = $searchModelMatriculaPregrado->search(Yii::$app->request->queryParams);
$dataProviderMatriculaPregrado->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idsemestre' => SORT_DESC,
];

////////SIAD ESTUDIANTE POSGRADO//////////
$searchModelPosgrado = new app\models\siad_posgrado\EstudiantesPosgradoSearch();
$dataProviderPosgrado = $searchModelPosgrado->search(Yii::$app->request->queryParams);
$dataProviderPosgrado->query
    ->Where('CIInfPer = "' . $CIInfPer .'"');

$searchModelMatriculaPosgrado = new \app\models\siad_posgrado\MatriculaPosgradoSearch();
$searchModelMatriculaPosgrado->CIInfPer = $CIInfPer;
$dataProviderMatriculaPosgrado = $searchModelMatriculaPosgrado->search(Yii::$app->request->queryParams);
$dataProviderMatriculaPosgrado->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idsemestre' => SORT_DESC,
];

////////SIAD DOCENTE PREGRADO//////////
$searchModelDocentePregrado = new app\models\siad_pregrado\DocentesSearch();
$dataProviderDocentePregrado = $searchModelDocentePregrado->search(Yii::$app->request->queryParams);
$dataProviderDocentePregrado->query
    ->Where('CIInfPer = "' . $CIInfPer .'"');

$searchModelAsignaturasDocentePregrado = new \app\models\siad_pregrado\DocenteAsignaturaSearch();
$searchModelAsignaturasDocentePregrado->CIInfPer = $CIInfPer;
$dataProviderAsignaturasDocentePregrado = $searchModelAsignaturasDocentePregrado->search(Yii::$app->request->queryParams);
$dataProviderAsignaturasDocentePregrado->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idAsig' => SORT_ASC,
    'idParalelo' => SORT_ASC,
];
?>

<?php if($dataProviderNivelacion->getTotalCount() == 0
         and $dataProviderPregrado->getTotalCount() == 0
         and $dataProviderPosgrado->getTotalCount() == 0
         and $dataProviderDocentePregrado->getTotalCount() == 0
         and $dataProviderAsignaturasDocentePregrado->getTotalCount() == 0
) { ?>
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
                                Url::to(['siad_pregrado/docentes/update',
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

    <div class="alert alert-danger" align="center">
        <h3 align="center"> SIAD PREGRADO - Docente Asignaturas </h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProviderAsignaturasDocentePregrado,
        //'filterModel' => $searchModelAsignaturasDocentePregrado,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'dpa_id',
            [
                'label' => 'Período',
                'attribute' => 'idPer',
                'value' => function ($model) {
                    $periodo = $model->idPer;
                    return \app\models\siad_pregrado\Periodo::Periododescriptivo($periodo) . ' ('.$periodo.')';
                },
                'group' => true,  // enable grouping
            ],
            //'CIInfPer',
            [
                'label' => 'Código',
                'attribute' => 'idAsig',
            ],
            [
                'label' => 'Asignatura',
                'attribute' => 'idAsig',
                'value' => function ($model) {
                    $idAsig = $model->idAsig;
                    $asignatura = \app\models\siad_pregrado\Asignatura::find()
                        ->select('nombAsig')
                        ->where(['idAsig' => $idAsig])
                        ->one();

                    return $asignatura->nombAsig;
                }
            ],
            'idParalelo',
            [
                'label' => 'Carrera',
                'attribute' => 'idCarr',
                'value' => function ($model) {
                    $idCarr = $model->idCarr;
                    return \app\models\siad_pregrado\Carrera::Carreradescriptivo($idCarr);
                }
            ],
            //'idAnio',
            [
                'label' => 'Nivel',
                'value' => function ($model) {
                    $idSemestre = $model->idSemestre;
                    $bloque = $model->bloque;
                    if ($idSemestre != NULL) {
                        return $idSemestre;
                    } elseif ($bloque != NULL) {
                        return $bloque;
                    } else {
                        return '-';
                    }
                }
            ],
            //'idSemestre',
            //'bloque',
            //'status',
            //'idMc',
            //'tipo_orgmalla',
            //'id_actdist',
            //'id_contdoc',
            //'transf_asistencia',
            //'transf_frecuente',
            //'transf_parcial',
            //'transf_final',
            //'transf_supletorio',
            //'transf_cursointensivo',
            //'transf_recuperacion',
            //'arrastre',
            //'extra',
            //'compensar_horas',
            //'compensar_tipo',
            //'regimen_academico',
            //'tutor',
            [
                'label' => 'Matr.',
                'value' => function ($model) {
                    $dpa_id = $model->dpa_id;
                    $naa = \app\models\siad_pregrado\NotasAlumno::find()
                        ->select('idnaa')
                        ->where(['dpa_id' => $dpa_id])
                        ->all();

                    return count($naa);
                }
            ],
            //'cupo',

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
                                Url::to(['siad_posgrado/estudiantesposgrado/update',
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
                //'CIInfPer',
                [
                    'attribute'=>'idPer',
                    'value'=>function($model){
                        $periodo = \app\models\siad_posgrado\PeriodoPosgrado::findOne($model->idPer);
                        return $periodo->getPeriodoDetalle().' ('.$model->idPer.')';
                    },
                    'group' => true,
                    'hAlign'=>'center',
                    'vAlign'=>'middle',
                ],
                [
                    'label' => 'Carrera',
                    'attribute' => 'idCarr',
                    'value' => function ($model) {
                        $carrera = \app\models\siad_posgrado\CarreraPosgrado::findOne($model->idCarr);
                        return $carrera->getFullname();
                    },
                ],
                //'idanio',
                'idsemestre',
                'FechaMatricula',
                //'idParalelo',
                //'idMatricula_ant',
                //'tipoMatricula',
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
                [
                    'label' => 'Asignaturas',
                    'value' => function($model) {
                        $naas = \app\models\siad_pregrado\NotasAlumno::find()
                            ->select('idAsig, dpa_id')
                            ->andWhere(['CIInfPer' => $model->CIInfPer])
                            ->andWhere(['idper' => $model->idPer])
                            ->andWhere(['idMatricula' => $model->idMatricula])
                            ->orderBy('idAsig ASC')
                            ->all();
                        if (count($naas) > 0) {
                            $i=0;$echo = '';
                            foreach ($naas as $naa) {
                                $i=$i+1;
                                $idAsig = $naa->idAsig;
                                $dpa_id = $naa->dpa_id;
                                $asignatura = \app\models\siad_pregrado\Asignatura::find()
                                    ->select('nombAsig')
                                    ->where(['idAsig' => $idAsig])
                                    ->one();
                                $nombAsig = $asignatura->nombAsig;
                                $dpa = \app\models\siad_pregrado\DocenteAsignatura::find()
                                    ->select('idParalelo')
                                    ->where(['dpa_id' => $dpa_id])
                                    ->one();
                                if (isset($dpa)) {
                                    $idParalelo = $dpa->idParalelo;;
                                    $echo =  $echo .
                                        $i.'. '.
                                        $idAsig.
                                        ' -- '.
                                        $nombAsig.' ('.$idParalelo.')'.
                                        '<br>';
                                } else {
                                    $echo =  $echo .
                                        $i.'. '.
                                        $idAsig.
                                        ' -- '.
                                        $nombAsig. ' (<code>Sin paralelo</code>)'.
                                        '<br>';
                                }
                            }
                            return $echo;
                        } else {
                            return '-';
                        }
                    },
                    'format' => 'html',
                ],
                'statusMatricula',

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
                                Url::to(['siad_pregrado/estudiantes/update',
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

                //'idMatricula_anual',
                //'CIInfPer',
                [
                    'attribute'=>'idPer',
                    'value'=>function($model){
                        $periodo = \app\models\siad_pregrado\Periodo::findOne($model->idPer);
                        return $periodo->getPeriodoDetalle().' ('.$model->idPer.')';
                    },
                    'group' => true,
                    'hAlign'=>'center',
                    'vAlign'=>'middle',
                ],
                [
                    'label' => 'Carrera',
                    'attribute' => 'idCarr',
                    'value' => function ($model) {
                        $carrera = \app\models\siad_pregrado\Carrera::findOne($model->idCarr);
                        return $carrera->getFullname();
                    },
                ],
                'idMatricula',
                //'idanio',
                //'idsemestre',
                'FechaMatricula',
                //'idParalelo',
                //'idMatricula_ant',
                //'tipoMatricula',
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
                [
                    'label' => 'Asignaturas',
                    'value' => function($model) {
                        $naas = \app\models\siad_pregrado\NotasAlumno::find()
                            ->select('idAsig, dpa_id')
                            ->andWhere(['CIInfPer' => $model->CIInfPer])
                            ->andWhere(['idper' => $model->idPer])
                            ->andWhere(['idMatricula' => $model->idMatricula])
                            ->orderBy('idAsig ASC')
                            ->all();
                        if (count($naas) > 0) {
                            $i=0;$echo = '';
                            foreach ($naas as $naa) {
                                $i=$i+1;
                                $idAsig = $naa->idAsig;
                                $dpa_id = $naa->dpa_id;
                                $asignatura = \app\models\siad_pregrado\Asignatura::find()
                                    ->select('nombAsig')
                                    ->where(['idAsig' => $idAsig])
                                    ->one();
                                $nombAsig = $asignatura->nombAsig;
                                $dpa = \app\models\siad_pregrado\DocenteAsignatura::find()
                                    ->select('idParalelo')
                                    ->where(['dpa_id' => $dpa_id])
                                    ->one();
                                if (isset($dpa)) {
                                    $idParalelo = $dpa->idParalelo;;
                                    $echo =  $echo .
                                        $i.'. '.
                                        $idAsig.
                                        ' -- '.
                                        $nombAsig.' ('.$idParalelo.')'.
                                        '<br>';
                                } else {
                                    $echo =  $echo .
                                        $i.'. '.
                                        $idAsig.
                                        ' -- '.
                                        $nombAsig. ' (<code>Sin paralelo</code>)'.
                                        '<br>';
                                }
                            }
                            return $echo;
                        } else {
                            return '-';
                        }
                    },
                    'format' => 'html',
                ],
                [
                    'label' => 'Sem/Nivel',
                    'value' => function ($model) {
                        $idsemestre = $model->idsemestre;
                        if ($idsemestre != NULL) {
                            return 'Sem.: '.$idsemestre;
                        } else {
                            $CIInfPer = $model->CIInfPer;
                            $idPer = $model->idPer;
                            $idCarr = $model->idCarr;
                            $perlec_carr_est_nivel = \app\models\siad_pregrado\PerlecCarrEstNivel::find()
                                ->select('nivel')
                                ->where(['ciinfper' => $CIInfPer])
                                ->andWhere(['idper' => $idPer])
                                ->andWhere(['idcarr' => $idCarr])
                                ->one();
                            if (isset($perlec_carr_est_nivel)) {
                                return 'Nivel: '.$perlec_carr_est_nivel->nivel;
                            }
                        }
                        return '-';
                    }
                ],
                'statusMatricula',

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
                                Url::to(['siad_nivelacion/estudiantesnivelacion/update',
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
