<?php

$siad_connection = Yii::$app->get('db_siad');
//SIAD - Estudiantes >> Asignaturas
$siad_command = $siad_connection->createCommand("
            SELECT
                    ipe.mailInst
            FROM
                    notasalumnoasignatura naa,
                    docenteperasig dpa,
                    informacionpersonal ipe
            WHERE
                    naa.idPer = ".Yii::$app->params['siad_periodo']."
                    AND dpa.dpa_id = naa.dpa_id
                    AND ipe.CIInfPer = naa.CIInfPer
                    AND ipe.mailInst LIKE '%@uea.edu.ec'
                    AND dpa.idCarr = 'COM'
            GROUP BY
                    naa.CIInfPer
                    ");
$siad_estudiantes_comunicacion = $siad_command->queryAll();
$i=0;
foreach ($siad_estudiantes_comunicacion as $estcom) {
    $i+=1;
    //print_r($i.'. '.$estcom['mailInst'].'<br>');
    print_r($estcom['mailInst'].'<br>');
}