<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\eva_pregrado\MdlAttendanceLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'EVA Pregrado | Asistencia >> Sesiones >> Registros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mdl-attendance-log-index">

    <h1 align="center" class="alert alert-info">
        <?= Html::encode($this->title) ?>
    </h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sessionid',
            [
                'label' => 'Curso',
                'value' => function($model) {
                    $mdl_attendance_session_id = $model->sessionid;
                    $mdl_attendance_session = \app\models\eva_pregrado\MdlAttendanceSessions::findOne($mdl_attendance_session_id);
                    $mdl_attendance_id = $mdl_attendance_session->attendanceid;
                    $mdl_attendance = \app\models\eva_pregrado\MdlAttendance::findOne($mdl_attendance_id);
                    $mdl_course_id = $mdl_attendance->course;
                    $mdl_course = \app\models\eva_pregrado\MdlCourse::findOne($mdl_course_id);
                    return Html::a(
                            $mdl_course->fullname,
                            Yii::$app->params['moodle_course_url'] . $mdl_course->id,
                            ['target'=>'_blank', 'data-pjax'=>"0"])
                        .'<br><br><code>Inicio:</code><br>'.date("Y-m-d H:i:s", $mdl_attendance_session->sessdate)
                        .'<br><br><code>Fin:</code><br>'.date("Y-m-d H:i:s", $mdl_attendance_session->sessdate + $mdl_attendance_session->duration);
                },
                'headerOptions' => ['style' => 'width:20%'],
                'format' => 'raw',
                'group' => true,
            ],
            [
                'label' => 'Estudiante',
                'value' => function($model) {
                    $mdl_user_id = $model->studentid;
                    $mdl_user = \app\models\eva_pregrado\MdlUser::findOne($mdl_user_id);
                    return $mdl_user->lastname.' '.$mdl_user->firstname.' ('.$mdl_user->email.')';
                },
                'group' => true,
            ],
            [
                'label' => 'Estado',
                'value' => function($model) {
                    $statusid = $model->statusid;
                    $statusset = $model->statusset;
                    $statusset_array = @explode(',',$statusset);
                    if ($statusid == $statusset_array[0]) return 'Presente ('.$statusid.')';
                    if ($statusid == $statusset_array[1]) return 'Falta Injustificada ('.$statusid.')';
                    if ($statusid == $statusset_array[2]) return 'Retraso ('.$statusid.')';
                    if ($statusid == $statusset_array[3]) return 'Falta Justificada ('.$statusid.')';
                    return $statusid;
                },
            ],
            //'statusset',
            //'takenby',
            'remarks',
            'timetaken:datetime',
            'ipaddress',
            [
                'label' => 'id_plasig',
                'value' => function($model) {
                    //Obtener el código del curso en SIAD
                    $mdl_attendance_session_id = $model->sessionid;
                    $mdl_attendance_session = \app\models\eva_pregrado\MdlAttendanceSessions::findOne($mdl_attendance_session_id);
                    $mdl_attendance_id = $mdl_attendance_session->attendanceid;
                    $mdl_attendance = \app\models\eva_pregrado\MdlAttendance::findOne($mdl_attendance_id);
                    $mdl_course_id = $mdl_attendance->course;
                    $mdl_course = \app\models\eva_pregrado\MdlCourse::findOne($mdl_course_id);
                    $dpa_id = $mdl_course->idnumber;
                    $fecha = date("Y-m-d", $mdl_attendance_session->sessdate);
                    $hora_ini_planif = date("H:i:s", $mdl_attendance_session->sessdate);
                    $hora_fin_planif = date("H:i:s", $mdl_attendance_session->sessdate + $mdl_attendance_session->duration);
                    //Buscar si existe clase planificada en SIAD
                    $planasig = \app\models\siad_pregrado\PlanificacionAsignatura::find()
                        ->select('id_plasig')
                        ->where(['dpa_id' => $dpa_id])
                        ->andWhere(['fecha' => $fecha])
                        ->andWhere(['hora_ini_planif' => $hora_ini_planif])
                        ->andWhere(['hora_fin_planif' => $hora_fin_planif])
                        ->one();
                    if (isset($planasig)) {
                        return $planasig->id_plasig;
                    } else {
                        return '-';
                    }
                },
            ],
            [
                'label' => 'siad2eva',
                'value' => function($model) {
                    //Obtener código del estudiante en SIAD
                    $mdl_user_id = $model->studentid;
                    $mdl_user = \app\models\eva_pregrado\MdlUser::findOne($mdl_user_id);
                    $mdl_user_idnumber = $mdl_user->idnumber;
                    $estudiante = \app\models\siad_pregrado\Estudiantes::find()
                        ->select('CIInfPer')
                        ->where(['mailInst' => $mdl_user_idnumber])
                        ->one();
                    if (isset($estudiante)) {
                        $CIInfPer = $estudiante->CIInfPer;

                        //Obtener código del curso en SIAD
                        $mdl_attendance_session_id = $model->sessionid;
                        $mdl_attendance_session = \app\models\eva_pregrado\MdlAttendanceSessions::findOne($mdl_attendance_session_id);
                        $mdl_attendance_id = $mdl_attendance_session->attendanceid;
                        $mdl_attendance = \app\models\eva_pregrado\MdlAttendance::findOne($mdl_attendance_id);
                        $mdl_course_id = $mdl_attendance->course;
                        $mdl_course = \app\models\eva_pregrado\MdlCourse::findOne($mdl_course_id);
                        $dpa_id = $mdl_course->idnumber;

                        //Obtener codigo matrícula en el curso en SIAD
                        $naa = \app\models\siad_pregrado\NotasAlumno::find()
                            ->select('idnaa')
                            ->where(['CIInfPer' => $CIInfPer])
                            ->andWhere(['dpa_id' => $dpa_id])
                            ->one();

                        if (isset($naa)) {
                            $idnaa = $naa->idnaa;
                            $sessdate = $mdl_attendance_session->sessdate;
                            $duration = $mdl_attendance_session->duration;

                            //Buscar si existe clase planificada en SIAD
                            $fecha = date("Y-m-d", $sessdate);
                            $hora_ini_planif = date("H:i:s", $sessdate);
                            $hora_fin_planif = date("H:i:s", $sessdate + $duration);

                            $planasig = \app\models\siad_pregrado\PlanificacionAsignatura::find()
                                ->select('id_plasig')
                                ->where(['dpa_id' => $dpa_id])
                                ->andWhere(['fecha' => $fecha])
                                ->andWhere(['hora_ini_planif' => $hora_ini_planif])
                                ->andWhere(['hora_fin_planif' => $hora_fin_planif])
                                ->one();

                            if (isset($planasig)) {
                                $id_plasig = $planasig->id_plasig;

                                //Tipo de asistencia Moodle
                                $statusid = $model->statusid;
                                $statusset = $model->statusset;
                                $presente=$ausente=$atraso=$justificada=0;
                                $statusset_array = @explode(',',$statusset);
                                if ($statusid == $statusset_array[0]) $presente = 1;
                                if ($statusid == $statusset_array[1]) $ausente = 1;
                                if ($statusid == $statusset_array[2]) $atraso = 1;
                                if ($statusid == $statusset_array[3]) $justificada = 1;

                                //Revisar si se ha transferido o existe el registro de asistencia
                                $asistencia = \app\models\siad_pregrado\AsistenciaAlumno::find()
                                    ->where(['ciinfper' => $CIInfPer])
                                    ->andWhere(['idnaa' => $idnaa])
                                    ->andWhere(['id_plasig' => $id_plasig])
                                    ->andWhere(['presente' => $presente])
                                    ->andWhere(['ausente' => $ausente])
                                    ->andWhere(['atraso' => $atraso])
                                    ->andWhere(['justificada' => $justificada])
                                    ->one();
                                if (isset($asistencia)) {
                                    $id_asist = $asistencia->id_asist;
                                    return 'OK ('.$id_asist.')';
                                } else {
                                    return '(SIAD) No se ha registrado o transferido la asistencia';
                                }
                            }
                        } else {
                            return '(SIAD) No se ha encontrado matricula en el curso';
                        }
                    } else {
                        return '(SIAD) No existe estudiante';
                    }
                    return '-';
                },
                'format' => 'html'
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
