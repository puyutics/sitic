<?php

use app\models\eva_pregrado\MdlRoleAssignmentsSearch;
use app\models\eva_posgrado\MdlRoleAssignmentsPosgradoSearch;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model yii\web\View */

$dni = $model->dni;
$mail = $model->mail;

//Buscar usuario en EVA Pregrado
$mdl_user_pregrado = \app\models\eva_pregrado\MdlUser::find()
    ->where(['username' => $mail])
    ->one();

if (isset($mdl_user_pregrado)) {
    $mdl_user_pregrado_id = $mdl_user_pregrado->id;
} else {
    $mdl_user_pregrado_id = NULL;
}

$searchModelMdlRApregrado = new MdlRoleAssignmentsSearch();
$dataProviderMdlRApregrado = $searchModelMdlRApregrado->search(Yii::$app->request->queryParams);
$dataProviderMdlRApregrado->query->Where(['userid' => $mdl_user_pregrado_id]);
$dataProviderMdlRApregrado->sort->defaultOrder = [
    'roleid' => SORT_ASC,
    'contextid' => SORT_ASC,
];

//Buscar usuario en EVA Posgrado
$mdl_user_posgrado = \app\models\eva_posgrado\MdlUserPosgrado::find()
    ->where(['username' => $mail])
    ->one();

if (isset($mdl_user_posgrado)) {
    $mdl_user_posgrado_id = $mdl_user_posgrado->id;
} else {
    $mdl_user_posgrado_id = NULL;
}

$searchModelMdlRAposgrado = new MdlRoleAssignmentsPosgradoSearch();
$dataProviderMdlRAposgrado = $searchModelMdlRAposgrado->search(Yii::$app->request->queryParams);
$dataProviderMdlRAposgrado->query->Where(['userid' => $mdl_user_posgrado_id]);
$dataProviderMdlRAposgrado->sort->defaultOrder = [
    'contextid' => SORT_ASC,
];

?>

<?php if (isset($mdl_user_pregrado)) { ?>

    <div class="alert alert-info" align="center">
        <h3 align="center">EVA PREGRADO - Perfil de Usuario</h3>
    </div>

    <?= DetailView::widget([
        'model' => $mdl_user_pregrado,
        'attributes' => [
            'id',
            'auth',
            [
                'attribute' => 'username',
                'value' => function ($model) {
                    $mdl_user = \app\models\eva_pregrado\MdlUser::find()
                        ->select('id, username')
                        ->where(['username' => $model->username])
                        ->one();

                    return Html::a($mdl_user->username,Yii::$app->params['moodle_user_url'] . $mdl_user->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                },
                'format' => 'raw',
            ],
            'idnumber',
            //'firstname',
            //'lastname',
            //'email',
            //'firstaccess',
            //'lastaccess',
            //'lastlogin',
            //'currentlogin',
            //'lastip',
            //'picture',
            //'timecreated',
            //'timemodified',
        ],
    ]) ?>

<?php } ?>

<?php if($dataProviderMdlRApregrado->getTotalCount() > 0) { ?>

    <div class="estudiantes-pregrado-index">

        <div class="alert alert-info" align="center">
            <h3 align="center">EVA PREGRADO - Cursos</h3>
        </div>

        <?php echo GridView::widget([
            'dataProvider' => $dataProviderMdlRApregrado,
            //'filterModel' => $searchModelMdlRApregrado,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],

                //'id',
                [
                    'label' => 'ID Curso',
                    'attribute' => 'contextid',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_pregrado\MdlContext::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_pregrado\MdlCourse::find()
                            ->select('id')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        return Html::a($mdl_course->id,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'ID Number',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_pregrado\MdlContext::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_pregrado\MdlCourse::find()
                            ->select('id, idnumber')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        if ($mdl_course->idnumber != NULL) {
                            return Html::a($mdl_course->idnumber,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                        } else {
                            return '-';
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'Código Curso',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_pregrado\MdlContext::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_pregrado\MdlCourse::find()
                            ->select('id, shortname')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        return Html::a($mdl_course->shortname,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'Nombre Curso',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_pregrado\MdlContext::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_pregrado\MdlCourse::find()
                            ->select('id, fullname')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        return Html::a($mdl_course->fullname,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                    },
                    'format' => 'raw',
                ],
                /*[
                    'label' => 'Email',
                    'attribute' => 'userid',
                    'value' => function ($model) {
                        $userid = $model->userid;
                        $mdl_user = \app\models\eva_pregrado\MdlUser::find()
                            ->where(['id' => $userid])
                            ->one();

                        return $mdl_user->username;
                    },
                ],*/
                [
                    'label' => 'Rol',
                    'attribute' => 'roleid',
                    'value' => function ($model) {
                        $roleid = $model->roleid;
                        $mdl_role = \app\models\eva_pregrado\MdlRole::find()
                            ->select('shortname')
                            ->where(['id' => $roleid])
                            ->one();

                        return $mdl_role->shortname;
                    }
                ],
                [
                    'label' => 'Participantes',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_pregrado\MdlRoleAssignments::find()
                            ->select('id')
                            ->where(['contextid' => $contextid])
                            ->all();

                        return count($mdl_context);
                    },
                ],
                [
                    'label' => 'siad2eva',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_pregrado\MdlContext::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_pregrado\MdlCourse::find()
                            ->select('shortname, idnumber')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        $codigo = explode('-', $mdl_course->shortname);

                        if ($codigo[0] == Yii::$app->params['course_code'] and isset($codigo[4])) {
                            $userid = $model->userid;
                            $mdl_user = \app\models\eva_pregrado\MdlUser::find()
                                ->select('idnumber, username')
                                ->where(['id' => $userid])
                                ->one();

                            $roleid = $model->roleid;
                            $mdl_role = \app\models\eva_pregrado\MdlRole::find()
                                ->select('shortname')
                                ->where(['id' => $roleid])
                                ->one();

                            if ($mdl_role->shortname == 'student') {
                                $estudiante = \app\models\siad_pregrado\Estudiantes::find()
                                    ->select('CIInfPer, mailInst')
                                    ->where(['mailInst' => $mdl_user->username])
                                    ->one();

                                if (isset($codigo[5])) {
                                    $idAsig = $codigo[1].'-'.$codigo[2].'-'.$codigo[3].'-'.$codigo[4];
                                    $idParalelo = $codigo[5];
                                } else {
                                    $idAsig = $codigo[1].'-'.$codigo[2].'-'.$codigo[3];
                                    $idParalelo = $codigo[4];
                                }

                                $dpa = \app\models\siad_pregrado\DocenteAsignatura::find()
                                    ->select('dpa_id')
                                    ->where(['idPer' => Yii::$app->params['siad_periodo']])
                                    ->andWhere(['idAsig' => $idAsig])
                                    ->andWhere(['idParalelo' => $idParalelo])
                                    ->one();

                                if (isset($estudiante)) {
                                    $notasAlumno = \app\models\siad_pregrado\NotasAlumno::find()
                                        ->select('dpa_id')
                                        ->where(['CIInfPer' => $estudiante->CIInfPer])
                                        ->andWhere(['dpa_id' => $dpa->dpa_id])
                                        ->one();

                                    if (isset($notasAlumno)) {
                                        return "Correcto. ($notasAlumno->dpa_id)";
                                    } else {
                                        return 'del, student, '.$estudiante->mailInst.', '.$dpa->dpa_id;
                                    }
                                }
                            } elseif ($mdl_role->shortname == 'teacher'
                                or $mdl_role->shortname == 'editingteacher') {

                                if (isset($codigo[5])) {
                                    $idAsig = $codigo[1].'-'.$codigo[2].'-'.$codigo[3].'-'.$codigo[4];
                                    $idParalelo = $codigo[5];
                                } else {
                                    $idAsig = $codigo[1].'-'.$codigo[2].'-'.$codigo[3];
                                    $idParalelo = $codigo[4];
                                }

                                $dpa = \app\models\siad_pregrado\DocenteAsignatura::find()
                                    ->select('CIInfPer, dpa_id')
                                    ->where(['idPer' => Yii::$app->params['siad_periodo']])
                                    ->andWhere(['idAsig' => $idAsig])
                                    ->andWhere(['idParalelo' => $idParalelo])
                                    ->one();

                                if (isset($dpa)) {
                                    $docente = \app\models\siad_pregrado\Docentes::find()
                                        ->select('mailInst')
                                        ->where(['CIInfPer' => $dpa->CIInfPer])
                                        ->one();

                                    if (isset($docente)) {
                                        if ($docente->mailInst == $mdl_user->username) {
                                            return "Correcto. ($dpa->dpa_id)";
                                        }
                                    }
                                    return 'del, ' . $mdl_role->shortname . ', ' . $mdl_user->idnumber.', '.$mdl_course->idnumber;
                                }
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
        ]); ?>
    </div>
<?php } ?>


<?php if (isset($mdl_user_posgrado)) { ?>
    <hr>
    <div class="alert alert-success" align="center">
        <h3 align="center">EVA POSGRADO - Perfil de Usuario</h3>
    </div>

    <?= DetailView::widget([
        'model' => $mdl_user_posgrado,
        'attributes' => [
            'id',
            'auth',
            'username',
            'idnumber',
            //'firstname',
            //'lastname',
            //'email',
            //'firstaccess',
            //'lastaccess',
            //'lastlogin',
            //'currentlogin',
            //'lastip',
            //'picture',
            //'timecreated',
            //'timemodified',
        ],
    ]) ?>

<?php } ?>

<?php if($dataProviderMdlRAposgrado->getTotalCount() > 0) { ?>

    <div class="estudiantes-posgrado-index">

        <div class="alert alert-success" align="center">
            <h3 align="center">EVA POSGRADO - Cursos</h3>
        </div>

        <?php echo GridView::widget([
            'dataProvider' => $dataProviderMdlRAposgrado,
            //'filterModel' => $searchModelMdlRAposgrado,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],

                //'id',
                [
                    'label' => 'ID Curso',
                    'attribute' => 'contextid',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_posgrado\MdlContextPosgrado::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_posgrado\MdlCoursePosgrado::find()
                            ->select('id')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        if (isset($mdl_course)) {
                            return Html::a($mdl_course->id,Yii::$app->params['moodle_posgrado_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                        } else {
                            return '-';
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'ID Number',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_posgrado\MdlContextPosgrado::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_posgrado\MdlCoursePosgrado::find()
                            ->select('id, idnumber')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        if (isset($mdl_course) AND $mdl_course->idnumber != NULL) {
                            return Html::a($mdl_course->idnumber,Yii::$app->params['moodle_posgrado_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                        } else {
                            return '-';
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'Código Curso',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_posgrado\MdlContextPosgrado::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_posgrado\MdlCoursePosgrado::find()
                            ->select('id, shortname')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        if (isset($mdl_course)) {
                            return Html::a($mdl_course->shortname,Yii::$app->params['moodle_posgrado_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                        } else {
                            return '-';
                        }
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'Nombre Curso',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_posgrado\MdlContextPosgrado::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_posgrado\MdlCoursePosgrado::find()
                            ->select('id, fullname')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        if (isset($mdl_course)) {
                            return Html::a($mdl_course->fullname,Yii::$app->params['moodle_posgrado_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                        } else {
                            return '-';
                        }

                    },
                    'format' => 'raw',
                ],
                /*[
                    'label' => 'Email',
                    'attribute' => 'userid',
                    'value' => function ($model) {
                        $userid = $model->userid;
                        $mdl_user = \app\models\eva_pregrado\MdlUser::find()
                            ->where(['id' => $userid])
                            ->one();

                        return $mdl_user->username;
                    },
                ],*/
                [
                    'label' => 'Rol',
                    'attribute' => 'roleid',
                    'value' => function ($model) {
                        $roleid = $model->roleid;
                        $mdl_role = \app\models\eva_posgrado\MdlRolePosgrado::find()
                            ->select('shortname')
                            ->where(['id' => $roleid])
                            ->one();

                        return $mdl_role->shortname;
                    }
                ],
                [
                    'label' => 'Participantes',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_posgrado\MdlRoleAssignmentsPosgrado::find()
                            ->select('id')
                            ->where(['contextid' => $contextid])
                            ->all();

                        return count($mdl_context);
                    },
                ],
                [
                    'label' => 'siad2eva',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\eva_posgrado\MdlContextPosgrado::find()
                            ->select('instanceid')
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\eva_posgrado\MdlCoursePosgrado::find()
                            ->select('shortname, idnumber')
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        if (isset($mdl_course)) {
                            $codigo = explode('-', $mdl_course->shortname);
                            if ($codigo[0] == Yii::$app->params['course_code'] and isset($codigo[4])) {
                                $userid = $model->userid;
                                $mdl_user = \app\models\eva_posgrado\MdlUserPosgrado::find()
                                    ->select('idnumber, username')
                                    ->where(['id' => $userid])
                                    ->one();

                                $roleid = $model->roleid;
                                $mdl_role = \app\models\eva_posgrado\MdlRolePosgrado::find()
                                    ->select('shortname')
                                    ->where(['id' => $roleid])
                                    ->one();

                                if ($mdl_role->shortname == 'student') {
                                    $estudiante = \app\models\siad_posgrado\EstudiantesPosgrado::find()
                                        ->select('CIInfPer, mailInst')
                                        ->where(['mailInst' => $mdl_user->username])
                                        ->one();

                                    $docenteAsignatura = \app\models\siad_posgrado\DocenteAsignaturaPosgrado::find()
                                        ->select('dpa_id')
                                        ->where(['idPer' => Yii::$app->params['siad_periodo']])
                                        ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                                        ->andWhere(['idParalelo' => $codigo[4]])
                                        ->one();

                                    $notasAlumno = \app\models\siad_posgrado\NotasAlumnoPosgrado::find()
                                        ->select('dpa_id')
                                        ->where(['CIInfPer' => $estudiante->CIInfPer])
                                        ->andWhere(['dpa_id' => $docenteAsignatura->dpa_id])
                                        ->one();

                                    if (isset($notasAlumno)) {
                                        return "Correcto. ($notasAlumno->dpa_id)";
                                    } else {
                                        return 'del, student, '.$estudiante->mailInst.', '.$docenteAsignatura->dpa_id;
                                    }
                                } elseif ($mdl_role->shortname == 'teacher'
                                    or $mdl_role->shortname == 'editingteacher') {
                                    $docenteAsignatura = \app\models\siad_posgrado\DocenteAsignaturaPosgrado::find()
                                        ->select('CIInfPer, dpa_id')
                                        ->where(['idPer' => Yii::$app->params['siad_periodo']])
                                        ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                                        ->andWhere(['idParalelo' => $codigo[4]])
                                        ->one();

                                    $docente = \app\models\siad_posgrado\DocentesPosgrado::find()
                                        ->select('mailInst')
                                        ->where(['CIInfPer' => $docenteAsignatura->CIInfPer])
                                        ->one();

                                    if (isset($docente)) {
                                        if ($docente->mailInst == $mdl_user->username) {
                                            return "Correcto. ($docenteAsignatura->dpa_id)";
                                        }
                                    }
                                    return 'del, ' . $mdl_role->shortname . ', ' . $mdl_user->idnumber.', '.$mdl_course->idnumber;
                                }
                            } else {
                                return '-';
                            }
                        } else {
                            return '-';
                        }
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
        ]); ?>
    </div>

<?php } ?>


<?php if ((!isset($mdl_user_pregrado)) and (!isset($mdl_user_posgrado))) { ?>
    <div class="alert alert-info" align="center">
        <h3 align="center">No existe información</h3>
    </div>
<?php } ?>