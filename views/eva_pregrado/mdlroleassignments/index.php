<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\eva_pregrado\MdlRoleAssignmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sincronizador: SIAD >> EVA Pregrado';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mdl-role-assignments-index">

    <h1 align="center" class="alert alert-primary"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <h4 align="center" class="alert alert-warning">
        Sincronizador diseñado para extraer, comparar y depurar información de las bases de datos del sistema académico SIAD y la plataforma EVA Pregrado, utilizando el método Flat File Enrolment (CSV) de Moodle
    </h4>
    <div class="row">
        <div align="center" class="col-lg-6">
            <h5 class="alert alert-info">
                <b>Características</b><br>
                <br>- Permite visualizar los códigos de aulas e identificar inconsistencias
                <br>- Permite sincronizar los códigos de aulas: dpa_id (SIAD) >> idnumber (Moodle)
                <br>
                <br>
                <br>
                <br>
                <br>
            </h5>
            <?= Html::a('Ver Aulas', ['mdlcourseview'], ['class' => 'btn btn-md btn-primary', 'target' => '_blank']) ?>
            <?= Html::a('Sincronizar Aulas', ['mdlcoursesync'], ['class' => 'btn btn-md btn-danger', 'target' => '_blank']) ?>
        </div>
        <div align="center" class="col-lg-6">
            <h5 class="alert alert-info">
                <b>Características</b><br>
                <br>- Identifica aulas no creadas en Moodle
                <br>- Identifica usuarios no creados en Moodle
                <br>- Identifica matriculas duplicadas en Moodle
                <br>- Sincronización de docentes matriculados / eliminados
                <br>- Sincronización de estudiantes matriculados / eliminados
                <br>- Generación <code>siad_pregrado.txt</code> y transferencia a <code>/enrol</code> servidor Moodle
            </h5>
            <?= Html::a('Sincronizar Matrículas', ['mdlenrolsync'], ['class' => 'btn btn-md btn-danger', 'target' => '_blank']) ?>
        </div>
    </div>
    <hr>
    <h5 align="center" class="alert alert-default">
        <code>Parámetros de configuración: config/params.php</code><br>
        <br>- Período SIAD: <code><?= Yii::$app->params['siad_periodo']?></code>
        <br>- Código cursos: <code><?= Yii::$app->params['course_code']?></code>
        <br>- Moodle Host: <code><?= Yii::$app->params['moodle_host']?></code>
        <br>- Moodle SSH User: <code><?= Yii::$app->params['moodle_user']?></code>
        <br>- Moodle FTP User: <code><?= Yii::$app->params['moodle_ftpuser']?></code>
        <br>- Moodle Pass: <code><?= '****' ?></code>
    </h5>
    <p align="center">
        <?php //echo Html::a('Todos', ['index'], ['class' => 'btn btn-success']) ?>
        <?php //echo Html::a('Profesores', ['index','role' => 'teacher'], ['class' => 'btn btn-success']) ?>
        <?php //echo Html::a('Estudiantes', ['index','role' => 'student'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php /*echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            [
                'label' => 'Codigo Curso',
                'attribute' => 'contextid',
                'value' => function ($model) {
                    $contextid = $model->contextid;
                    $mdl_context = \app\models\eva_pregrado\MdlContext::find()
                        ->where(['id' => $contextid])
                        ->one();

                    $mdl_course = \app\models\eva_pregrado\MdlCourse::find()
                        ->where(['id' => $mdl_context->instanceid])
                        ->one();

                    return $mdl_course->shortname;
                }
            ],
            [
                'label' => 'Nombre Curso',
                'attribute' => 'contextid',
                'value' => function ($model) {
                    $contextid = $model->contextid;
                    $mdl_context = \app\models\eva_pregrado\MdlContext::find()
                        ->where(['id' => $contextid])
                        ->one();

                    $mdl_course = \app\models\eva_pregrado\MdlCourse::find()
                        ->where(['id' => $mdl_context->instanceid])
                        ->one();

                    return $mdl_course->fullname;
                }
            ],
            [
                'label' => 'Email',
                'attribute' => 'userid',
                'value' => function ($model) {
                    $userid = $model->userid;
                    $mdl_user = \app\models\eva_pregrado\MdlUser::find()
                        ->where(['id' => $userid])
                        ->one();

                    return $mdl_user->username;
                },
            ],
            [
                'label' => 'Rol',
                'attribute' => 'roleid',
                'value' => function ($model) {
                    $roleid = $model->roleid;
                    $mdl_role = \app\models\eva_pregrado\MdlRole::find()
                        ->where(['id' => $roleid])
                        ->one();

                    return $mdl_role->shortname;
                }
            ],
            [
                'label' => 'SIAD',
                'attribute' => 'contextid',
                'value' => function ($model) {
                    $contextid = $model->contextid;
                    $mdl_context = \app\models\eva_pregrado\MdlContext::find()
                        ->where(['id' => $contextid])
                        ->one();

                    $mdl_course = \app\models\eva_pregrado\MdlCourse::find()
                        ->where(['id' => $mdl_context->instanceid])
                        ->one();

                    $codigo = explode('-', $mdl_course->shortname);

                    if ($codigo[0] == Yii::$app->params['course_code'] and isset($codigo[4])) {
                        $userid = $model->userid;
                        $mdl_user = \app\models\eva_pregrado\MdlUser::find()
                            ->where(['id' => $userid])
                            ->one();

                        $roleid = $model->roleid;
                        $mdl_role = \app\models\eva_pregrado\MdlRole::find()
                            ->where(['id' => $roleid])
                            ->one();

                        if ($mdl_role->shortname == 'student') {
                            $estudiante = \app\models\siad_pregrado\Estudiantes::find()
                            ->where(['mailInst' => $mdl_user->username])
                            ->one();

                            $docenteAsignatura = \app\models\siad_pregrado\DocenteAsignatura::find()
                                ->where(['idPer' => Yii::$app->params['siad_periodo']])
                                ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                                ->andWhere(['idParalelo' => $codigo[4]])
                                ->one();

                            $notasAlumno = \app\models\siad_pregrado\NotasAlumno::find()
                                ->where(['CIInfPer' => $estudiante->CIInfPer])
                                ->andWhere(['dpa_id' => $docenteAsignatura->dpa_id])
                                ->all();

                            if (count($notasAlumno) == 1) {
                                return 'OK';
                            } elseif (count($notasAlumno) == 0) {
                                return 'del, student, '.$estudiante->mailInst.', '.$docenteAsignatura->dpa_id;
                            }
                        } elseif ($mdl_role->shortname == 'teacher'
                                    or $mdl_role->shortname == 'editingteacher') {
                            $docenteAsignatura = \app\models\siad_pregrado\DocenteAsignatura::find()
                                ->where(['idPer' => Yii::$app->params['siad_periodo']])
                                ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                                ->andWhere(['idParalelo' => $codigo[4]])
                                ->one();

                            $docente = \app\models\siad_pregrado\Docentes::find()
                                ->where(['CIInfPer' => $docenteAsignatura->CIInfPer])
                                ->one();

                            if (isset($docente)) {
                                if ($docente->mailInst == $mdl_user->username) {
                                    return 'Correcto';
                                }
                            }
                            return 'del, ' . $mdl_role->shortname . ', ' . $mdl_user->idnumber.', '.$mdl_course->idnumber;
                        }
                    }
                    return '-';
                }
            ],


            //'timemodified:datetime',
            //'modifierid',
            //'component',
            //'itemid',
            //'sortorder',

            //['class' => 'kartik\grid\ActionColumn'],
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
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); */?>
</div>
