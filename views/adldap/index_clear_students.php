<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;
Icon::map($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\eva_pregrado\MdlRoleAssignmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Depurar Cuentas: SIAD >> Active Directory';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="mdl-role-assignments-index">

    <h1 align="center" class="alert alert-primary"><?= Html::encode($this->title) ?></h1>
    <h4 align="center" class="alert alert-warning">
        Depurador de cuentas de <code>estudiantes</code> diseñado para identificar, comparar y depurar información de las bases de datos del sistema académico SIAD y la plataforma Microsoft Active Directory
    </h4>
    <div class="row">
        <div align="center" class="col-lg-12">
            <h5 class="alert alert-info">
                <b>Características</b><br>
                <br>- Identifica cuentas de estudiantes en Active Directory
                <br>- Identifica cuentas de estudiantes habilitados, inhabilitados, graduados, 3era matrícula y fallecidos (SIAD)
                <br>- Desactiva cuentas en que no se encuentren habilitadas en SIAD Pregrado (Active Directory)
                <br>- Cambia cuentas desactivadas al contenedor ARCHIVO (Active Directory)
                <br>- Elimina la pertenencia a grupos (Active Directory)
                <br>- Elimina Licencias Microsoft 365 (Grupos Active Directory)
            </h5>
            <?= Html::a('Depurar Cuentas', ['clearstudents'], ['class' => 'btn btn-md btn-danger', 'target' => '_blank']) ?>
        </div>
    </div>
    <hr>
</div>
