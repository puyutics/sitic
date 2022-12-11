<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\ExternoeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Externoes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="externoe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Externoe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'EMPE_ID',
            'EMPE_NOM',
            'EMPE_DIR',
            'EMPE_RUC',
            'EMPE_REP',
            //'EMPE_TELF',
            //'EMPE_FAX',
            //'EMPE_WEB',
            //'EMPE_CONT',
            //'EMPE_OBS',
            //'EMPE_CODE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
