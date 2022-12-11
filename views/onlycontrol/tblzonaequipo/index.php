<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\TblZonaequipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Zonaequipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-zonaequipo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Zonaequipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AREA_ZM_ID',
            'ZM_ID',
            'PRT_COD',
            'PRI_DES',
            'PRT_SEL',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
