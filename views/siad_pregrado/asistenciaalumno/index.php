<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\siad_pregrado\AsistenciaAlumnoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asistencia Alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistencia-alumno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asistencia Alumno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_asist',
            'ciinfper',
            'fecha_asal',
            'hora_asal',
            'idPer',
            //'idnaa',
            //'observacion_asal',
            //'numsesion_asal',
            //'presente',
            //'ausente',
            //'atraso',
            //'justificada',
            //'fecha_creacion',
            //'fecha_modif',
            //'observacion:ntext',
            //'id_plasig',
            //'fecha_just_asal',
            //'usu_reg_just_asal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
