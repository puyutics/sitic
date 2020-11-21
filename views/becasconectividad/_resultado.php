<?php

use yii\helpers\Html;
use yii\helpers\Url;

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);

} else {
    $sAMAccountname = Yii::$app->user->identity->username;
    $user = Yii::$app->ad->getProvider('default')->search()
        ->findBy('sAMAccountname', $sAMAccountname);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);
}

$estudiante = \app\models\Estudiantes::find()
    ->where(["cedula_pasaporte" => $dni])
    ->all();

$contratos = \app\models\TabIntFormulario::find()
    ->andWhere(['cedula' => $dni])
    ->all();

$matricula = \app\models\Matricula::find()
    ->where(["CIInfPer" => $dni])
    ->andwhere(["idPer" => '35'])
    ->orderBy(["idsemestre" => SORT_DESC])
    ->all();

$festrat = \app\models\BecasFestrat::find()
    ->where(["cedula" => $dni])
    ->orderBy(["periodo" => SORT_DESC])
    ->all();

$cuentasbanc = \app\models\BecasCuentasBanc::find()
    ->where(["cedula" => $dni])
    ->all();

///////////////////// GENERACION DE INFORMACION ///////////////////

if (count($estudiante)>0) {
    $nombres = $estudiante[0]->NombInfPer;
    $apellidos = $estudiante[0]->ApellInfPer . ' ' . $estudiante[0]->ApellMatInfPer;
} else {
    $nombres = $user->getFirstName();
    $apellidos = $user->getLastName();
}

if (count($matricula)>0) {
    if ($matricula[0]->statusMatricula == 'APROBADA') {
        $matriculado = 'SI';
    }
    if ($matricula[0]->idCarr == 'AGI') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'AGROINDUSTRIA';
    } elseif ($matricula[0]->idCarr == 'AGR') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'AGROPECUARIA';
    } elseif ($matricula[0]->idCarr == 'AMB') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'INGENIERIA AMBIENTAL';
    } elseif ($matricula[0]->idCarr == 'BLG') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'BIOLOGIA';
    } elseif ($matricula[0]->idCarr == 'BLGEL') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'BIOLOGIA';
    } elseif ($matricula[0]->idCarr == 'BLGEP') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'BIOLOGIA';
    } elseif ($matricula[0]->idCarr == 'COM') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'COMUNICACIÓN SOCIAL';
    } elseif ($matricula[0]->idCarr == 'FRT') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'INGENIERIA FORESTAL';
    } elseif ($matricula[0]->idCarr == 'LTUR') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'LICENCIATURA TURISMO';
    } elseif ($matricula[0]->idCarr == 'LTUREL') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'LICENCIATURA TURISMO';
    } elseif ($matricula[0]->idCarr == 'LTUREP') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'LICENCIATURA TURISMO';
    } elseif ($matricula[0]->idCarr == 'TUR') {
        $carrera = $matricula[0]->idCarr;
        $nom_carrera = 'INGENIERIA EN TURISMO';
    }
    $semestre = $matricula[0]->idsemestre;
} else {
    $matriculado = 'NO';
    $carrera = '-';
    $nom_carrera = '-';
    $semestre = '-';
}

if (count($contratos)>0
) {
    $contrato = 'SI';
} else {
    $contrato = 'NO';
}

if (count($festrat)>0) {
    $estratificacion = $festrat[0]->Grupo;
} else {
    $estratificacion = '-';
}

///////////////// CUMPLIMIENTO REQUISITOS ///////////////////
if ($matriculado == 'SI') {
    $cumple_matriculado = 'SI';
} else {
    $cumple_matriculado = 'NO';
}
if ($carrera != '-') {
    $cumple_carrera = 'SI';
    if (($carrera == 'AGI'
            or $carrera == 'AGR'
            or $carrera == 'AMB'
            or $carrera == 'BLG'
            or $carrera == 'BLGEL'
            or $carrera == 'BLGEP'
            or $carrera == 'COM'
            or $carrera == 'FRT'
            or $carrera == 'TUR'
        ) and $semestre <= 10 ) {
        $cumple_semestre = 'SI';
    } elseif (($carrera == 'LTUR'
            or $carrera == 'LTUREL'
            or $carrera == 'LTUREP'
        ) and $semestre <= 9 ) {
        $cumple_semestre = 'SI';
    } else {
        $cumple_semestre = 'NO';
    }
} else {
    $cumple_carrera = 'NO';
    $cumple_semestre = 'NO';
}
if ($estratificacion == 'C+ (medio típico)'
    or $estratificacion == 'C- (medio bajo)'
    or $estratificacion == 'D (bajo)'
    //or $estratificacion == '-'
) {
    $cumple_estratificacion = 'SI';
} else {
    $cumple_estratificacion = 'NO';
}
if ($cumple_matriculado == 'SI'
    //and $cumple_carrera == 'SI'
    //and $cumple_semestre == 'SI'
    and $cumple_estratificacion == 'SI'
    and $contrato == 'SI'
) {
    $cumple_requisitos = 'SI';
} else {
    $cumple_requisitos = 'NO';
}

?>

<div style="font-size: 11pt; text-align: left;">
    <b>Datos Personales</b>
</div>
<table width=100% border="1" style="border-collapse:collapse">
    <tr>
        <th width=30% bgcolor="#EEEEEE" style="text-align: left">Cédula / Pasaporte</th>
        <th style="text-align: left"><?= $user->getAttribute(Yii::$app->params['dni'],0) ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Nombres</th>
        <th style="text-align: left"><?= $nombres ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Apellidos</th>
        <th style="text-align: left"><?= $apellidos ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Correo Institucional</th>
        <th style="text-align: left"><?= $user->getEmail() ?></th>
    </tr>
</table>
<br>
<div align="left" style="font-size: 11pt">
    <b>Cumplimiento de Requisitos</b>
</div>
<table align="center" width=100% border="1" style="border-collapse:collapse">
    <tr>
        <th width=25% bgcolor="#EEEEEE" style="text-align: left">Matriculado</th>
        <th style="text-align: center"><?= $matriculado ?></th>
        <th style="text-align: center"><?php
            if ($cumple_matriculado == 'SI') { echo Html::img('@web/images/done.png'); }
            else { echo Html::img('@web/images/deny.png'); } ?>
        </th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Carrera</th>
        <th style="text-align: center"><?= $nom_carrera ?></th>
        <th style="text-align: center"><?php
            if ($cumple_carrera == 'SI') { echo Html::img('@web/images/done.png'); }
            else { echo Html::img('@web/images/deny.png'); } ?>
        </th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Semestre</th>
        <th style="text-align: center"><?= $semestre ?></th>
        <th style="text-align: center"><?php
            if ($cumple_semestre == 'SI') { echo Html::img('@web/images/done.png'); }
            else { echo Html::img('@web/images/deny.png'); } ?>
        </th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Estratificación</th>
        <th style="text-align: center"><?= $estratificacion ?></th>
        <th style="text-align: center"><?php
            if ($cumple_estratificacion == 'SI') { echo Html::img('@web/images/done.png'); }
            else { echo Html::img('@web/images/deny.png'); } ?>
        </th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Beneficiario</th>
        <th style="text-align: center"><?= $cumple_requisitos ?></th>
        <th style="text-align: center"><?php
            if ($cumple_requisitos == 'SI') { echo Html::img('@web/images/done.png'); }
            else { echo Html::img('@web/images/deny.png'); } ?>
        </th>
    </tr>
</table>
<br>
<div style="font-size: 11pt; text-align: left;">
    <b>Estudiante (SIAD)</b>
</div>
<table width=100% border="1" style="border-collapse:collapse">
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: center">Cédula / Pasaporte</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Ape. Paterno</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Ape. Materno</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Nombres</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Nacionalidad</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Ciudad</th>
    </tr>
    <?php foreach ($estudiante as $row)  { ?>
        <tr>
            <th style="text-align: center"><?= $row->cedula_pasaporte ?></th>
            <th style="text-align: center"><?= $row->ApellInfPer ?></th>
            <th style="text-align: center"><?= $row->ApellMatInfPer ?></th>
            <th style="text-align: center"><?= $row->NombInfPer ?></th>
            <th style="text-align: center"><?= $row->NacionalidadPer ?></th>
            <th style="text-align: center"><?= $row->CiudadPer ?></th>
        </tr>
    <?php } ?>
</table>
<br>
<div style="font-size: 11pt; text-align: left;">
    <b>Matrícula (SIAD)</b>
</div>
<table width=100% border="1" style="border-collapse:collapse">
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: center">Cédula / Pasaporte</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Período</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Carrera</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Semestre</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Fecha Matrícula</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Estado</th>
    </tr>
    <?php foreach ($matricula as $row)  { ?>
        <tr>
            <th style="text-align: center"><?= $row->CIInfPer ?></th>
            <th style="text-align: center"><?= $row->idPer ?></th>
            <th style="text-align: center"><?= $row->idCarr ?></th>
            <th style="text-align: center"><?= $row->idsemestre ?></th>
            <th style="text-align: center"><?= $row->FechaMatricula ?></th>
            <th style="text-align: center"><?= $row->statusMatricula ?></th>
        </tr>
    <?php } ?>
</table>
<br>
<div style="font-size: 11pt; text-align: left;">
    <b>Ficha de Estratificación</b>
</div>
<table width=100% border="1" style="border-collapse:collapse">
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: center">Cédula / Pasaporte</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Período</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Grupo</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Fecha Registro</th>
    </tr>
    <?php foreach ($festrat as $row)  { ?>
        <tr>
            <th style="text-align: center"><?= $row->cedula ?></th>
            <th style="text-align: center"><?= $row->periodo ?></th>
            <th style="text-align: center"><?= $row->Grupo ?></th>
            <th style="text-align: center"><?= $row->fecha_reg ?></th>
        </tr>
    <?php } ?>
</table>
<br>
<p align="center">
    <?= Html::a(Yii::t('app', 'Llenar Ficha'), ['create','search'=> $user->getAttribute(Yii::$app->params['dni'],0)], ['class' => 'btn btn-lg btn-success']) ?>
    <?= Html::a(Yii::t('app', 'Reiniciar Búsqueda'),
        Url::toRoute(['becasconectividad/beneficiarioadmin']), ['class' => 'btn btn-warning']) ?>
</p>
