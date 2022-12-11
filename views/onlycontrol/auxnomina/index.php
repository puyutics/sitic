<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\AuxNominaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Aux Nominas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aux-nomina-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Aux Nomina', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ANOM_ID',
            'ANOM_APE',
            'ANOM_NOM',
            'ANOM_CED',
            'ANOM_EMP',
            //'ANOM_AREA',
            //'ANOM_DPTO',
            //'ANOM_CAR',
            //'ANOM_FECN',
            //'ANOM_OBS',
            //'ANOM_TIPO',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
