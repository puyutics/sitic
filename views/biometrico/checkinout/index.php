<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\biometrico\CheckInOutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros de acceso (Global)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-in-out-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= $this->title ?></h3>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'Nombre',
                'attribute' => 'USERID',
                'value'=>function($model){
                    $user = \app\models\biometrico\UserInfo::find()
                        ->where(['USERID'=>$model->USERID])
                        ->one();
                    return $user->NAME;
                },
            ],
            'CHECKTIME',
            /*[
                'attribute' => 'CHECKTYPE',
                'value'=>function($model){
                    if ($model->CHECKTYPE == '0') {
                        return "E/S Asistencia";
                    } else {
                        return "No definido";
                    }
                },
            ],*/
            //'VERIFYCODE',
            [
                'label'=>'Biométrico',
                'attribute'=>'SENSORID',
                'value' => 'machines.MachineAlias',
                'format'=>'raw',
            ],
            //'Memoinfo',
            //'WorkCode',
            //'sn',
            //'UserExtFmt',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
