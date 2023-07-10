<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\eva_pregrado\MdlAttendanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'EVA Pregrado | Asistencia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdl-attendance-index">
    <h1 align="center" class="alert alert-info">
        <?= Html::encode($this->title) ?>
    </h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'label' => 'ID',
                'attribute' => 'course',
                'value' => function($model) {
                    $mdl_course_id = $model->course;
                    $mdl_course = \app\models\eva_pregrado\MdlCourse::findOne($mdl_course_id);
                    return Html::a($mdl_course->id,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                },
                'format' => 'raw',
                'group' => true,
            ],
            [
                'label' => 'ID Number',
                'value' => function($model) {
                    $mdl_course_id = $model->course;
                    $mdl_course = \app\models\eva_pregrado\MdlCourse::findOne($mdl_course_id);
                    if ($mdl_course->idnumber != NULL) {
                        return Html::a($mdl_course->idnumber,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                    } else {
                        return '-';
                    }
                },
                'format' => 'raw',
                'group' => true,
            ],
            [
                'label' => 'Código',
                'value' => function($model) {
                    $mdl_course_id = $model->course;
                    $mdl_course = \app\models\eva_pregrado\MdlCourse::findOne($mdl_course_id);
                    return Html::a($mdl_course->shortname,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                },
                'format' => 'raw',
                'group' => true,
            ],
            [
                'label' => 'Curso',
                'value' => function($model) {
                    $mdl_course_id = $model->course;
                    $mdl_course = \app\models\eva_pregrado\MdlCourse::findOne($mdl_course_id);
                    return Html::a($mdl_course->fullname,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                },
                'format' => 'raw',
                'group' => true,
            ],
            'name',
            //'grade',
            'timemodified:datetime',
            //'intro:ntext',
            //'introformat',
            //'subnet',
            //'sessiondetailspos',
            //'showsessiondetails',
            //'showextrauserdetails',
            [
                'label' => 'Sesiones',
                'value' => function($model) {
                    $mdl_attendance_id = $model->id;
                    $mdl_attendance_sessions = \app\models\eva_pregrado\MdlAttendanceSessions::find()
                        ->where(['attendanceid' => $mdl_attendance_id])
                        ->all();
                    return count($mdl_attendance_sessions);
                },
                'format' => 'raw',
            ],

            //['class' => 'kartik\grid\ActionColumn'],

            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{sessions}',
                'buttons'=>[
                    'sessions' => function ($url, $model) {
                        return Html::a('<span class="btn btn-lg btn-primary center-block">'.Icon::show('clipboard-list').'</span>',
                            Url::to(['eva_pregrado/mdlattendancesessions/index', 'mdl_attendance_id'=>base64_encode($model->id)]),
                            ['title' => Yii::t('yii', 'Sesiones'),'target' => '_blank']);
                    },
                ]
            ],
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
