<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\PuertaStaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs del Servidor (Global)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="puerta-sta-index">

    <div class="alert alert-warning" align="center">
        <h3 align="center"><?= $this->title ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'P_ID',
            'P_Maq',
            'P_Fecha',
            'P_Status',
            'P_User',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
