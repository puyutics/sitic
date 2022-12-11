<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\AcUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ac Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ac-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ac User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AC_USER',
            'AC_P1',
            'AC_P2',
            'AC_P3',
            'AC_P4',
            //'AC_P5',
            //'AC_P6',
            //'AC_P7',
            //'AC_P8',
            //'AC_P9',
            //'AC_P10',
            //'AC_P11',
            //'AC_P12',
            //'AC_P13',
            //'AC_P14',
            //'AC_P15',
            //'AC_P16',
            //'AC_P17',
            //'AC_P18',
            //'AC_P19',
            //'AC_P20',
            //'AC_UCREA',
            //'AC_FCREA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
