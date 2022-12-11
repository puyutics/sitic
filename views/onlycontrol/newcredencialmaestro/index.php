<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\NewCredencialMaestroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Credencial Maestros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-credencial-maestro-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create New Credencial Maestro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CR_ID',
            'CR_DES',
            'CR_IMG',
            'CR_FIRMA',
            'CR_FOTO',
            //'CR_TIPO',
            //'CR_FOTOF',
            //'CR_CBARRA',
            //'CR_UCREA',
            //'CR_FCREA',
            //'CR_UserRI',
            //'CR_ClaveRI',
            //'CR_IMGATRAS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
