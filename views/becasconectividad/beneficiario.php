<?php

/* @var $this yii\web\View */
/* @var $model models\adldap */

use yii\helpers\Html;

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

$this->title = Yii::t('app', 'Beneficiario: {nameAttribute}', [
    'nameAttribute' => $dni,
]);
$this->params['breadcrumbs'][] = Yii::t('app', 'Beneficiario: ' . $dni);

$estudiante = \app\models\siad_pregrado\Estudiantes::find()
    ->where(["cedula_pasaporte" => $dni])
    ->all();

$contratos = \app\models\TabIntFormulario::find()
    ->andWhere(['cedula' => $dni])
    ->all();

$matricula = \app\models\siad_pregrado\Matricula::find()
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

if (count($contratos)>0) {
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

<div class="alert alert-info" align="center">
    <h4 align="center"><?= Html::encode('RECUERDA: la beca de conectvidad se entregará por una sola ocasión durante el semestre 2020-2021.') ?></h4>
    <h4 align="center"><?= Html::encode('Todo trámite es 100% GRATUITO') ?></h4>
</div>

<div align="center" style="font-size: 11pt">
    <b>Datos Personales</b>
</div>
<table align="center" width=70% border="1" style="border-collapse:collapse">
    <tr>
        <th width=20% bgcolor="#EEEEEE" style="text-align: left">Cédula / Pasaporte</th>
        <th style="text-align: left"><?= $model->dni ?></th>
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
        <th style="text-align: left"><?= $model->mail ?></th>
    </tr>
</table>
<br>
<div align="center" style="font-size: 11pt">
    <b>Cumplimiento de Requisitos</b>
</div>
<table align="center" width=70% border="1" style="border-collapse:collapse">
    <tr>
        <th width=20% bgcolor="#EEEEEE" style="text-align: left">Matriculado</th>
        <th width=30% style="text-align: center"><?= $matriculado ?></th>
        <th width=20% style="text-align: center"><?php
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
<br>
<?php if ($cumple_requisitos == 'SI') { ?>
    <div class="alert alert-info" align="center">
        <h4 align="center"><?= Html::encode('Para acceder a la Beca de Conectividad, debe llenar los datos de su cuenta bancaria PERSONAL.') ?></h4>
        <h4 align="center"><?= Html::encode('Recuerde que la cuenta bancaria debe estar a nombre del estudiante beneficiario.') ?></h4>
    </div>
    <p align="center">
        <?= Html::a(Yii::t('app', 'Llenar ficha'), ['create'], ['class' => 'btn btn-lg btn-success']) ?>
    </p>
<?php } elseif ($cumple_requisitos == 'NO'
    and $cumple_estratificacion == 'NO') { ?>
    <div class="alert alert-info" align="center">
        <h4 align="center"><?= Html::encode('SOLO TE HACE FALTA UN PASO MÁS para acceder al beneficio.') ?></h4>
        <h4 align="center"><?= Html::encode('Llena las fichas: socio-económica y de estratificación, para que el sistema valide automáticamente tu perfil.') ?></h4>
        <h5 align="center"><code><?= Html::encode('(Iniciar sesión con su Cédula/Pasaporte como usuario y contraseña)') ?></code></h5>
        <?= Html::a(Yii::t('app', 'Llenar Fichas'), 'https://www.uea.edu.ec/bservicios/index.php/fichas/index', ['class' => 'btn btn-lg btn-primary','target'=>'_blank',]) ?>
    </div>
<?php } else { ?>
    <div class="alert alert-danger" align="center">
        <h3 align="center"><?= Html::encode('La Beca de Conectividad, está habilitada de forma exclusiva para estudiantes fueron beneficiarios del programa de Tablets e Internet Ilimitado del semestre 2020-2020.') ?></h3>
    </div>
<?php } ?>
