<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CheckInOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<div class="check-in-out-index">

    <?php
    $searchModelCheckInOut = new \app\models\CheckInOutSearch();
    $searchModelCheckInOut->USERID = $model->USERID;
    $dataProviderCheckInOut = $searchModelCheckInOut->search(Yii::$app->request->queryParams);

    $dataProviderCheckInOut->sort->defaultOrder = [
        'CHECKTIME' => SORT_DESC]
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderCheckInOut,
        //'filterModel' => $searchModelCheckInOut,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'USERID',

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
            'CHECKTIME',
            [
                'attribute' => 'CHECKTYPE',
                'value'=>function($searchModelCheckInOut){
                    if ($searchModelCheckInOut->CHECKTYPE == '0') {
                        return "E/S Asistencia";
                    } else {
                        return "No definido";
                    }
                },
            ],
            [
                'label'=>'Biométrico',
                'attribute'=>'SENSORID',
                'value' => 'machines.MachineAlias',
                'format'=>'raw',
            ],
            [
                'attribute' => 'VERIFYCODE',
                'value'=>function($searchModelCheckInOut){
                    if ($searchModelCheckInOut->VERIFYCODE == '0') {
                        return "HD";
                    } elseif ($searchModelCheckInOut->VERIFYCODE == '1') {
                        return "HD";
                    } elseif ($searchModelCheckInOut->VERIFYCODE == '3') {
                        return "CV";
                    } elseif ($searchModelCheckInOut->VERIFYCODE == '4') {
                        return "TM";
                    } elseif ($searchModelCheckInOut->VERIFYCODE == '10') {
                        return "MM";
                    } else {
                        return "No definido";
                    }
                },
                'width'=>'50px'
            ],

            //'SENSORID',
            //'Memoinfo',
            //'WorkCode',
            //'sn',
            //'UserExtFmt',

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
