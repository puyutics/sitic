<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\biometrico\CheckInOutSearch;

/* @var $this yii\web\View */
/* @var $model */

$dni = $model->dni;

$user_info = \app\models\biometrico\UserInfo::find()
    ->where(['SSN' => $dni])
    ->one();

if (isset($user_info)) {
    $searchModelCheckInOut = new CheckInOutSearch();
    $searchModelCheckInOut->USERID = $user_info->USERID;
    $dataProviderCheckInOut = $searchModelCheckInOut->search(Yii::$app->request->queryParams);
    $dataProviderCheckInOut->sort->defaultOrder = ['CHECKTIME' => SORT_DESC];
    $dataProviderCheckInOut->pagination = ['pageSize' => 100];
}

?>

<div class="check-in-out-index">

    <?php if (!isset($user_info)) { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center">No existe información</h3>
        </div>
    <?php } else { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center"><?= $user_info->sca_Apellido .' '. $user_info->sca_Nombre ?></h3>
            <h4 align="center" style="color:palevioletred">Tipo: <?php if ($user_info->EMPRIVILEGE == 1) echo 'Administrador'; else echo 'Usuario'; ?></h4>
            <h4 align="center" style="color:palevioletred">Cédula: <?= $user_info->SSN ?></h4>
            <h4 align="center" style="color:palevioletred">Código: <?= $user_info->USERID ?></h4>
        </div>

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
    <?php } ?>
</div>
