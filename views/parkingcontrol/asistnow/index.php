<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\parkingcontrol\AsistnowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asistnows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistnow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asistnow', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ASIS_ID',
            'ASIS_ING',
            'ASIS_ZONA',
            'ASIS_FECHA',
            'ASIS_HORA',
            //'ASIS_TIPO',
            //'ASIS_RES',
            //'ASIS_F',
            //'ASIS_FN',
            //'ASIS_HN',
            //'ASIS_PRINT',
            //'ASIS_NOVEDAD',
            //'ASIS_MM',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
