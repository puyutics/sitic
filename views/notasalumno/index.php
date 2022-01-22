<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotasAlumnoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notas Alumnos';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="notas-alumno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a('Create Notas Alumno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'idnaa',
            //'idPer',
            'CIInfPer',
            [
                'label' => 'Nombres',
                'attribute' => 'CIInfPer',
                'value' => function ($model) {
                    $dni = $model->CIInfPer;
                    $docente = \app\models\Estudiantes::find()
                        ->where(['CIInfPer' => $dni])
                        ->one();

                    return $docente->ApellInfPer . ' ' .
                           $docente->ApellMatInfPer . ' ' .
                           $docente->NombInfPer;
                }
            ],
            'idAsig',
            [
                'label' => 'Asignatura',
                'attribute' => 'idAsig',
                'value' => function ($model) {
                    $idAsig = $model->idAsig;
                    $asignatura = \app\models\Asignatura::find()
                        ->where(['idAsig' => $idAsig])
                        ->one();

                    return $asignatura->nombAsig;
                }
            ],
            'idMatricula',
            [
                'label' => 'Matricula',
                'attribute' => 'idMatricula',
                'value' => function ($model) {
                    $idMatricula = $model->idMatricula;
                    $matricula = \app\models\Matricula::find()
                        ->where(['idMatricula' => $idMatricula])
                        ->one();

                    return $matricula->statusMatricula;
                }
            ],
            //'CAC1',
            //'CAC2',
            //'CAC3',
            //'TCAC',
            //'CEF',
            //'CSP',
            //'CCR',
            //'CSP2',
            //'CalifFinal',
            //'asistencia',
            //'StatusCalif',
            //'idMatricula',
            //'VRepite',
            //'observacion',
            //'op1',
            //'op2',
            //'op3',
            //'pierde_x_asistencia',
            //'pierde_x_ppf',
            //'repite',
            //'retirado',
            //'excluidaxrepitencia',
            //'excluidaxreingreso',
            //'excluidaxresolucion',
            //'excluidaxcambiomalla',
            //'convalidacion',
            //'convalida_ppf',
            //'aprobada',
            //'anulada',
            //'arrastre',
            //'registro_asistencia',
            //'usu_registro_asistencia',
            //'registro',
            //'ultima_modificacion',
            //'usu_pregistro',
            //'usu_umodif_registro',
            //'archivo',
            //'archivo_conv_ppf',
            //'idMc',
            //'institucion_proviene',
            //'observacion_conv',
            //'porcentaje_convalidacion',
            //'usuario_conv',
            //'observacion_conv_ppf',
            //'usuario_conv_ppf',
            //'exam_final_atrasado',
            //'exam_supl_atrasado',
            //'exam_supl_sancion',
            //'observacion_efa',
            //'observacion_espa',
            //'observacion_sps',
            //'observacion_op3',
            //'usu_habilita_efa',
            //'usu_habilita_espa',
            //'usu_habilita_sps',
            //'usu_habilita_op3',
            //'dpa_id',

            //['class' => 'kartik\grid\ActionColumn'],
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
