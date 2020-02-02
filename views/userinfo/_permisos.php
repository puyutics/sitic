<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TthhAsistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="tthh-asistencia-index">

    <?php
    $searchModelServidor = new \app\models\TthhServidorSearch();
    $searchModelServidor->id_documento = $model->SSN;
    $dataProviderPermisos = $searchModelServidor->search(Yii::$app->request->queryParams);

    if ($dataProviderPermisos->getTotalCount()>0) {
        $searchModelPermisos = new \app\models\TthhAsistenciaSearch();
    } else {
        $searchModelPermisos = new \app\models\TthhAsistenciaDocSearch();
    }

    $searchModelPermisos->idx_servidor = $model->SSN;
    $dataProviderPermisos = $searchModelPermisos->search(Yii::$app->request->queryParams);

    $dataProviderPermisos->sort->defaultOrder = [
        'fecha_inicio' => SORT_DESC]
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPermisos,
        //'filterModel' => $searchModelPermisos,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'label' => 'Inicio',
                'attribute' => 'fecha_inicio',
            ],
            [
                'label' => 'Fin',
                'attribute' => 'fecha_fin',
            ],
            'hora_inicial',
            'hora_final',
            //'dias',
            //'horas',
            //'minutos',
            [
                'label'=>'Tipo',
                'attribute'=>'idx_tipoasistencia',
                'value' => 'xTipoasistencia.tipo',
                'format'=>'raw',
            ],
            [
                'label'=>'Motivo',
                'attribute'=>'idx_motivo',
                'value' => 'xMotivo.motivo',
                'format'=>'raw',
            ],
            [
                'label'=>'Documento',
                'attribute'=>'idx_tipodocumento',
                'value' => 'xTipodocumento.documento',
                'format'=>'raw',
            ],
            [
                'attribute'=>'descripcion',
                'width'=>'150px'
            ],


            //'id_asistencia',
            //'idx_servidor',
            //'idx_tipoasistencia',
            //'idx_motivo',
            //'idx_tipodocumento',
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

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'responsive' => true,
        'panel' => [
            'type' => \kartik\grid\GridView::TYPE_PRIMARY
        ],
    ]); ?>
</div>
