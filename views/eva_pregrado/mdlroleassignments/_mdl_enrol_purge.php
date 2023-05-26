<?php
$tiempoInicial = microtimeFloat();
$solo_docentes = false;

$eva_connection = Yii::$app->get('db_eva_pregrado');
$eva_command = $eva_connection->createCommand("
    SELECT
            mdl_ra.id as mdl_ra_id,
            mdl_role.shortname as mdl_role_shortname,
            mdl_user.idnumber as mdl_user_idnumber,
            mdl_course.idnumber as mdl_course_idnumber
    FROM
            mdl_role_assignments mdl_ra,
            mdl_context,
            mdl_course,
            mdl_user,
            mdl_role
    WHERE
            mdl_context.id = mdl_ra.contextid
            AND	mdl_course.id = mdl_context.instanceid
            AND mdl_user.id = mdl_ra.userid
            AND mdl_role.id = mdl_ra.roleid
            AND mdl_course.idnumber <> ''
    ORDER BY
            mdl_ra.id ASC");
$eva_matriculas = $eva_command->queryAll();

//Verificar EVA Matriculas duplicadas
$eva_duplicados=0;
$eva_ra_command = $eva_connection->createCommand("
    SELECT
            COUNT(mdl_ra.id) as num,
            mdl_role.shortname as mdl_role_shortname,
            mdl_user.idnumber as mdl_user_idnumber,
            mdl_course.idnumber as mdl_course_idnumber
    FROM
            mdl_role_assignments mdl_ra,
            mdl_context,
            mdl_course,
            mdl_user,
            mdl_role
    WHERE
            mdl_context.id = mdl_ra.contextid
            AND	mdl_course.id = mdl_context.instanceid
            AND mdl_user.id = mdl_ra.userid
            AND mdl_role.id = mdl_ra.roleid
            AND mdl_course.idnumber <> ''
    GROUP BY
			mdl_ra.roleid,
			mdl_ra.contextid,
			mdl_ra.userid
	HAVING 
		    num > 1
");
$eva_ra_duplicates = $eva_ra_command->queryAll();
foreach ($eva_ra_duplicates as $eva_ra_duplicate) {
    $eva_duplicados=$eva_duplicados+1;
    $eva_ri_shortname = $eva_ra_duplicate['mdl_role_shortname'];
    $eva_mu_idnumber = $eva_ra_duplicate['mdl_user_idnumber'];
    $eva_mc_idnumber = $eva_ra_duplicate['mdl_course_idnumber'];
    echo 'Error 1: EVA Matrícula duplicada: ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . '<br>';
}

//BD SIAD Pregrado
$siad_connection = Yii::$app->get('db_siad');
$siad_docentes_command = $siad_connection->createCommand("
    SELECT
            dpa.dpa_id as siad_id,
            ipd.mailInst as mdl_user_idnumber,
            dpa.dpa_id as mdl_course_idnumber
    FROM
            docenteperasig dpa,
            informacionpersonal_d ipd
    WHERE
            dpa.idPer = ".Yii::$app->params['siad_periodo']."
            AND ipd.CIInfPer = dpa.CIInfPer
            AND ipd.mailInst LIKE '%@uea.edu.ec'
    ORDER BY
            siad_id ASC");
$siad_docentes_matriculas = $siad_docentes_command->queryAll();

$siad_estudiantes_command = $siad_connection->createCommand("
    SELECT
            naa.idnaa as siad_id,
            ipe.mailInst as mdl_user_idnumber,
            naa.dpa_id as mdl_course_idnumber
    FROM
            notasalumnoasignatura naa,
            informacionpersonal ipe,
            matricula m
    WHERE
            naa.idPer = ".Yii::$app->params['siad_periodo']."
            AND naa.dpa_id <> 0
            AND naa.anulada = 0
            AND naa.retirado = 0
            AND ipe.CIInfPer = naa.CIInfPer
            AND ipe.mailInst LIKE '%@uea.edu.ec'
            AND m.idMatricula = naa.idMatricula
            AND m.statusMatricula = 'APROBADA'
    ORDER BY
            siad_id ASC");
$siad_estudiantes_matriculas = $siad_estudiantes_command->queryAll();


$eva_courses_command = $eva_connection->createCommand("
    SELECT
            mdl_course.idnumber as mdl_course_idnumber
    FROM
            mdl_course
    WHERE
            mdl_course.idnumber <> ''
    ORDER BY
            mdl_course.idnumber ASC");
$eva_courses = $eva_courses_command->queryAll();

//Comparar matriculas docentes eva2siad (Delete)
$eva_docentes = 0;
$eva_estudiantes = 0;
$eva_coordinadores = 0;
$coordinacion_agi = 0;
$coordinacion_agp = 0;
$coordinacion_amb = 0;
$coordinacion_bio = 0;
$coordinacion_bio_lago = 0;
$coordinacion_bio_pangui = 0;
$coordinacion_com = 0;
$coordinacion_for = 0;
$coordinacion_tur = 0;
$coordinacion_tur_lago = 0;
$coordinacion_tur_pangui = 0;
$siad_docentes_ok = 0;
$siad_docentes_del = 0;
$siad_docentes_add = 0;
$siad_estudiantes_ok = 0;
$siad_estudiantes_del = 0;
$siad_estudiantes_add= 0;
$myfile = fopen("enrol/siad_pregrado.txt", "w") or die("Unable to open file!");
foreach ($eva_matriculas as $eva_matricula) {
    $eva_ri_shortname = $eva_matricula['mdl_role_shortname'];
    $eva_mu_idnumber = $eva_matricula['mdl_user_idnumber'];
    $eva_mc_idnumber = $eva_matricula['mdl_course_idnumber'];

    if (($eva_ri_shortname == 'editingteacher' or $eva_ri_shortname == 'teacher')) {
        if ($eva_mu_idnumber == 'agroindustrias@uea.edu.ec'
            or $eva_mu_idnumber == 'agropecuaria@uea.edu.ec'
            or $eva_mu_idnumber == 'ambiental@uea.edu.ec'
            or $eva_mu_idnumber == 'biologia@uea.edu.ec'
            or $eva_mu_idnumber == 'biologia.lago@uea.edu.ec'
            or $eva_mu_idnumber == 'biologia.pangui@uea.edu.ec'
            or $eva_mu_idnumber == 'comunicacion@uea.edu.ec'
            or $eva_mu_idnumber == 'forestal@uea.edu.ec'
            or $eva_mu_idnumber == 'turismo@uea.edu.ec'
            or $eva_mu_idnumber == 'turismo.lago@uea.edu.ec'
            or $eva_mu_idnumber == 'turismo.pangui@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.agroindustria@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.agropecuaria@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.ambiental@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.biologia@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.biologialago@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.biologiapangui@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.foresta@uea.edu.ecl'
            or $eva_mu_idnumber == 'cdt.turismo@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.turismolago@uea.edu.ec'
            or $eva_mu_idnumber == 'cdt.turismopangui@uea.edu.ec'
        ) {
            $eva_coordinadores = $eva_coordinadores +1;
            if ($eva_mu_idnumber == 'agroindustrias@uea.edu.ec') $coordinacion_agi = $coordinacion_agi + 1;
            if ($eva_mu_idnumber == 'agropecuaria@uea.edu.ec') $coordinacion_agp = $coordinacion_agp + 1;
            if ($eva_mu_idnumber == 'ambiental@uea.edu.ec') $coordinacion_amb = $coordinacion_amb + 1;
            if ($eva_mu_idnumber == 'biologia@uea.edu.ec') $coordinacion_bio = $coordinacion_bio + 1;
            if ($eva_mu_idnumber == 'biologia.lago@uea.edu.ec') $coordinacion_bio_lago = $coordinacion_bio_lago + 1;
            if ($eva_mu_idnumber == 'biologia.pangui@uea.edu.ec') $coordinacion_bio_pangui = $coordinacion_bio_pangui + 1;
            if ($eva_mu_idnumber == 'comunicacion@uea.edu.ec') $coordinacion_com = $coordinacion_com + 1;
            if ($eva_mu_idnumber == 'forestal@uea.edu.ec') $coordinacion_for = $coordinacion_for + 1;
            if ($eva_mu_idnumber == 'turismo@uea.edu.ec') $coordinacion_tur = $coordinacion_tur + 1;
            if ($eva_mu_idnumber == 'turismo.lago@uea.edu.ec') $coordinacion_tur_lago = $coordinacion_tur_lago + 1;
            if ($eva_mu_idnumber == 'turismo.pangui@uea.edu.ec') $coordinacion_tur_pangui = $coordinacion_tur_pangui + 1;
        } else {
            $eva_docentes = $eva_docentes + 1;
            $comprobar = 'del';
            foreach ($siad_docentes_matriculas as $siad_docentes_matricula) {
                $siad_mu_idnumber = $siad_docentes_matricula['mdl_user_idnumber'];
                $siad_mc_idnumber = $siad_docentes_matricula['mdl_course_idnumber'];
                if ($siad_mu_idnumber == $eva_mu_idnumber AND $siad_mc_idnumber == $eva_mc_idnumber) {
                    $siad_docentes_ok = $siad_docentes_ok + 1;
                    $comprobar = 'none';
                    break;
                }
            }
            if ($comprobar == 'del') {
                $siad_docentes_del = $siad_docentes_del + 1;
                echo $comprobar . ', ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . '<br>';
                fwrite($myfile, $comprobar . ', ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . PHP_EOL);
            }
        }
    }

    if (($eva_ri_shortname == 'student')) {
        $eva_estudiantes = $eva_estudiantes + 1;
        $comprobar = 'del';
        foreach ($siad_estudiantes_matriculas as $siad_estudiantes_matricula) {
            $siad_mu_idnumber = $siad_estudiantes_matricula['mdl_user_idnumber'];
            $siad_mc_idnumber = $siad_estudiantes_matricula['mdl_course_idnumber'];
            if ($siad_mu_idnumber == $eva_mu_idnumber AND $siad_mc_idnumber == $eva_mc_idnumber) {
                $siad_estudiantes_ok = $siad_estudiantes_ok + 1;
                $comprobar = 'none';
                break;
            }
        }
        if ($comprobar == 'del') {
            $siad_estudiantes_del = $siad_estudiantes_del + 1;
            echo $comprobar . ', ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . '<br>';
            fwrite($myfile, $comprobar . ', ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . PHP_EOL);
        }
    }
}
//Comparar matriculas docentes siad2eva (Add)
foreach ($siad_docentes_matriculas as $siad_docentes_matricula) {
    $siad_mu_idnumber = $siad_docentes_matricula['mdl_user_idnumber'];
    $siad_mc_idnumber = $siad_docentes_matricula['mdl_course_idnumber'];

    //Comprobar si el curso en Moodle existe
    foreach ($eva_courses as $eva_course) {
        $eva_course_idnumber = $eva_course['mdl_course_idnumber'];
        if ($eva_course_idnumber == $siad_mc_idnumber) {
            $comprobar = 'add';
            foreach ($eva_matriculas as $eva_matricula) {
                $eva_ri_shortname = $eva_matricula['mdl_role_shortname'];
                $eva_mu_idnumber = $eva_matricula['mdl_user_idnumber'];
                $eva_mc_idnumber = $eva_matricula['mdl_course_idnumber'];
                if (($eva_ri_shortname == 'editingteacher' or $eva_ri_shortname == 'teacher')) {
                    if ($eva_mu_idnumber == $siad_mu_idnumber AND $eva_mc_idnumber == $siad_mc_idnumber) {
                        $comprobar = 'none';
                        break;
                    }
                }
            }
            if ($comprobar == 'add') {
                $siad_docentes_add = $siad_docentes_add + 1;
                echo $comprobar . ', editingteacher, ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . '<br>';
                fwrite($myfile, $comprobar . ', editingteacher, ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
            }
            break;
        }
    }

}
//Comparar matriculas estudiantes siad2eva (Add)
if ($solo_docentes == false) {
    foreach ($siad_estudiantes_matriculas as $siad_estudiantes_matricula) {
        $siad_mu_idnumber = $siad_estudiantes_matricula['mdl_user_idnumber'];
        $siad_mc_idnumber = $siad_estudiantes_matricula['mdl_course_idnumber'];
        $comprobar = '0';

        //Comprobar si el curso en Moodle existe
        foreach ($eva_courses as $eva_course) {
            $eva_course_idnumber = $eva_course['mdl_course_idnumber'];
            if ($eva_course_idnumber == $siad_mc_idnumber) {
                $comprobar = 'add';
                foreach ($eva_matriculas as $eva_matricula) {
                    $eva_ri_shortname = $eva_matricula['mdl_role_shortname'];
                    $eva_mu_idnumber = $eva_matricula['mdl_user_idnumber'];
                    $eva_mc_idnumber = $eva_matricula['mdl_course_idnumber'];
                    if (($eva_ri_shortname == 'student')) {
                        if ($siad_mu_idnumber == $eva_mu_idnumber AND $siad_mc_idnumber == $eva_mc_idnumber) {
                            $comprobar = 'none';
                            break;
                        }
                    }
                }

                if ($comprobar == 'add') {
                    if ($siad_mc_idnumber != 0) {
                        $siad_estudiantes_add = $siad_estudiantes_add + 1;
                        echo $comprobar . ', student, ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . '<br>';
                        fwrite($myfile, $comprobar . ', student, ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
                    } else {
                        echo 'Error 2: Estudiante no matriculado: ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . '<br>';
                    }
                }
                break;
            }
        }
        if ($comprobar == '0') {
            echo 'Error 3: Estudiante no matriculado: ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . '<br>';
        }
    }
}

fclose($myfile);
copyFileRemoteServer();

$tiempoFinal = microtimeFloat();
$tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';
?>

    <br>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros SIAD: <?= (count($siad_estudiantes_matriculas) + count($siad_docentes_matriculas)) ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros EVA: <?= count($eva_matriculas) - $eva_coordinadores ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros EVA duplicados: <?= $eva_duplicados ?></b>
    </div>
    <br>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros SIAD Docentes: <?= count($siad_docentes_matriculas) ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros EVA Docentes: <?= $eva_docentes ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros correctos: <?= $siad_docentes_ok ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros por agregar: <?= $siad_docentes_add ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros por eliminar: <?= $siad_docentes_del ?></b>
    </div>
    <br>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros SIAD Estudiantes: <?= count($siad_estudiantes_matriculas) ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros EVA Estudiantes: <?= $eva_estudiantes ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros correctos: <?= $siad_estudiantes_ok ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros por agregar: <?= $siad_estudiantes_add ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros por eliminar: <?= $siad_estudiantes_del ?></b>
    </div>
    <br>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros EVA Coordinadores: <?= $eva_coordinadores ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Agroindustrias: <?= $coordinacion_agi ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Agropecuaria: <?= $coordinacion_agp ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Ambiental: <?= $coordinacion_amb ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Biologia: <?= $coordinacion_bio ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Biologia Lago: <?= $coordinacion_bio_lago ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Biologia Pangui: <?= $coordinacion_bio_pangui ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Comunicación: <?= $coordinacion_com ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Forestal: <?= $coordinacion_for ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Turismo: <?= $coordinacion_tur ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Turismo Lago: <?= $coordinacion_tur_lago ?></b>
    </div>
    <div style="font-size: 9pt; text-align: left;">
        <b>Total registros Coord. Turismo Pangui: <?= $coordinacion_tur_pangui ?></b>
    </div>
    <br>
    <div style="font-size: 9pt; text-align: left;">
        <b>Tiempo: </b><?= $tiempoEjecucion ?>
        <br>
        <b>Fecha y hora: </b><?= date('Y-m-d H:i:s') ?>
    </div>
    </div>

<?php function copyFileRemoteServer() {
    $srcFile = '/var/www/web_apps/sitic.uea.edu.ec/web/enrol/siad_pregrado.txt';
    $dstFile = '/var/www/web_apps/eva'.Yii::$app->params['course_code'].'.uea.edu.ec/enrol/siad_pregrado.txt';
    $bckFile = '/var/www/web_apps/sitic.uea.edu.ec/web/enrol/siad_pregrado_' . date('YmdHis') . '.txt';

    if (filesize($srcFile) > 0) {
        //Copiar el archivo mediante varios métodos de conexión
        try {
            //Conexión SSH
            $connection = ssh2_connect(Yii::$app->params['moodle_host'], 22);
            if (ssh2_auth_password($connection, Yii::$app->params['moodle_user'], Yii::$app->params['moodle_pass'])) {
                ssh2_scp_send($connection, $srcFile, $dstFile, 0644);
                ssh2_exec($connection, 'chown apache:apache ' . $dstFile);
                rename($srcFile, $bckFile);
                echo "<br>Conexión SSH - Se ha cargado el archivo $dstFile con éxito<br>";
            }
        } catch (Exception $e) {
            echo '<br>Conexión SSH - Excepción capturada: ',  $e->getMessage(), '<br>';
            try {
                //Conexión FTP
                $ftp_connect = ftp_connect(Yii::$app->params['moodle_host'],21);
                if (ftp_login($ftp_connect, Yii::$app->params['moodle_ftpuser'], Yii::$app->params['moodle_pass'])) {
                    ftp_pasv($ftp_connect, true);
                    $contents_on_server = ftp_nlist($ftp_connect, '/var/www/web_apps/eva'.Yii::$app->params['course_code'].'.uea.edu.ec/enrol/');
                    if (!in_array($dstFile, $contents_on_server)) {
                        if (ftp_put($ftp_connect, $dstFile, $srcFile, FTP_BINARY)){
                            ftp_chmod($ftp_connect, 0777, $dstFile);
                            rename($srcFile, $bckFile);
                            echo "<br>Conexión FTP - Se ha cargado el archivo $dstFile con éxito<br>";
                        }
                    } else {
                        echo "<br><code>Conexión FTP - El archivo $dstFile existe</code><br>";
                    }
                }
                ftp_close($ftp_connect);
            } catch (Exception $e) {
                echo '<br>Conexión FTP - Excepción capturada: ',  $e->getMessage(), '<br>';
            }
        }

    }
} ?>

<?php function microtimeFloat() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
} ?>