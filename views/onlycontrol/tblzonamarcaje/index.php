<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\TblZonamarcajeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Zonamarcajes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-zonamarcaje-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Zonamarcaje', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ZM_ID',
            'ZM_DES',
            'ZM_SEL',
            'ZM_EMPE',
            'ZM_EMPE_NOM',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
