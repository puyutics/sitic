<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\TblmodTurnoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tblmod Turnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmod-turno-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tblmod Turno', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'MOD_ID',
            'MOD_DES',
            'MOD_LUNES',
            'MOD_MARTES',
            'MOD_MIERCOLES',
            //'MOD_JUEVES',
            //'MOD_VIERNES',
            //'MOD_SABADO',
            //'MOD_DOMINGO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
