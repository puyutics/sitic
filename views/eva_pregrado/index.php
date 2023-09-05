<?php

use yii\helpers\Html;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\eva_pregrado\MdlRoleAssignmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sincronizador: SIAD >> EVA Pregrado';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mdl-role-assignments-index">

    <h1 align="center" class="alert alert-primary"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <h4 align="center" class="alert alert-warning">
        Sincronizador diseñado para extraer, comparar y depurar información de las bases de datos del sistema académico SIAD y la plataforma EVA Pregrado, utilizando el método Flat File Enrolment (CSV) de Moodle
    </h4>
    <div class="row">
        <div align="center" class="col-lg-4">
            <h5 class="alert alert-info">
                <b>Características</b><br>
                <br>- Permite visualizar los códigos de aulas e identificar inconsistencias
                <br>- Permite sincronizar los códigos de aulas: dpa_id (SIAD) >> idnumber (Moodle)
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </h5>
            <?= Html::a('Ver Aulas', ['eva_pregrado/mdlroleassignments/mdlcourseview'], ['class' => 'btn btn-md btn-primary', 'target' => '_blank']) ?>
            <?= Html::a('Sincronizar Aulas', ['eva_pregrado/mdlroleassignments/mdlcoursesync'], ['class' => 'btn btn-md btn-danger', 'target' => '_blank']) ?>
        </div>
        <div align="center" class="col-lg-4">
            <h5 class="alert alert-info">
                <b>Características</b><br>
                <br>- Identifica aulas no creadas en Moodle
                <br>- Identifica usuarios no creados en Moodle
                <br>- Identifica matriculas duplicadas en Moodle
                <br>- Sincronización de docentes matriculados / eliminados
                <br>- Sincronización de estudiantes matriculados / eliminados
                <br>- Generación <code>siad_pregrado.txt</code> y transferencia a <code>/enrol</code> servidor Moodle
            </h5>
            <?= Html::a('Ver Logs', ['eva_pregrado/mdlroleassignments/logs'], ['class' => 'btn btn-md btn-primary', 'target' => '_blank']) ?>
            <?= Html::a('Sincronizar Matrículas', ['eva_pregrado/mdlroleassignments/mdlenrolsync'], ['class' => 'btn btn-md btn-danger', 'target' => '_blank']) ?>
        </div>
        <div align="center" class="col-lg-4">
            <h5 class="alert alert-info">
                <b>Características</b><br>
                <br>- Asistencia de Estudiantes
                <br>- Revisar sincronización con SIAD
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </h5>
            <?= Html::a('Ver Logs', ['eva_pregrado/mdlattendancelog/logs'], ['class' => 'btn btn-md btn-primary', 'target' => '_blank']) ?>
            <?= Html::a('Sincronizar Asistencia', ['eva_pregrado/mdlattendancelog/sync_web'], ['class' => 'btn btn-md btn-danger', 'target' => '_blank']) ?>
            <br><br>
            <?= Html::a('Ver Asistencia', ['eva_pregrado/mdlattendance/index'], ['class' => 'btn btn-md btn-primary', 'target' => '_blank']) ?>
        </div>
    </div>
    <hr>
    <h5 align="center" class="alert alert-default">
        <code>Parámetros de configuración: config/params.php</code><br>
        <br>- Período SIAD: <code><?= Yii::$app->params['siad_periodo']?></code>
        <br>- Código cursos: <code><?= Yii::$app->params['course_code']?></code>
        <br>- Moodle Host: <code><?= Yii::$app->params['moodle_host']?></code>
        <br>- Moodle SSH User: <code><?= Yii::$app->params['moodle_user']?></code>
        <br>- Moodle FTP User: <code><?= Yii::$app->params['moodle_ftpuser']?></code>
        <br>- Moodle Pass: <code><?= '****' ?></code>
    </h5>

</div>
