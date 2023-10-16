<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\parkingcontrol\NomPuertaDelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nom Puerta Dels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nom-puerta-del-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nom Puerta Del', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NOM_ID',
            'PUER_ID',
            'FLAG_T',
            'TURN_ESTADO_DEL',
            'TURN_FECHA_DEL',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
