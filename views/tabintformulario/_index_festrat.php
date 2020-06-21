<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BecasFestratSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);

} else {
    $sAMAccountname = Yii::$app->user->identity->username;
    $user = Yii::$app->ad->getProvider('default')->search()
        ->findBy('sAMAccountname', $sAMAccountname);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);
}

$searchModelBecasFestrat = new \app\models\BecasFestratSearch();
$searchModelBecasFestrat->cedula = $dni;
$dataProviderBecasFestrat = $searchModelBecasFestrat->search(Yii::$app->request->queryParams);
$dataProviderBecasFestrat->sort->defaultOrder = [
    'periodo' => SORT_DESC,
];

?>
<div class="becas-festrat-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderBecasFestrat,
        //'filterModel' => $searchModelBecasFestrat,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idficha_sa',
            'cedula',
            'nombres_comp',
            'periodo',
            //'p11',
            //'p12',
            //'p13',
            //'p14',
            //'p15',
            //'p21',
            //'p22',
            //'p23',
            //'p24',
            //'p31',
            //'p32',
            //'p33',
            //'p34',
            //'p35',
            //'p36',
            //'p37',
            //'p41',
            //'p42',
            //'p43',
            //'p44',
            //'p45',
            //'p51',
            //'p61',
            //'p62',
            //'p63',
            //'total',
            //'valoracion',
            'Grupo',
            'fecha_reg',
            //'status',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'pjax' => true,
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
