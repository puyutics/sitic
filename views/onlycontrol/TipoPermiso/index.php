<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\TipoPermisoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Permisos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-permiso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipo Permiso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TIPO_ID',
            'TIPO_NOM',
            'TIPO_COD_N',
            'TIPO_COD_A',
            'TIPO_FACE',
            //'TIPO_IRIS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
