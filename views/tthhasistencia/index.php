<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TthhAsistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tthh Asistencias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tthh-asistencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tthh Asistencia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_asistencia',
            'idx_servidor',
            'idx_tipoasistencia',
            'idx_motivo',
            'idx_tipodocumento',
            //'numero_documento',
            //'fecha_inicio',
            //'fecha_fin',
            //'dias',
            //'horas',
            //'minutos',
            //'descripcion:ntext',
            //'status_envio',
            //'fecha_envio',
            //'status_revision',
            //'fecha_revision',
            //'status_aprobacion',
            //'fecha_aprobacion',
            //'ip_registrado',
            //'idx_usuario',
            //'hora_inicial',
            //'hora_final',
            //'vacaciones_st',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
