<?php
$username = Yii::$app->user->identity->username;
$tiempoInicial = microtimeFloat();
$solo_docentes = false;

$file_web_output = fopen("attendance/web_output.txt", "w") or die("Unable to open file!");

fwrite($file_web_output, 'Usuario: ' . $username . PHP_EOL);
fwrite($file_web_output, 'Fecha y hora: ' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL);

//DB Connections
$eva_connection = Yii::$app->get('db_eva_pregrado');
$siad_connection = Yii::$app->get('db_siad');

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
            #AND mdl_atl.sessionid = 4830
            #AND mdl_atl.sessionid = 1149
            AND mdl_c.shortname LIKE '2323-UEA-L-UFB-026-A'
            ");
$eva_attendance_logs = $eva_command->queryAll();

$i=0;
foreach ($eva_attendance_logs as $eva_attendance_log) {
    $i=$i+1;
    $mdl_user_idnumber = $eva_attendance_log['mdl_user_idnumber'];
    $mdl_course_idnumber = $eva_attendance_log['mdl_course_idnumber'];
    $name = $eva_attendance_log['name'];
    $mdl_atl_id = $eva_attendance_log['mdl_atl_id'];
    $sessdate = $eva_attendance_log['sessdate'];
    $duration = $eva_attendance_log['duration'];
    $statusid = $eva_attendance_log['statusid'];
    $statusset = $eva_attendance_log['statusset'];
    $timetaken = $eva_attendance_log['timetaken'];
    $takenby = $eva_attendance_log['takenby'];
    $remarks = $eva_attendance_log['remarks'];
    $ipaddress = $eva_attendance_log['ipaddress'];

    $siad_command = $siad_connection->createCommand("
    SELECT
            CIInfPer
    FROM
            informacionpersonal
    WHERE
            mailInst LIKE '".$mdl_user_idnumber."'
            ");
    $estudiante = $siad_command->queryOne();

    if (isset($estudiante['CIInfPer'])) {
        $CIInfPer = $estudiante['CIInfPer'];
        $dpa_id = $mdl_course_idnumber;

        //Obtener codigo matrícula en el curso en SIAD
        $siad_command = $siad_connection->createCommand("
            SELECT
                    idnaa
            FROM
                    notasalumnoasignatura
            WHERE
                    CIInfPer LIKE '".$CIInfPer."'
                    AND dpa_id = ".$dpa_id."
                    ");
        $naa = $siad_command->queryOne();

        if (isset($naa['idnaa'])) {
            $idnaa = $naa['idnaa'];

            //Buscar si existe clase planificada en SIAD
            $fecha = date("Y-m-d", $sessdate);
            $hora_ini_planif = date("H:i:s", $sessdate);
            $hora_fin_planif = date("H:i:s", $sessdate + $duration);

            $siad_command = $siad_connection->createCommand("
            SELECT
                    id_plasig
            FROM
                    planificacion_asignatura
            WHERE
                    dpa_id = ".$dpa_id."
                    AND fecha = '".$fecha."'
                    AND hora_ini_planif = '".$hora_ini_planif."'
                    AND hora_fin_planif = '".$hora_fin_planif."'
                    ");
            $planasig = $siad_command->queryOne();

            if (isset($planasig['id_plasig'])) {
                $id_plasig = $planasig['id_plasig'];

                //Tipo de asistencia Moodle
                $presente=$ausente=$atraso=$justificada=0;
                $statusset_array = @explode(',',$statusset);
                if ($statusid == $statusset_array[0]) $presente = 1;
                if ($statusid == $statusset_array[1]) $ausente = 1;
                if ($statusid == $statusset_array[2]) $atraso = 1;
                if ($statusid == $statusset_array[3]) $justificada = 1;

                //Verificar si se ha transferido o existe el registro de asistencia
                $siad_command = $siad_connection->createCommand("
                    SELECT
                            id_asist
                    FROM
                            asistencia_alumno
                    WHERE
                            ciinfper LIKE '".$CIInfPer."'
                            AND idnaa = ".$idnaa."
                            AND id_plasig = ".$id_plasig."
                            AND presente = ".$presente."
                            AND ausente = ".$ausente."
                            AND atraso = ".$atraso."
                            AND atraso = ".$atraso."
                            ");
                $asistencia = $siad_command->queryOne();

                if (isset($asistencia['id_asist'])) {
                    $id_asist = $asistencia['id_asist'];
                    print_r($i.'. '.$mdl_atl_id.' - (SIAD) OK. Se ha registrado o transferido la asistencia correctamente ('.$id_asist.')'.'<br>');
                    //print_r($i.'. '.$mdl_atl_id.' - (SIAD) OK. Se ha registrado o transferido la asistencia correctamente'.'<br>');
                } else {
                    print_r($i.'. '.$mdl_atl_id.' - (SIAD) No se ha registrado o transferido la asistencia'.'<br>');

                    //Registrar asistencia en la BD-SIAD Pregrado
                    //$model_asistencia = New \app\models\siad_pregrado\AsistenciaAlumno();




                }
            } else {
                print_r($i.'. '.$mdl_atl_id.' - (SIAD) No se ha encontrado una clase planificada'.'<br>');
            }
        } else {
            print_r($i.'. '.$mdl_atl_id.' - (SIAD) No se ha encontrado matrícula en el curso'.'<br>');
        }
    } else {
        print_r($i.'. '.$mdl_atl_id.' - (SIAD) No existe estudiante'.'<br>');
    }

}




$tiempoFinal = microtimeFloat();
$tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';

print_r('<br>'.'Tiempo: ' . $tiempoEjecucion);

fwrite($file_web_output, 'Tiempo: ' . $tiempoEjecucion . PHP_EOL);
fwrite($file_web_output, 'Fecha y hora: ' . date('Y-m-d H:i:s') . PHP_EOL);

fclose($file_web_output);

?>

<?php function microtimeFloat() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
} ?>