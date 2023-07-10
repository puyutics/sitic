<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\siad_pregrado\PlanificacionAsignaturaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planificacion Asignaturas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planificacion-asignatura-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Planificacion Asignatura', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_plasig',
            'dpa_id',
            'num_unidad',
            'desc_unidad',
            'tema_clase',
            //'contenido',
            //'metodologia',
            //'num_encuentro',
            //'fecha',
            //'hora_ini_planif',
            //'hora_fin_planif',
            //'fecha_reg',
            //'objetivo_plasig:ntext',
            //'fecha_rcd',
            //'hora_inicio',
            //'hora_fin',
            //'fecha_cierre',
            //'hora_cierre',
            //'hc_periodo',
            //'num_periodos',
            //'ip_pcacceso',
            //'nomb_pcacceso',
            //'observacion:ntext',
            //'atraso',
            //'status',
            //'ps_id',
            //'fecha_recp',
            //'hora_ini_recp',
            //'hora_fin_recp',
            //'autorizacion_recp',
            //'estado_asist',
            //'acceso',
            //'id_amb',
            //'habilita_asist',
            //'usu_habilita_asist',
            //'usu_habilita_pldoc',
            //'id_actdist',
            //'habilita_frec',
            //'usu_habilita_frec',
            //'ce_id',
            //'bloqueado_x_parcial',
            //'usu_dicta',
            //'extra',
            //'excluida_x_disposicion',
            //'archivo_justificativo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
