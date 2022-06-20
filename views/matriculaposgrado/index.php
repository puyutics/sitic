<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MatriculaPosgradoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matricula Posgrados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matricula-posgrado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Matricula Posgrado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idMatricula',
            'idMatricula_anual',
            'idPer',
            'CIInfPer',
            'idCarr',
            //'idanio',
            //'idsemestre',
            //'FechaMatricula',
            //'idParalelo',
            //'idMatricula_ant',
            //'tipoMatricula',
            //'statusMatricula',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
