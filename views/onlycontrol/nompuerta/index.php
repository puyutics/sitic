<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\NomPuertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nom Puertas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nom-puerta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Nom Puerta', ['create'], ['class' => 'btn btn-success']) ?>
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
            //'TURN_TIPO',
            //'TURN_STA',
            //'TURN_NOW',
            //'TURN_MARCA',
            //'TURN_TCOD',
            //'TURN_SEL',
            //'TURN_ESTADO_UP',
            //'TURN_FECHA_UP',
            //'ES_SINCRONIZADO',
            //'ES_UPDATE',
            //'TURN_CONFSIMILAR',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
