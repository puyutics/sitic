<?php

$mdlRoleAssignments = \app\models\MdlRoleAssignments::find()
    ->where(['roleid' => 5]) //student
    //->where(['roleid' => 3]) //editingteacher
    //->orWhere(['roleid' => 4]) //teacher
    //->limit(300)
    ->all();

?>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Total de matriculas analizadas: <?= count($mdlRoleAssignments) ?></b>
</div>
<br>

<?php
$i=0;
$myfile = fopen("siad_pregrado.txt", "w") or die("Unable to open file!");
foreach ($mdlRoleAssignments as $mdlRoleAssignment) {
    $contextid = $mdlRoleAssignment->contextid;
    $mdl_context = \app\models\MdlContext::find()
        ->where(['id' => $contextid])
        ->one();
    $mdl_course = \app\models\MdlCourse::find()
        ->where(['id' => $mdl_context->instanceid])
        ->one();
    $codigo = explode('-', $mdl_course->shortname);
    if ($codigo[0] == 2122 and isset($codigo[4])) {
        $userid = $mdlRoleAssignment->userid;
        $mdl_user = \app\models\MdlUser::find()
            ->where(['id' => $userid])
            ->one();
        $roleid = $mdlRoleAssignment->roleid;
        $mdl_role = \app\models\MdlRole::find()
            ->where(['id' => $roleid])
            ->one();

        if ($mdl_role->shortname == 'teacher'
            or $mdl_role->shortname == 'editingteacher') {
            $docenteAsignatura = \app\models\DocenteAsignatura::find()
                ->where(['idPer' => 37])
                ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                ->andWhere(['idParalelo' => $codigo[4]])
                ->one();
            $docente = \app\models\Docentes::find()
                ->where(['CIInfPer' => $docenteAsignatura->CIInfPer])
                ->one();
            if (!isset($docente)) {
                    $i=$i+1;
                    echo 'del, '
                        . $mdl_role->shortname . ', '
                        . $mdl_user->idnumber . ', '
                        . $mdl_course->idnumber . "<br>";

            } elseif ($docente->mailInst != $mdl_user->username) {
                $i=$i+1;
                echo 'del, '
                    . $mdl_role->shortname . ', '
                    . $mdl_user->idnumber . ', '
                    . $mdl_course->idnumber . "<br>";
                fwrite($myfile, 'del, '
                    . $mdl_role->shortname . ', '
                    . $mdl_user->idnumber . ', '
                    . $mdl_course->idnumber. PHP_EOL);
            }
        }
        if ($mdl_role->shortname == 'student') {
            $docenteAsignatura = \app\models\DocenteAsignatura::find()
                ->where(['idPer' => 37])
                ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                ->andWhere(['idParalelo' => $codigo[4]])
                ->one();

            $estudiante = \app\models\Estudiantes::find()
                ->where(['mailInst' => $mdl_user->username])
                ->one();

            if (isset($estudiante)) {
                $notasAlumno = \app\models\NotasAlumno::find()
                    ->where(['CIInfPer' => $estudiante->CIInfPer])
                    ->andWhere(['dpa_id' => $docenteAsignatura->dpa_id])
                    ->one();
                if (!isset($notasAlumno)) {
                    $i=$i+1;
                    echo 'del, '
                        . $mdl_role->shortname . ', '
                        . $mdl_user->idnumber . ', '
                        . $mdl_course->idnumber . "<br>";
                    fwrite($myfile, 'del, '
                        . $mdl_role->shortname . ', '
                        . $mdl_user->idnumber . ', '
                        . $mdl_course->idnumber. PHP_EOL);
                }
            }
        }
    }
}
fclose($myfile);
?>

<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Total de matricular a eliminar: <?= $i ?></b>
</div>
<br>





