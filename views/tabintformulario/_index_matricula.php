<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MatriculaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);

} else {
    $sAMAccountname = Yii::$app->user->identity->username;
    $user = Yii::$app->ad->getProvider('default')->search()
        ->findBy('sAMAccountname', $sAMAccountname);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);
}

$searchModelMatricula = new \app\models\MatriculaSearch();
$searchModelMatricula->CIInfPer = $dni;
$searchModelMatricula->idPer = '34';
$dataProviderMatricula = $searchModelMatricula->search(Yii::$app->request->queryParams);
$dataProviderMatricula->sort->defaultOrder = [
    'idsemestre' => SORT_DESC,
];

?>
<div class="matricula-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderMatricula,
        //'filterModel' => $searchModelMatricula,
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
