<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model yii\web\View */

$dni = $model->dni;

////////SIAD NIVELACION//////////
$searchModelNivelacion = new \app\models\siad_nivelacion\EstudiantesNivelacionSearch();
$dataProviderNivelacion = $searchModelNivelacion->search(Yii::$app->request->queryParams);
$dataProviderNivelacion->query->Where('CIInfPer = "' . $dni .'"');

$searchModelMatriculaNivelacion = new \app\models\siad_nivelacion\MatriculaNivelacionSearch();
$searchModelMatriculaNivelacion->CIInfPer = $dni;
$dataProviderMatriculaNivelacion = $searchModelMatriculaNivelacion->search(Yii::$app->request->queryParams);
$dataProviderMatriculaNivelacion->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idsemestre' => SORT_DESC,
];

////////SIAD PREGRADO//////////
$searchModelPregrado = new app\models\siad_pregrado\EstudiantesSearch();
$dataProviderPregrado = $searchModelPregrado->search(Yii::$app->request->queryParams);
$dataProviderPregrado->query->Where('CIInfPer = "' . $dni .'"');

$searchModelMatriculaPregrado = new \app\models\siad_pregrado\MatriculaSearch();
$searchModelMatriculaPregrado->CIInfPer = $dni;
$dataProviderMatriculaPregrado = $searchModelMatriculaPregrado->search(Yii::$app->request->queryParams);
$dataProviderMatriculaPregrado->sort->defaultOrder = [
    'idPer' => SORT_DESC,
    'idsemestre' => SORT_DESC,
];

?>

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
                            return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i>Editar</span>',
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
                'CIInfPer',
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
                            $perlec_carr_est_nivel = \app\models\siad_pregrado\PerlecCarrEstNivel::find()
                                ->select('nivel')
                                ->where(['ciinfper' => $CIInfPer])
                                ->andWhere(['idper' => $idPer])
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
                //'cedula_pasaporte',
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
                            return Html::a('<span class="btn btn-primary center-block"><i class="fa fa-fw fa-edit"></i>Editar</span>',
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
