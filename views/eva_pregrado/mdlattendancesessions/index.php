<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\eva_pregrado\MdlAttendanceSessionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'EVA Pregrado | Asistencia >> Sesiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdl-attendance-sessions-index">

    <h1 align="center" class="alert alert-info">
        <?= Html::encode($this->title) ?>
    </h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'attendanceid',
            //'groupid',
            [
                'label' => 'Curso',
                'value' => function($model) {
                    $mdl_attendance_id = $model->attendanceid;
                    $mdl_attendance = \app\models\eva_pregrado\MdlAttendance::findOne($mdl_attendance_id);
                    $mdl_course_id = $mdl_attendance->course;
                    $mdl_course = \app\models\eva_pregrado\MdlCourse::findOne($mdl_course_id);
                    return Html::a($mdl_course->fullname,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                },
                'headerOptions' => ['style' => 'width:20%'],
                'format' => 'raw',
                'group' => true,
            ],
            [
                'label' => 'Inicio',
                'value' => 'sessdate',
                'format' => 'datetime',
            ],
            [
                'label' => 'Fin',
                'value' => function($model) {
                    return $model->sessdate + $model->duration;
                },
                'format' => 'datetime',
            ],
            //'duration',
            //'lasttaken',
            //'lasttakenby',
            //'timemodified:datetime',
            //'description:ntext',
            //'descriptionformat',
            //'studentscanmark',
            [
                'label' => 'Automarcación',
                'value' => function($model) {
                    if ($model->studentscanmark == 0) return 'No';
                    if ($model->studentscanmark == 1) return 'Si';
                    return $model->studentscanmark;
                },
            ],
            //'allowupdatestatus',
            //'studentsearlyopentime:datetime',
            //'autoassignstatus',
            //'studentpassword',
            //'subnet',
            //'automark',
            //'automarkcompleted',
            //'statusset',
            //'absenteereport',
            //'preventsharedip',
            //'preventsharediptime:datetime',
            //'caleventid',
            //'calendarevent',
            //'includeqrcode',
            //'rotateqrcode',
            //'rotateqrcodesecret',
            //'automarkcmid',
            [
                'label' => 'Registros',
                'value' => function($model) {
                    $mdl_attendance_sessions_id = $model->id;
                    $mdl_attendance_log = \app\models\eva_pregrado\MdlAttendanceLog::find()
                        ->where(['sessionid' => $mdl_attendance_sessions_id])
                        ->all();
                    return count($mdl_attendance_log);
                },
                'format' => 'raw',
            ],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{log}',
                'buttons'=>[
                    'log' => function ($url, $model) {
                        return Html::a('<span class="btn btn-lg btn-primary center-block">'.Icon::show('clipboard-list').'</span>',
                            Url::to(['eva_pregrado/mdlattendancelog/index', 'mdl_attendance_sessions_id'=>base64_encode($model->id)]),
                            ['title' => Yii::t('yii', 'Registros'),'target' => '_blank']);
                    },
                ]
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>

                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
                        'class' => 'btn btn-default',
                        'title' => ('Reset Grid')
                    ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => false,
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
