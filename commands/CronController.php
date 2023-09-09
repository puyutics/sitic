<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CronController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionSiad2eva()
    {
        $message = $this->consolemdlenrolsync();
        echo $message . PHP_EOL;

        return ExitCode::OK;
    }

    private function consolemdlenrolsync()
    {
        if (Yii::$app->params['moodle_enrol_sync'] == true) {

            $tiempoInicial = $this->microtimeFloat();
            $solo_docentes = false;

            $file_console_output = fopen("/var/www/web_apps/sitic.uea.edu.ec/web/enrol/console_output.txt", "w") or die("Unable to open file!");
            $file_siad_pregrado = fopen("/var/www/web_apps/sitic.uea.edu.ec/web/enrol/console_siad_pregrado.txt", "w") or die("Unable to open file!");

            fwrite($file_console_output, 'Usuario: root' . PHP_EOL);
            fwrite($file_console_output, 'Fecha y hora: ' . date('Y-m-d H:i:s') . PHP_EOL . PHP_EOL);

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
                fwrite($file_console_output, 'Error 1: EVA Matrícula duplicada: ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . PHP_EOL);
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
                    naa.dpa_id as mdl_course_idnumber,
                    ipe.statusper as siad_statusper
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
            $eva_test = 0;
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
            $coordinacion_carreras_en_linea = 0;
            $siad_docentes_ok = 0;
            $siad_docentes_del = 0;
            $siad_docentes_add = 0;
            $siad_estudiantes_ok = 0;
            $siad_estudiantes_del = 0;
            $siad_estudiantes_add= 0;
            foreach ($eva_matriculas as $eva_matricula) {
                $eva_ri_shortname = $eva_matricula['mdl_role_shortname'];
                $eva_mu_idnumber = $eva_matricula['mdl_user_idnumber'];
                $eva_mc_idnumber = $eva_matricula['mdl_course_idnumber'];

                if ($eva_mu_idnumber != 'test@uea.edu.ec') {
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
                            or $eva_mu_idnumber == 'carrerasenlinea@uea.edu.ec'
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
                            if ($eva_mu_idnumber == 'carrerasenlinea@uea.edu.ec') $coordinacion_carreras_en_linea = $coordinacion_carreras_en_linea + 1;
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
                                fwrite($file_console_output, $comprobar . ', ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . PHP_EOL);
                                fwrite($file_siad_pregrado, $comprobar . ', ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . PHP_EOL);
                            }
                        }
                    }

                    if (($eva_ri_shortname == 'student')) {
                        $eva_estudiantes = $eva_estudiantes + 1;
                        $comprobar = 'del';
                        foreach ($siad_estudiantes_matriculas as $siad_estudiantes_matricula) {
                            $siad_mu_idnumber = $siad_estudiantes_matricula['mdl_user_idnumber'];
                            $siad_mc_idnumber = $siad_estudiantes_matricula['mdl_course_idnumber'];
                            $siad_statusper = $siad_estudiantes_matricula['siad_statusper'];
                            if ($siad_mu_idnumber == $eva_mu_idnumber AND $siad_mc_idnumber == $eva_mc_idnumber) {
                                if ($siad_statusper == 1) {
                                    $siad_estudiantes_ok = $siad_estudiantes_ok + 1;
                                    $comprobar = 'none';
                                } else {
                                    fwrite($file_console_output, 'Error 2: Cuenta Estudiante Inactiva: ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
                                }
                                break;
                            }
                        }
                        if ($comprobar == 'del') {
                            $siad_estudiantes_del = $siad_estudiantes_del + 1;
                            fwrite($file_console_output, $comprobar . ', ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . PHP_EOL);
                            fwrite($file_siad_pregrado, $comprobar . ', ' . $eva_ri_shortname . ', ' . $eva_mu_idnumber . ', ' . $eva_mc_idnumber . PHP_EOL);
                        }
                    }
                } else {
                    $eva_test = $eva_test + 1;
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
                            fwrite($file_console_output, $comprobar . ', editingteacher, ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
                            fwrite($file_siad_pregrado, $comprobar . ', editingteacher, ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
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
                                    if ($siad_statusper == 1) {
                                        $siad_estudiantes_add = $siad_estudiantes_add + 1;
                                        fwrite($file_console_output, $comprobar . ', student, ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
                                        fwrite($file_siad_pregrado, $comprobar . ', student, ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
                                    } else {
                                        fwrite($file_console_output, 'Error 3: Cuenta Estudiante Inactiva: ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
                                    }
                                } else {
                                    fwrite($file_console_output, 'Error 4: Estudiante no matriculado: ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
                                }
                            }
                            break;
                        }
                    }
                    if ($comprobar == '0') {
                        fwrite($file_console_output, 'Error 5: Estudiante no matriculado: ' . $siad_mu_idnumber . ', ' . $siad_mc_idnumber . PHP_EOL);
                    }
                }
            }

            fwrite($file_console_output, PHP_EOL);
            fwrite($file_console_output, 'Total registros SIAD: ' . (count($siad_estudiantes_matriculas) + count($siad_docentes_matriculas)) . PHP_EOL);
            fwrite($file_console_output, 'Total registros EVA: ' . (count($eva_matriculas) - $eva_coordinadores) . PHP_EOL);
            fwrite($file_console_output, 'Total registros EVA test: ' . $eva_test . PHP_EOL);
            fwrite($file_console_output, 'Total registros EVA duplicados: ' . $eva_duplicados . PHP_EOL);
            fwrite($file_console_output, PHP_EOL);
            fwrite($file_console_output, 'Total registros SIAD Docentes: ' . (count($siad_docentes_matriculas)) . PHP_EOL);
            fwrite($file_console_output, 'Total registros EVA Docentes: ' . $eva_docentes . PHP_EOL);
            fwrite($file_console_output, 'Total registros correctos: ' . $siad_docentes_ok . PHP_EOL);
            fwrite($file_console_output, 'Total registros correctos: ' . $siad_docentes_ok . PHP_EOL);
            fwrite($file_console_output, 'Total registros por agregar: ' . $siad_docentes_add . PHP_EOL);
            fwrite($file_console_output, 'Total registros por eliminar: ' . $siad_docentes_del . PHP_EOL);
            fwrite($file_console_output, PHP_EOL);
            fwrite($file_console_output, 'Total registros SIAD Estudiantes: ' . (count($siad_estudiantes_matriculas)) . PHP_EOL);
            fwrite($file_console_output, 'Total registros EVA Estudiantes: ' . $eva_estudiantes . PHP_EOL);
            fwrite($file_console_output, 'Total registros correctos: ' . $siad_estudiantes_ok . PHP_EOL);
            fwrite($file_console_output, 'Total registros por agregar: ' . $siad_estudiantes_add . PHP_EOL);
            fwrite($file_console_output, 'Total registros por eliminar: ' . $siad_estudiantes_del . PHP_EOL);
            fwrite($file_console_output, PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Agroindustrias: ' . $coordinacion_agi . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Agropecuaria: ' . $coordinacion_agp . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Ambiental: ' . $coordinacion_amb . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Biologia: ' . $coordinacion_bio . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Biologia Lago: ' . $coordinacion_bio_lago . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Biologia Pangui: ' . $coordinacion_bio_pangui . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Comunicacion: ' . $coordinacion_com . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Forestal: ' . $coordinacion_for . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Turismo: ' . $coordinacion_tur . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Turismo Lago: ' . $coordinacion_tur_lago . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Turismo Pangui: ' . $coordinacion_tur_pangui . PHP_EOL);
            fwrite($file_console_output, 'Total registros Coord. Carreras En Linea: ' . $coordinacion_carreras_en_linea . PHP_EOL);
            fwrite($file_console_output, PHP_EOL);

            $message = $this->copyFileRemoteServer();
            fwrite($file_console_output, $message . PHP_EOL);

            $tiempoFinal = $this->microtimeFloat();
            $tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';

            fwrite($file_console_output, 'Tiempo: ' . $tiempoEjecucion . PHP_EOL);
            fwrite($file_console_output, 'Fecha y hora: ' . date('Y-m-d H:i:s') . PHP_EOL);

            fclose($file_console_output);
            fclose($file_siad_pregrado);

            return 'Proceso finalizado. Tiempo: '.$tiempoEjecucion;
        }

    }

    private function copyFileRemoteServer() {
        $message = '';
        $srcFile = '/var/www/web_apps/sitic.uea.edu.ec/web/enrol/console_siad_pregrado.txt';
        $srcFileConsole = '/var/www/web_apps/sitic.uea.edu.ec/web/enrol/console_output.txt';
        $dstFile = '/var/www/web_apps/eva'.Yii::$app->params['course_code'].'.uea.edu.ec/enrol/siad_pregrado.txt';
        $bckFile = '/var/www/web_apps/sitic.uea.edu.ec/web/enrol/'.Yii::$app->params['course_code'].'/console_siad_pregrado/console_siad_pregrado_' . date('YmdHis') . '.txt';
        $bckFileConsole = '/var/www/web_apps/sitic.uea.edu.ec/web/enrol/'.Yii::$app->params['course_code'].'/console_output/console_output_' . date('YmdHis') . '.txt';

        if (filesize($srcFile) > 0) {
            //Copiar el archivo mediante varios métodos de conexión
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
                            $message = $message . PHP_EOL.'Conexion FTP - Se ha cargado el archivo '.$dstFile.' con exito'.PHP_EOL;
                        }
                    } else {
                        $message = $message . PHP_EOL.'Conexion FTP - El archivo '.$dstFile.' existe'.PHP_EOL;
                    }
                }
                ftp_close($ftp_connect);
            } catch (Exception $e) {
                $message = $message . PHP_EOL.'Conexion FTP - Excepcion capturada: '.$e->getMessage().PHP_EOL;
                try {
                    //Conexión SSH
                    $connection = ssh2_connect(Yii::$app->params['moodle_host'], 22);
                    if (ssh2_auth_password($connection, Yii::$app->params['moodle_user'], Yii::$app->params['moodle_pass'])) {
                        ssh2_scp_send($connection, $srcFile, $dstFile, 0644);
                        ssh2_exec($connection, 'chown apache:apache ' . $dstFile);
                        rename($srcFile, $bckFile);
                        $message = $message . PHP_EOL.'Conexion SSH - Se ha cargado el archivo '.$dstFile.' con exito'.PHP_EOL;
                    }
                } catch (Exception $e) {
                    $message = $message . PHP_EOL.'Conexion SSH - Excepcion capturada: '.$e->getMessage().PHP_EOL;
                }
            }

        }
        rename($srcFileConsole, $bckFileConsole);
        return $message;
    }










    public function actionSiad2eva_attendance()
    {
        $message = $this->consolemdlattendancesync();
        echo $message . PHP_EOL;

        return ExitCode::OK;
    }

    private function consolemdlattendancesync()
    {
        if (Yii::$app->params['moodle_attendance_sync'] == true) {
            $tiempoInicial = $this->microtimeFloat();

            $file_console_output = fopen('/var/www/web_apps/sitic.uea.edu.ec/web/attendance/'.Yii::$app->params['course_code'].'/console_output/console_output_'.date('YmdHis').'.txt', "w") or die("Unable to open file!");

            fwrite($file_console_output, 'Usuario: root' . PHP_EOL);
            fwrite($file_console_output, 'Fecha y hora: '.date('Y-m-d H:i:s').PHP_EOL.PHP_EOL);

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
                        #AND mdl_c.shortname LIKE '%UEA-L-UFB-026%'
                        ");
            $eva_attendance_logs = $eva_command->queryAll();

            fwrite($file_console_output, 'Asistencia Moodle: '.count($eva_attendance_logs).PHP_EOL);

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
                        #AND naa.idAsig LIKE 'UEA-L-UFB-026%'
                ORDER BY
                        #ipe.CIInfPer ASC,
                        dpa.idAsig ASC,
                        dpa.idParalelo ASC
                        ");
            $siad_estudiantes_asignaturas = $siad_command->queryAll();

            fwrite($file_console_output, 'Estudiantes - Asignaturas: '.count($siad_estudiantes_asignaturas).PHP_EOL);

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
                        #AND dpa.idAsig LIKE 'UEA-L-UFB-026%'
                        ");
            $siad_planificacion_asignatura = $siad_command->queryAll();

            fwrite($file_console_output, 'Planificación - Asignaturas: '.count($siad_planificacion_asignatura).PHP_EOL);

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
                        #AND dpa.idAsig LIKE 'UEA-L-UFB-026%'
                        ");
            $siad_alumnos_asistencias = $siad_command->queryAll();

            fwrite($file_console_output, 'Estudiantes - Asistencias: '.count($siad_alumnos_asistencias).PHP_EOL.PHP_EOL);

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

                fwrite($file_console_output, $i.'. '.$sea_CIInfPer.' >> '.$sea_mailInst.' >> dpa_id: '
                    .$sea_dpa_id.' >> idnaa: '.$sea_idnaa.' >> '.$sea_idAsig.' >> '
                    .$sea_idParalelo.' (Moodle Attendance Logs: '.count($sea_eals).')'.PHP_EOL);

                if (count($spas) > 0) {
                    foreach ($spas as $spa) {
                        $spa_id_plasig       = $spa['id_plasig'];
                        $spa_num_periodos    = $spa['num_periodos'];
                        $spa_fecha           = $spa['fecha'];
                        $spa_hora_ini_planif = $spa['hora_ini_planif'];
                        $spa_hora_fin_planif = $spa['hora_fin_planif'];

                        //Validar asistencia en Moodle
                        $check_eal = false;
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
                                $check_eal = true;
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
                            if ($check_eal == true) {
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
                            if ($check_eal == true) {
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

                        fwrite($file_console_output, '-- id_plasig: '.$spa_id_plasig.' ('.$spa_num_periodos.') >> '
                            .$spa_fecha.' >> '.$spa_hora_ini_planif.' >> '.$spa_hora_fin_planif
                            .' >> Estado: '.$status.PHP_EOL);
                    }
                    //if ($i == 1) break;
                } else {
                    fwrite($file_console_output, '-- (SIAD) Error. No existen clases planificadas'.PHP_EOL);
                }
            }
            fwrite($file_console_output, PHP_EOL);

            $tiempoFinal = $this->microtimeFloat();
            $tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';

            fwrite($file_console_output, PHP_EOL.'Tiempo: ' . $tiempoEjecucion);
            fwrite($file_console_output, PHP_EOL.'Fecha y hora: ' . date('Y-m-d H:i:s'));
            fclose($file_console_output);

            return 'Proceso finalizado. Tiempo: '.$tiempoEjecucion;
        }
    }





    private function microtimeFloat() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

}
