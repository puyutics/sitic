<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\MdlRoleAssignmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'EVA Pregrado - Mdl Role Assignments';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mdl-role-assignments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Todos', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Profesores', ['index','role' => 'teacher'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Estudiantes', ['index','role' => 'student'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Depurar Cursos', ['mdlcoursepurge'], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
        <?= Html::a('Depurar Matrículas', ['mdlenrolpurge'], ['class' => 'btn btn-danger', 'target' => '_blank']) ?>
    </p>

    <?= GridView::widget([
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
                    $mdl_context = \app\models\MdlContext::find()
                        ->where(['id' => $contextid])
                        ->one();

                    $mdl_course = \app\models\MdlCourse::find()
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
                    $mdl_context = \app\models\MdlContext::find()
                        ->where(['id' => $contextid])
                        ->one();

                    $mdl_course = \app\models\MdlCourse::find()
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
                    $mdl_user = \app\models\MdlUser::find()
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
                    $mdl_role = \app\models\MdlRole::find()
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
                    $mdl_context = \app\models\MdlContext::find()
                        ->where(['id' => $contextid])
                        ->one();

                    $mdl_course = \app\models\MdlCourse::find()
                        ->where(['id' => $mdl_context->instanceid])
                        ->one();

                    $codigo = explode('-', $mdl_course->shortname);

                    if ($codigo[0] == 2122 and isset($codigo[4])) {
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
                                ->where(['idPer' => 37])
                                ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                                ->andWhere(['idParalelo' => $codigo[4]])
                                ->one();

                            $notasAlumno = \app\models\NotasAlumno::find()
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
                            $docenteAsignatura = \app\models\DocenteAsignatura::find()
                                ->where(['idPer' => 37])
                                ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                                ->andWhere(['idParalelo' => $codigo[4]])
                                ->one();

                            $docente = \app\models\Docentes::find()
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
    ]); ?>
</div>
