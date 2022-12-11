<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\DptoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dptos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dpto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dpto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DEP_ID',
            'DEP_ARE',
            'DEP_NOM',
            'DEP_DESC',
            'DEP_OBS',
            //'DEP_EM',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
