<?php
$username = Yii::$app->user->identity->username;
$tiempoInicial = microtimeFloat();

$file_web_output = fopen("attendance/".Yii::$app->params['course_code']."/web_output/web_output_".date('YmdHis').".txt", "w") or die("Unable to open file!");

fwrite($file_web_output, 'Usuario: '.$username.PHP_EOL);
fwrite($file_web_output, 'Fecha y hora: '.date('Y-m-d H:i:s').PHP_EOL.PHP_EOL);

//DB Connections
$eva_connection = Yii::$app->get('db_eva_pregrado');
$siad_connection = Yii::$app->get('db_siad');

//Moodle - Logs de Asistencia
$eva_command = $eva_connection->createCommand("
    SELECT
            mdl_u.idnumber as mdl_user_idnumber,
            mdl_c.idnumber as mdl_course_idnumber,
            mdl_c.shortname,
            mdl_at.name,
            mdl_ats.sessdate,
            mdl_ats.duration,
            mdl_atl.id as mdl_atl_id,
            mdl_atl.statusid,
            mdl_atl.statusset,
            mdl_atl.timetaken,
            mdl_atl.takenby,
            mdl_atl.remarks,
            mdl_atl.ipaddress
    FROM
            mdl_attendance mdl_at,
            mdl_attendance_sessions mdl_ats,
            mdl_attendance_log mdl_atl,
            mdl_user mdl_u,
            mdl_course mdl_c
    WHERE
            mdl_u.id = mdl_atl.studentid
            AND mdl_c.id = mdl_at.course
            AND	mdl_ats.id = mdl_atl.sessionid
            AND mdl_at.id = mdl_ats.attendanceid
            AND mdl_c.shortname LIKE '%UEA-L-%'
            #AND mdl_c.shortname LIKE '%UEA-L-UFB-005%'
            ");
$eva_attendance_logs = $eva_command->queryAll();

fwrite($file_web_output, 'Asistencia Moodle: '.count($eva_attendance_logs).PHP_EOL);
print_r('Asistencia Moodle: '.count($eva_attendance_logs).'<br>');

//SIAD - Estudiantes >> Asignaturas
$siad_command = $siad_connection->createCommand("
    SELECT
            ipe.CIInfPer,
            ipe.mailInst,
            naa.idnaa,
            dpa.dpa_id,
            dpa.idAsig,
            dpa.idParalelo,
            dpa.idPer
    FROM
            notasalumnoasignatura naa,
            docenteperasig dpa,
            informacionpersonal ipe
    WHERE
            naa.idPer = ".Yii::$app->params['siad_periodo']."
            AND dpa.dpa_id = naa.dpa_id
            AND ipe.CIInfPer = naa.CIInfPer
            AND ipe.mailInst LIKE '%@uea.edu.ec'
            AND naa.idAsig LIKE 'UEA-L-%'
            #AND naa.idAsig LIKE 'UEA-L-UFB-005%'
    ORDER BY
            #ipe.CIInfPer ASC,
            dpa.idAsig ASC,
            dpa.idParalelo ASC
            ");
$siad_estudiantes_asignaturas = $siad_command->queryAll();

fwrite($file_web_output, 'Estudiantes - Asignaturas: '.count($siad_estudiantes_asignaturas).PHP_EOL);
print_r('Estudiantes - Asignaturas: '.count($siad_estudiantes_asignaturas).'<br>');

//SIAD - Planificación >> Asignaturas
$siad_command = $siad_connection->createCommand("
    SELECT
            pa.id_plasig,
            pa.num_periodos,
            pa.dpa_id,
            pa.fecha,
            pa.hora_ini_planif,
            pa.hora_fin_planif
    FROM
            planificacion_asignatura pa,
            docenteperasig dpa
    WHERE
            pa.dpa_id = dpa.dpa_id
            AND dpa.idPer = ".Yii::$app->params['siad_periodo']."
            AND dpa.idAsig LIKE 'UEA-L-%'
            #AND dpa.idAsig LIKE 'UEA-L-UFB-005%'
            ");
$siad_planificacion_asignatura = $siad_command->queryAll();

fwrite($file_web_output, 'Planificación - Asignaturas: '.count($siad_planificacion_asignatura).PHP_EOL);
print_r('Planificación - Asignaturas: '.count($siad_planificacion_asignatura).'<br>');

//SIAD - Estudiantes >> Asistencias
$siad_command = $siad_connection->createCommand("
    SELECT
            aa.id_asist,
            aa.idnaa,
            aa.observacion_asal,
            aa.id_plasig,
            aa.idPer,
            aa.ciinfper,
            aa.fecha_asal,
            aa.hora_asal,
            aa.presente,
            aa.ausente,
            aa.atraso,
            aa.justificada
    FROM
            asistencia_alumno aa,
            notasalumnoasignatura naa,
            docenteperasig dpa
    WHERE
            aa.idPer = ".Yii::$app->params['siad_periodo']."
            AND naa.idnaa = aa.idnaa
            AND dpa.dpa_id = naa.dpa_id
            AND dpa.idAsig LIKE 'UEA-L-%'
            #AND dpa.idAsig LIKE 'UEA-L-UFB-005%'
            ");
$siad_alumnos_asistencias = $siad_command->queryAll();

fwrite($file_web_output, 'Estudiantes - Asistencias: '.count($siad_alumnos_asistencias).PHP_EOL.PHP_EOL);
print_r('Estudiantes - Asistencias: '.count($siad_alumnos_asistencias).'<br>');
print_r('<hr>');

$i=0;
foreach ($siad_estudiantes_asignaturas as $sea) {
    $i+=1;
    $sea_CIInfPer   = $sea['CIInfPer'];
    $sea_mailInst   = $sea['mailInst'];
    $sea_idnaa      = $sea['idnaa'];
    $sea_dpa_id     = $sea['dpa_id'];
    $sea_idAsig     = $sea['idAsig'];
    $sea_idParalelo = $sea['idParalelo'];
    $sea_idPer      = $sea['idPer'];

    $sea_eals = array_filter($eva_attendance_logs, function ($var) use ($sea_mailInst, $sea_dpa_id) {
        return ($var['mdl_user_idnumber'] == $sea_mailInst
            AND $var['mdl_course_idnumber'] == $sea_dpa_id
        );
    });

    $spas = array_filter($siad_planificacion_asignatura, function ($var) use ($sea_dpa_id) {
        $fecha_actual = date('Y-m-d');
        return ($var['dpa_id'] == $sea_dpa_id
            AND $var['fecha'] <= $fecha_actual
        );
    });

    fwrite($file_web_output, $i.'. '.$sea_CIInfPer.' >> '.$sea_mailInst.' >> dpa_id: '
        .$sea_dpa_id.' >> idnaa: '.$sea_idnaa.' >> '.$sea_idAsig.' >> '
        .$sea_idParalelo.' (Moodle Attendance Logs: '.count($sea_eals).')'.PHP_EOL);
    print_r($i.'. '.$sea_CIInfPer.' >> '.$sea_mailInst.' >> dpa_id: '
        .$sea_dpa_id.' >> idnaa: '.$sea_idnaa.' >> '.$sea_idAsig.' >> '
        .$sea_idParalelo.' (Moodle Attendance Logs: '.count($sea_eals).')'.'<br>');

    if (count($spas) > 0) {
        foreach ($spas as $spa) {
            $spa_id_plasig       = $spa['id_plasig'];
            $spa_num_periodos    = $spa['num_periodos'];
            $spa_fecha           = $spa['fecha'];
            $spa_hora_ini_planif = $spa['hora_ini_planif'];
            $spa_hora_fin_planif = $spa['hora_fin_planif'];

            //Validar asistencia en Moodle
            $check_eal = 0;
            foreach ($sea_eals as $sea_eal) {
                $eal_mu_idnumber = $sea_eal['mdl_user_idnumber'];
                $eal_mc_idnumber = $sea_eal['mdl_course_idnumber'];
                $eal_name        = $sea_eal['name'];
                $eal_mdl_atl_id  = $sea_eal['mdl_atl_id'];
                $eal_sessdate    = $sea_eal['sessdate'];
                $eal_duration    = $sea_eal['duration'];
                $eal_statusid    = $sea_eal['statusid'];
                $eal_statusset   = $sea_eal['statusset'];
                $eal_timetaken   = $sea_eal['timetaken'];
                $eal_takenby     = $sea_eal['takenby'];
                $eal_remarks     = $sea_eal['remarks'];
                $eal_ipaddress   = $sea_eal['ipaddress'];

                //Fecha : Hora Moodle
                $eal_fecha = date("Y-m-d", $eal_sessdate);
                $eal_hora_ini_planif = date("H:i:s", $eal_sessdate);

                if ($eal_fecha == $spa_fecha AND $eal_hora_ini_planif == $spa_hora_ini_planif) {
                    $check_eal = 1;
                    break;
                }
            }

            //Validar asistencia en SIAD
            $saas = array_filter($siad_alumnos_asistencias, function ($var) use ($sea_CIInfPer, $sea_idnaa, $spa_id_plasig) {
                return ($var['ciinfper'] == $sea_CIInfPer
                    AND $var['idnaa'] == $sea_idnaa
                    AND $var['id_plasig'] == $spa_id_plasig
                );
            });

            $status='';
            $saa_id_asist=$saa_observacion_asal=$saa_fecha_asal=$saa_hora_asal=0;
            $saa_presente=$saa_ausente=$saa_atraso=$saa_justificada=0;
            if (count($saas) > 0) {
                foreach ($saas as $saa) {
                    $saa_id_asist = $saa['id_asist'];
                    $saa_observacion_asal = $saa['observacion_asal'];
                    $saa_fecha_asal = $saa['fecha_asal'];
                    $saa_hora_asal = $saa['hora_asal'];
                    $saa_presente = $saa['presente'];
                    $saa_atraso = $saa['atraso'];
                    $saa_justificada = $saa['justificada'];
                    $saa_ausente = $saa['ausente'];
                    break;
                }

                if ($check_eal == 1) {
                    $presente=$atraso=$justificada=0;$ausente=0;
                    //Tipo de asistencia Moodle
                    $statusset_array = @explode(',',$eal_statusset);
                    if ($eal_statusid == $statusset_array[0]) $presente = 1;
                    if ($eal_statusid == $statusset_array[1]) $atraso = 1;
                    if ($eal_statusid == $statusset_array[2]) $justificada = 1;
                    if ($eal_statusid == $statusset_array[3]) $ausente = 1;

                    //Verificar si el estado de la asistencia es correcto
                    if (($presente == 1 AND $saa_presente == 1)
                        OR ($atraso == 1 AND $saa_atraso == 1)
                        OR ($justificada == 1 AND $saa_justificada == 1)
                        OR ($ausente == 1 AND $saa_ausente == 1)
                    ) {
                        $status = $eal_mdl_atl_id.' (SIAD) OK. Se encuentra previamente registrada o transferida la asistencia.';
                    } else {
                        //Actualizar el Estado del Registro en la BD - SIAD Pregrado
                        $asistencia_update = \app\models\siad_pregrado\AsistenciaAlumno::findOne($saa_id_asist);
                        $asistencia_update->observacion_asal = 'siad2eva - Transferencia automática';
                        $asistencia_update->presente = $presente;
                        $asistencia_update->atraso = $atraso;
                        $asistencia_update->justificada = $justificada;
                        $asistencia_update->ausente = $ausente;
                        $asistencia_update->fecha_modif = date('Y-m-d H:i:s');
                        if ($asistencia_update->save(false)) {
                            $status = $eal_mdl_atl_id.' (SIAD) OK (Update). Se ha actualizado el registro existente de manera correcta.';
                        }
                    }
                } else {
                    if ($saa_presente == 1) $status = '(SIAD) Registro existente (Presente). '.$saa_observacion_asal;
                    if ($saa_atraso == 1) $status = '(SIAD) Registro existente (Atraso). '.$saa_observacion_asal;
                    if ($saa_justificada == 1) $status = '(SIAD) Registro existente (Justificada). '.$saa_observacion_asal;
                    if ($saa_ausente == 1) $status = '(SIAD) Registro existente (Ausente). '.$saa_observacion_asal;
                }
            } else {
                if ($check_eal == 1) {
                    $presente=$atraso=$justificada=0;$ausente=0;
                    //Tipo de asistencia Moodle
                    $statusset_array = @explode(',',$eal_statusset);
                    if ($eal_statusid == $statusset_array[0]) $presente = 1;
                    if ($eal_statusid == $statusset_array[1]) $atraso = 1;
                    if ($eal_statusid == $statusset_array[2]) $justificada = 1;
                    if ($eal_statusid == $statusset_array[3]) $ausente = 1;
                    //Registrar asistencia en la BD - SIAD Pregrado
                    $asistencia_create = New \app\models\siad_pregrado\AsistenciaAlumno();
                    $asistencia_create->ciinfper = $sea_CIInfPer;
                    $asistencia_create->fecha_asal = $spa_fecha;
                    $asistencia_create->hora_asal = $spa_hora_ini_planif;
                    $asistencia_create->idPer = $sea_idPer;
                    $asistencia_create->idnaa = $sea_idnaa;
                    $asistencia_create->observacion_asal = 'siad2eva - Transferencia automática';
                    $asistencia_create->numsesion_asal = $spa_num_periodos;
                    $asistencia_create->presente = $presente;
                    $asistencia_create->ausente = $ausente;
                    $asistencia_create->atraso = $atraso;
                    $asistencia_create->justificada = $justificada;
                    $asistencia_create->fecha_creacion = date("Y-m-d H:i:s", $eal_timetaken);
                    $asistencia_create->fecha_modif = date("Y-m-d H:i:s");
                    $asistencia_create->id_plasig = $spa_id_plasig;

                    if ($asistencia_create->save(false)) {
                        $status = $eal_mdl_atl_id.'. (SIAD) Se ha transferido el registro correctamente.';
                    } else {
                        $status = '<code>(SIAD) Error. No se ha podido crear el registro</code>';
                    }
                } else {
                    $presente=$atraso=$justificada=0;$ausente=1;
                    //Registrar inasistencia en la BD - SIAD Pregrado
                    $asistencia_create = New \app\models\siad_pregrado\AsistenciaAlumno();
                    $asistencia_create->ciinfper = $sea_CIInfPer;
                    $asistencia_create->fecha_asal = $spa_fecha;
                    $asistencia_create->hora_asal = $spa_hora_ini_planif;
                    $asistencia_create->idPer = $sea_idPer;
                    $asistencia_create->idnaa = $sea_idnaa;
                    $asistencia_create->observacion_asal = 'siad2eva - Transferencia automática';
                    $asistencia_create->numsesion_asal = $spa_num_periodos;
                    $asistencia_create->presente = $presente;
                    $asistencia_create->ausente = $ausente;
                    $asistencia_create->atraso = $atraso;
                    $asistencia_create->justificada = $justificada;
                    $asistencia_create->fecha_creacion = date($spa_fecha.' '.$spa_hora_fin_planif);
                    $asistencia_create->fecha_modif = date("Y-m-d H:i:s");
                    $asistencia_create->id_plasig = $spa_id_plasig;

                    if ($asistencia_create->save(false)) {
                        $status = '(SIAD) Nueva ausencia creada correctamente';
                    } else {
                        $status = '<code>(SIAD) Error. No se ha podido crear el registro</code>';
                    }
                }
            }

            fwrite($file_web_output, '-- id_plasig: '.$spa_id_plasig.' ('.$spa_num_periodos.') >> '
                .$spa_fecha.' >> '.$spa_hora_ini_planif.' >> '.$spa_hora_fin_planif
                .' >> Estado: '.$status.PHP_EOL);
            print_r('-- id_plasig: '.$spa_id_plasig.' ('.$spa_num_periodos.') >> '
                .$spa_fecha.' >> '.$spa_hora_ini_planif.' >> '.$spa_hora_fin_planif
                .' >> Estado: '.$status .'<br>');
        }
        //if ($i == 2) break;
    } else {
        fwrite($file_web_output, '-- (SIAD) Error. No existen clases planificadas'.PHP_EOL);
        print_r('-- <code>(SIAD) Error. No existen clases planificadas</code><br>');
    }
}
fwrite($file_web_output, PHP_EOL);
print_r('<hr>');

$tiempoFinal = microtimeFloat();
$tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';

fwrite($file_web_output, PHP_EOL.'Tiempo: ' . $tiempoEjecucion);
fwrite($file_web_output, PHP_EOL.'Fecha y hora: ' . date('Y-m-d H:i:s'));

print_r('<br>'.'Tiempo: ' . $tiempoEjecucion);
print_r('<br>'.'Fecha y hora: ' . date('Y-m-d H:i:s'));

fclose($file_web_output);

?>

<?php function microtimeFloat() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
} ?>