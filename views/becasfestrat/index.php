<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BecasFestratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Becas Festrats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="becas-festrat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Becas Festrat'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idficha_sa',
            'cedula',
            'nombres_comp',
            'periodo',
            'p11',
            //'p12',
            //'p13',
            //'p14',
            //'p15',
            //'p21',
            //'p22',
            //'p23',
            //'p24',
            //'p31',
            //'p32',
            //'p33',
            //'p34',
            //'p35',
            //'p36',
            //'p37',
            //'p41',
            //'p42',
            //'p43',
            //'p44',
            //'p45',
            //'p51',
            //'p61',
            //'p62',
            //'p63',
            //'total',
            //'valoracion',
            //'Grupo',
            //'fecha_reg',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
