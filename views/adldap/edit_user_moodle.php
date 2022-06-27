<?php

use app\models\MdlRoleAssignmentsSearch;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model yii\web\View */

$dni = $model->dni;
$mail = $model->mail;

//Buscar usuario en Moodle
$mdl_user = \app\models\MdlUser::find()
    ->where(['username' => $mail])
    ->one();

if (isset($mdl_user)) {
    $mdl_user_id = $mdl_user->id;
} else {
    $mdl_user_id = NULL;
}

$searchModelMdlRA = new MdlRoleAssignmentsSearch();
$dataProviderMdlRA = $searchModelMdlRA->search(Yii::$app->request->queryParams);
$dataProviderMdlRA->query->Where(['userid' => $mdl_user_id]);

?>

<?php if($dataProviderMdlRA->getTotalCount() > 0) { ?>

    <div class="estudiantes-pregrado-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="alert alert-info" align="center">
            <h3 align="center">EVA PREGRADO - Cursos</h3>
        </div>

        <?php echo GridView::widget([
            'dataProvider' => $dataProviderMdlRA,
            //'filterModel' => $searchModelMdlRA,
            'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],

                //'id',
                [
                    'label' => 'ID Curso',
                    'attribute' => 'contextid',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\MdlContext::find()
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\MdlCourse::find()
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        return Html::a($mdl_course->id,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'ID Number',
                    'attribute' => 'contextid',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\MdlContext::find()
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\MdlCourse::find()
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
                    'attribute' => 'contextid',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\MdlContext::find()
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\MdlCourse::find()
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        return Html::a($mdl_course->shortname,Yii::$app->params['moodle_course_url'] . $mdl_course->id,['target'=>'_blank', 'data-pjax'=>"0"]);
                    },
                    'format' => 'raw',
                ],
                [
                    'label' => 'Nombre Curso',
                    'attribute' => 'contextid',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\MdlContext::find()
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\MdlCourse::find()
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
                        $mdl_user = \app\models\MdlUser::find()
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
                        $mdl_role = \app\models\MdlRole::find()
                            ->where(['id' => $roleid])
                            ->one();

                        return $mdl_role->shortname;
                    }
                ],
                [
                    'label' => 'Participantes',
                    'attribute' => 'contextid',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\MdlRoleAssignments::find()
                            ->where(['contextid' => $contextid])
                            ->all();

                        return count($mdl_context);
                    },
                ],
                [
                    'label' => 'siad2eva',
                    'value' => function ($model) {
                        $contextid = $model->contextid;
                        $mdl_context = \app\models\MdlContext::find()
                            ->where(['id' => $contextid])
                            ->one();

                        $mdl_course = \app\models\MdlCourse::find()
                            ->where(['id' => $mdl_context->instanceid])
                            ->one();

                        $codigo = explode('-', $mdl_course->shortname);

                        if ($codigo[0] == Yii::$app->params['course_code'] and isset($codigo[4])) {
                            $userid = $model->userid;
                            $mdl_user = \app\models\MdlUser::find()
                                ->where(['id' => $userid])
                                ->one();

                            $roleid = $model->roleid;
                            $mdl_role = \app\models\MdlRole::find()
                                ->where(['id' => $roleid])
                                ->one();

                            if ($mdl_role->shortname == 'student') {
                                $estudiante = \app\models\Estudiantes::find()
                                    ->where(['mailInst' => $mdl_user->username])
                                    ->one();

                                $docenteAsignatura = \app\models\DocenteAsignatura::find()
                                    ->where(['idPer' => Yii::$app->params['siad_periodo']])
                                    ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                                    ->andWhere(['idParalelo' => $codigo[4]])
                                    ->one();

                                $notasAlumno = \app\models\NotasAlumno::find()
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
                                $docenteAsignatura = \app\models\DocenteAsignatura::find()
                                    ->where(['idPer' => Yii::$app->params['siad_periodo']])
                                    ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                                    ->andWhere(['idParalelo' => $codigo[4]])
                                    ->one();

                                $docente = \app\models\Docentes::find()
                                    ->where(['CIInfPer' => $docenteAsignatura->CIInfPer])
                                    ->one();

                                if (isset($docente)) {
                                    if ($docente->mailInst == $mdl_user->username) {
                                        return "Correcto. ($docenteAsignatura->dpa_id)";
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
        ]); ?>
    </div>

<?php } else { ?>
    <div class="alert alert-info" align="center">
        <h3 align="center">No existe información</h3>
    </div>
<?php } ?>
