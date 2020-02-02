<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CheckExactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="check-exact-index">

    <?php
    $searchModelCheckExact = new \app\models\CheckExactSearch();
    $searchModelCheckExact->USERID = $model->USERID;
    $dataProviderCheckExact = $searchModelCheckExact->search(Yii::$app->request->queryParams);

    $dataProviderCheckExact->sort->defaultOrder = [
        'CHECKTIME' => SORT_DESC]
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderCheckExact,
        //'filterModel' => $searchModelCheckExact,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Día',
                'attribute' => 'CHECKTIME',
                'value'=>function($searchModelCheckInOut){
                    $date = $searchModelCheckInOut->CHECKTIME;
                    $dayname = date('l', strtotime($date));
                    $dias = array(
                        'Monday'=>'Lunes',
                        'Tuesday'=>'Martes',
                        'Wednesday'=>'Miércoles',
                        'Thursday'=>'Jueves',
                        'Friday'=>'Viernes',
                        'Saturday'=>'Sábado',
                        'Sunday'=>'Domingo'
                    );
                    return $dias[$dayname];
                },
                'group' => true,  // enable grouping
            ],
            [
                'label' => 'Marcación',
                'attribute' => 'CHECKTIME',
            ],
            [
                'label' => 'Motivo',
                'attribute' => 'YUYIN',
            ],
            [
                'label' => 'Usuario',
                'attribute' => 'MODIFYBY',
            ],

            //'EXACTID',
            //'USERID',
            //'CHECKTIME',
            //'CHECKTYPE',
            //'ISADD',
            //'YUYIN',
            //'ISMODIFY',
            //'ISDELETE',
            //'INCOUNT',
            //'ISCOUNT',
            //'MODIFYBY',
            //'DATE',

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'responsive' => true,
        'panel' => [
            'type' => \kartik\grid\GridView::TYPE_PRIMARY
        ],
    ]); ?>
</div>
