<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocenteAsignaturaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Docente Asignaturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="docente-asignatura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //= Html::a('Create Docente Asignatura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'dpa_id',
            //'idPer',
            'CIInfPer',
            [
                'label' => 'Nombres',
                'attribute' => 'CIInfPer',
                'value' => function ($model) {
                    $dni = $model->CIInfPer;
                    $docente = \app\models\Docentes::find()
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
            //'idCarr',
            //'idAnio',
            //'idSemestre',
            //'bloque',
            //'idParalelo',
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
            //'cupo',

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
