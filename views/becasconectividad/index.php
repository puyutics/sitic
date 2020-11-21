<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BecasConectividadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Becas Conectividads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="becas-conectividad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Becas Conectividad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'dni',
            //'username',
            'nombres',
            'apellidos',
            'email:email',
            'provincia',
            //'cel_contacto',
            //'tel_contacto',
            //'cuenta_dni',
            //'cuenta_numero',
            //'cuenta_titular',
            //'cuenta_tipo',
            //'cuenta_institucion',
            //'siad_matriculado',
            //'siad_semestre',
            //'siad_carrera',
            'ficha_escasos_recursos',
            'fec_registro',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
