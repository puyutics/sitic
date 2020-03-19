<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CheckInOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Check In Outs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-in-out-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Check In Out'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'USERID',
            'CHECKTIME',
            'CHECKTYPE',
            'VERIFYCODE',
            'SENSORID',
            //'Memoinfo',
            //'WorkCode',
            //'sn',
            //'UserExtFmt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
