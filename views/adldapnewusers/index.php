<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdldapNewUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adldap New Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adldap-new-users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Adldap New Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dni',
            'nombres',
            'apellidos',
            'fec_nacimiento',
            //'campus',
            //'carrera',
            //'email_personal:email',
            //'celular',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
