<?php

$tiempoInicial = microtimeFloat();

$mdl_courses = \app\models\MdlCourse::find()
    ->all();
?>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Total de cursos: <?= count($mdl_courses) ?></b>
</div>
<br>

    <table width=100% border="1" style="font-size: 9pt;border-collapse:collapse">
        <tr>
            <th bgcolor="#EEEEEE" style="text-align: center">#</th>
            <th bgcolor="#EEEEEE" style="text-align: center">ID Curso</th>
            <th bgcolor="#EEEEEE" style="text-align: center">Codigo Curso</th>
            <th bgcolor="#EEEEEE" style="text-align: center">Nombre Curso</th>
            <th bgcolor="#EEEEEE" style="text-align: center">idnumber</th>
            <th bgcolor="#EEEEEE" style="text-align: center">Codigo SIAD</th>
        </tr>
        <?php $i=0;
        foreach ($mdl_courses as $mdl_course) { ?>
            <?php $i = $i+1 ?>
            <?php $codigo = explode('-', $mdl_course->shortname);
            if ($codigo[0] == 2122 and isset($codigo[4])) {
                $docenteAsignatura = \app\models\DocenteAsignatura::find()
                    ->where(['idPer' => 37])
                    ->andWhere(['idAsig' => $codigo[1] . '-' . $codigo[2] . '-' . $codigo[3]])
                    ->andWhere(['idParalelo' => $codigo[4]])
                    ->one();
                if (isset($docenteAsignatura)) {
                    $dpa_id = $docenteAsignatura->dpa_id;
                    //Actualizar $mdl_course->idnumber
                    \Yii::$app->db_eva_pregrado->createCommand(
                        'UPDATE `mdl_course` SET `idnumber`=\''. $dpa_id .'\' 
                          WHERE `id` = \'' . $mdl_course->id . '\'')
                        ->execute();
                    $mdl_course->idnumber = $dpa_id;
                } else {
                    $dpa_id = '-';
                }
            } else {
                $dpa_id = '-';
            }

            ?>
            <tr>
                <th style="text-align: center"><?= $i ?></th>
                <th style="text-align: center"><?= $mdl_course->id ?></th>
                <th style="text-align: center"><?= $mdl_course->shortname ?></th>
                <th style="text-align: center"><?= $mdl_course->fullname ?></th>
                <th style="text-align: center"><?= $mdl_course->idnumber ?></th>
                <th style="text-align: center"><?= $dpa_id ?>
                </th>
            </tr>
        <?php } ?>
    </table>

<?php
$tiempoFinal = microtimeFloat();
$tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . 'segundos';
?>

<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Tiempo consulta: <?= $tiempoEjecucion ?></b>
</div>

<?php function microtimeFloat() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
} ?>


