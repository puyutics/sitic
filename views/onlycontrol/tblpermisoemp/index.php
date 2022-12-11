<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\TblPermisoempSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Permisoemps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-permisoemp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Permisoemp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NOMINA_ID',
            'P_CAPTURAH',
            'P_CAPTURAF',
            'P_PERMISOS',
            'P_NOTIFICACION',
            //'P_DOCUMENTOS',
            //'P_CREDENCIAL',
            //'P_MUEVEUSER',
            //'P_EXPORTA',
            //'P_CAMBIOMASIVO',
            //'P_LISTOCONTROL',
            //'P_IMPORTAVIRDI',
            //'P_RESTRICCION',
            //'P_REPORTE',
            //'P_CAPTURAR',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
