<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\NomPuertalogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nom Puertalogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nom-puertalog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nom Puertalog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'NOM_ID',
            'PUER_ID',
            'TURN_ID',
            'TURN_FECI',
            'TURN_FECF',
            'TURN_TIPO',
            'TURN_STA',
            'TURN_NOW',
            'TURN_DELNOW',

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            '{export}',
            '{toggleData}'
        ],
        'pjax' => false,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>
</div>
