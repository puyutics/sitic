<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\NewCredencialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'New Credencials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-credencial-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create New Credencial', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CR_ID',
            'CR_FIMPRESION',
            'CR_RESULTADO',
            'CR_CEDULA',
            'CR_CIUDADANO',
            //'CR_FCADUDA',
            //'CR_UIMPRIME',
            //'CR_AAUTORIZA',
            //'CR_FAUTORIZA',
            //'CR_TARJETA',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
