<?php
use yii\helpers\Html;

$formulario = \app\models\TabIntFormulario::find()
    ->where(["id" => $id])
    ->one();

$estudiante = \app\models\siad_pregrado\Estudiantes::find()
    ->where(["CIInfPer" => $dni])
    ->all();

$contratosTablets = \app\models\TabIntFormulario::find()
    ->where(["encuesta_beneficiario" => 'TABLET e Internet Educativo Ilimitado'])
    ->all();

$contratosInternet = \app\models\TabIntFormulario::find()
    ->where(["encuesta_beneficiario" => 'Internet Educativo Ilimitado'])
    ->all();

$encuesta = \app\models\TabIntEncuestas::find()
    ->where(["CedulaPasaporte" => $dni])
    ->orderBy(["ID" => SORT_ASC])
    ->all();

$senescyt = \app\models\TabIntSenescyt::find()
    ->where(["cedula_pasaporte" => $dni])
    ->all();

$matricula = \app\models\siad_pregrado\Matricula::find()
    ->where(["CIInfPer" => $dni])
    ->andwhere(["idPer" => '34'])
    ->orderBy(["idsemestre" => SORT_DESC])
    ->all();

$festrat = \app\models\BecasFestrat::find()
    ->where(["cedula" => $dni])
    ->orderBy(["periodo" => SORT_DESC])
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

if (count($festrat)>0) {
    $estratificacion = $festrat[0]->Grupo;
} else {
    $estratificacion = '-';
}

if (count($encuesta)>0) {
    if ($encuesta[0]->Beneficio == 'TABLET') {
        if (count($contratosTablets) < 500) {
            $beneficio = 'TABLET e Internet Educativo Ilimitado';
        } else {
            if (count($contratosInternet) < 500) {
                $beneficio = 'Internet Educativo Ilimitado';
            } else {
                $beneficio = '-';
            }
        }
    } elseif ($encuesta[0]->Beneficio == 'INTERNET') {
        if (count($contratosInternet) < 500) {
            $beneficio = 'Internet Educativo Ilimitado';
        } else {
            $beneficio = '-';
        }
    } else {
        $beneficio = '-';
    }
} else {
    $beneficio = '-';
}

if ($beneficio == '-') {
    if (count($senescyt)>0) {
        if ($senescyt[0]->equipos == 'NO') {
            if (count($contratosTablets) < 500) {
                $beneficio = 'TABLET e Internet Educativo Ilimitado';
            } else {
                if (count($contratosInternet) < 500) {
                    $beneficio = 'Internet Educativo Ilimitado';
                } else {
                    $beneficio = '-';
                }
            }
        } else {
            if ($senescyt[0]->internet == 'No') {
                if (count($contratosInternet) < 500) {
                    $beneficio = 'Internet Educativo Ilimitado';
                } else {
                    $beneficio = '-';
                }
            } else {
                if (count($contratosInternet) < 500) {
                    $beneficio = 'Internet Educativo Ilimitado';
                } else {
                    $beneficio = '-';
                }
            }
        }
    } else {
        if (count($contratosInternet) < 500) {
            $beneficio = 'Internet Educativo Ilimitado';
        } else {
            $beneficio = '-';
        }
    }
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
        ) and $semestre < 10 ) {
        $cumple_semestre = 'SI';
    } elseif (($carrera == 'LTUR'
            or $carrera == 'LTUREL'
            or $carrera == 'LTUREP'
        ) and $semestre < 9 ) {
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
    or $estratificacion == '-'
) {
    $cumple_estratificacion = 'SI';
} else {
    $cumple_estratificacion = 'NO';
}
if ($cumple_matriculado == 'SI'
    and $cumple_carrera == 'SI'
    and $cumple_semestre == 'SI'
    and $cumple_estratificacion == 'SI'
) {
    $cumple_requisitos = 'SI';
} else {
    $cumple_requisitos = 'NO';
}
if ($beneficio != '-'
    and $cumple_requisitos == 'SI'
) {
    $cumple_beneficio = 'SI';
} else {
    $cumple_beneficio = 'NO';
}

if ($formulario->cobertura == 1 ) {
    $cobertura = 'SI';
    $texto_cobertura = 'Acepto haber verificado que cuento con cobertura 3G o 4G para acceder al beneficio otorgado.';
} else {
    $cobertura = 'NO';

}

if ($formulario->smartphone == 1 ) {
    $smartphone = 'SI';
    $texto_smartphone = 'Cuento con un Dispositivo Móvil o Teléfono Inteligente (Smartphone), para utilizar la Tarjeta SIM con Internet Educativo Ilimitado.';
} else {
    $smartphone = 'NO';
}

if ($formulario->responsabilidad_uso == 1 ) {
    $responsabilidad_uso = 'SI';
    $texto_responsabilidad_uso = 'Acepto haber leído en su totalidad y a entera satisfacción la Declaración de Responsabilidad para el uso de medios y servicios electrónicos que la Universidad Estatal Amazónica provee a través de su portal web.';
} else {
    $responsabilidad_uso = 'NO';
}

if ($formulario->condiciones == 1 ) {
    $condiciones = 'SI';
    $texto_condiciones = 'Acepto haber leído en su totalidad y a entera satisfacción todos los términos y condiciones de la Universidad Estatal Amazónica. La información ingresada en este formulario es verdadera. Me responsabilizo de los recursos académicos a ser entregados. Acepto someterme a las leyes civiles, judiciales o penales, en caso de no cumplir con los términos y condiciones del contrato.';
} else {
    $condiciones = 'NO';
}

//$fecha = $formulario->fec_registro;
$fecha = '2020-06-01';

?>

<htmlpageheader name="myheader">
    <div style="border-bottom: 1px solid #000000; text-align: center; padding-top: 3mm; ">
        <h3><?= Html::img('images/uea_logo.png',['style' => 'width:40px;height: 40px']); ?>
            <b>UNIVERSIDAD ESTATAL AMAZÓNICA</b></h3>
        <h5><b>Sistema Integrado de Tecnologías de la Información y Comunicación</b></h5>
    </div>
</htmlpageheader>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<htmlpagefooter name="myfooter">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Documento generado por el Módulo de Gestión de Recursos Académicos,
        el <?php echo $fecha; ?>  - Pág. {PAGENO} de {nb}
    </div>
</htmlpagefooter>
<sethtmlpagefooter name="myfooter" value="on" />
<br>
<h4>
    <div align="center">
        <strong>DECLARACIÓN DE RESPONSABILIDAD PARA EL USO DE MEDIOS Y SERVICIOS ELECTRÓNICOS QUE LA UNIVERSIDAD
            ESTATAL AMAZÓNICA PROVEE A TRAVÉS DE SU PORTAL WEB</strong>
    </div>
</h4>
<br>
<div style="font-size: 9.5pt; text-align: justify;">
    Yo, <b><?= $formulario->nombres . ' ' . $formulario-> apellidos; ?></b>, en adelante <b>“ESTUDIANTE BENEFICIARIO”</b>,
    con cédula de ciudadanía No. <?= $formulario->cedula; ?> declaro que acepto y cumplo los requisitos establecidos
    por la Universidad Estatal Amazónica para el uso de los medios y servicios electrónicos que provee a través de su
    portal web; y, que la documentación e información presentada y registrada es verídica y de mi exclusiva responsabilidad,
    sujetándome a los siguientes términos y condiciones:
    <br>
    <br>
    El <b>ESTUDIANTE BENEFICIARIO</b>, con el fin de cumplir con el presente acuerdo  asume total responsabilidad administrativa,
    civil y penal, tanto por la contraseña y usuario, que son personales e intransferibles, como por la actualidad, vigencia
    y veracidad de la información proporcionada. En tal virtud y en lo que corresponde al acceso y utilización de los medios
    y servicios electrónicos de la Universidad Estatal Amazónica provee a través de su portal web, el <b>ESTUDIANTE BENEFICIARIO</b>
    acepta expresamente que será notificado en el casillero electrónico provisto por la Universidad Estatal Amazónica con los
    avisos, documentos y actos administrativos oficiales emitidos por la institución dentro de los procedimientos administrativos
    que ejecuta; sin perjuicio, de las notificaciones realizadas en las direcciones consignadas. Para este efecto, <b>ESTUDIANTE BENEFICIARIO</b>
    se dará por notificado en la fecha y hora registrada en el casillero electrónico, con los avisos, documentos y actos administrativos
    oficiales emitidos por la Universidad Estatal Amazónica y, por ende, acepta que dicha notificación surtirá todos los efectos
    legales al momento de su recepción en el casillero electrónico asignado.
    <br>
    <br>
    Es obligación del <b>ESTUDIANTE BENEFICIARIO</b> revisar periódicamente el casillero electrónico provisto por la Universidad Estatal
    Amazónica a fin de revisar las notificaciones que por dicho medio le sean realizadas; así como también acceder al contenido
    de las mismas. La omisión en el cumplimiento de esta obligación no afectará la validez jurídica de la notificación realizada.
    <br>
    <br>
    Con la firma y rúbrica de esta Declaración de Responsabilidad, según señala la Ley de Comercio Electrónico, Firmas Electrónicas
    y Mensajes de Datos, el <b>ESTUDIANTE BENEFICIARIO</b> acepta que el usuario y contraseña utilizados surtirán los mismos efectos que
    una firma electrónica con una completa equivalencia funcional, técnica y jurídica. En tal virtud, acepta que todas las acciones
    realizadas por Universidad Estatal Amazónica en el portal web de la Universidad Estatal Amazónica, quedan validadas y legalizadas
    con el usuario y contraseña registradas.
    <br>
    <br>
    Para efectos de avisos referentes a la Universidad Estatal Amazónica, el <b>ESTUDIANTE BENEFICIARIO</b> declara como correo electrónico
    único e institucional el siguiente: <?= $formulario->email ?>, y la dirección domiciliaria actual: <b>Provincia:</b> <?= $formulario->provincia ?>
    <b>Cantón:</b> <?= $formulario->canton ?>, <b>Parroquia:</b> <?= $formulario->parroquia ?>, <b>Calle Principal:</b> <?= $formulario->calle_principal ?>,
    <b>Calle Secundaria:</b> <?= $formulario->calle_secundaria ?>, <b>Referencia:</b> <?= $formulario->referencia_texto ?>, <b>Celular de Contacto:</b>
    <?= $formulario->cel_contacto ?>, <b>Teléfono de Contacto:</b> <?= $formulario->tel_contacto ?>.
    <br>
    <br>
    El <b>ESTUDIANTE BENEFICIARIO</b> acepta que la Universidad Estatal Amazónica tiene derecho a negar, restringir o condicionar el acceso a su portal web,
    de manera total o parcial, a su entera discreción; y, que la Universidad Estatal Amazónica no será responsable por las pérdidas o daños sufridos
    en la información ingresada por <b>ESTUDIANTE BENEFICIARIO</b> ya sea por fallas tecnológicas causadas por el mismo o por actos de terceros.

    <div style="page-break-after: always;"></div>

    Para constancia de lo expresado, suscribo el presente documento, en la ciudad de Puyo, Provincia de Pastaza el <?= $fecha ?>.
    <br>
    <br>
    <br>
    <br>
    <br>
    Declaración aceptada digitalmente por:
    <br>
    <b><?= $formulario->nombres . ' ' . $formulario-> apellidos; ?></b>
    <br>
    <b>ESTUDIANTE BENEFICIARIO</b>
    <br>
    <b>Cédula: <?= $formulario->cedula; ?></b>
</div>
<br>
<barcode code = "<?php echo $url . $formulario->doc_contrato ?>" type="QR" class="barcode" size="1.0" error="M" />

<div style="page-break-after: always;"></div>

<h4>
    <div align="center">
        <strong>FICHA DEL ESTUDIANTE BENEFICIARIO</strong>
    </div>
</h4>
<div align="center">
    <barcode code = "<?php echo $url . $formulario->doc_contrato ?>" type="QR" class="barcode" size="1.0" error="M" />
</div>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Datos Personales</b>
</div>
<table width=100% border="1" style="font-size: 9pt; border-collapse:collapse">
    <tr>
        <th width=30% bgcolor="#EEEEEE" style="text-align: left">Cédula / Pasaporte</th>
        <th style="text-align: left"><?= $formulario->cedula ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Nombres</th>
        <th style="text-align: left"><?= $formulario->nombres ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Apellidos</th>
        <th style="text-align: left"><?= $formulario->apellidos ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Correo Institucional</th>
        <th style="text-align: left"><?= $formulario->email ?></th>
    </tr>
</table>
<br>
<div align="left" style="font-size: 9pt">
    <b>Requisitos y Beneficios</b>
</div>
<table align="center" width=100% border="1" style="font-size: 9pt; border-collapse:collapse">
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
        <th bgcolor="#EEEEEE" style="text-align: left">Beneficio</th>
        <th style="text-align: center"><?= $beneficio ?></th>
        <th style="text-align: center"><?php
            if ($cumple_beneficio == 'SI') { echo Html::img('@web/images/done.png'); }
            else { echo Html::img('@web/images/deny.png'); } ?>
        </th>
    </tr>
    <?php if ($cobertura == 'SI') { ?>
        <tr>
            <th bgcolor="#EEEEEE" style="text-align: left">Cobertura</th>
            <th style="text-align: center"><?= $texto_cobertura ?></th>
            <th style="text-align: center"><?php
                if ($cobertura == 'SI') { echo Html::img('@web/images/done.png'); }
                else { echo Html::img('@web/images/deny.png'); } ?>
            </th>
        </tr>
    <?php } ?>
    <?php if ($smartphone == 'SI') { ?>
        <tr>
            <th bgcolor="#EEEEEE" style="text-align: left">Dispositivo Móvil</th>
            <th style="text-align: center"><?= $texto_smartphone ?></th>
            <th style="text-align: center"><?php
                if ($smartphone == 'SI') { echo Html::img('@web/images/done.png'); }
                else { echo Html::img('@web/images/deny.png'); } ?>
            </th>
        </tr>
    <?php } ?>
    <?php if ($responsabilidad_uso == 'SI') { ?>
        <tr>
            <th bgcolor="#EEEEEE" style="text-align: left">Responsabilidad de Uso</th>
            <th style="text-align: center"><?= $texto_responsabilidad_uso ?></th>
            <th style="text-align: center"><?php
                if ($responsabilidad_uso == 'SI') { echo Html::img('@web/images/done.png'); }
                else { echo Html::img('@web/images/deny.png'); } ?>
            </th>
        </tr>
    <?php } ?>
    <?php if ($condiciones == 'SI') { ?>
        <tr>
            <th bgcolor="#EEEEEE" style="text-align: left">Condiciones</th>
            <th style="text-align: center"><?= $texto_condiciones ?></th>
            <th style="text-align: center"><?php
                if ($condiciones == 'SI') { echo Html::img('@web/images/done.png'); }
                else { echo Html::img('@web/images/deny.png'); } ?>
            </th>
        </tr>
    <?php } ?>
</table>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Encuesta UEA (Primer Grupo)</b>
</div>
<table width=100% border="1" style="font-size: 9pt;border-collapse:collapse">
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: center">Cédula / Pasaporte</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Apellidos</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Nombres</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Carrera</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Computador</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Internet</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Beneficio</th>
    </tr>
    <?php foreach ($encuesta as $row)  { ?>
        <tr>
            <th style="text-align: center"><?= $row->CedulaPasaporte ?></th>
            <th style="text-align: center"><?= $row->Apellidos ?></th>
            <th style="text-align: center"><?= $row->Nombres ?></th>
            <th style="text-align: center"><?= $row->Carrera ?></th>
            <th style="text-align: center"><?= $row->Computador ?></th>
            <th style="text-align: center"><?= $row->Internet ?></th>
            <th style="text-align: center"><?= $row->Beneficio ?></th>
        </tr>
    <?php } ?>
</table>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Encuesta UEA (Segundo Grupo)</b>
</div>
<table width=100% border="1" style="font-size: 9pt;border-collapse:collapse">
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: center">Cédula / Pasaporte</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Nombres</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Carrera</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Semestre</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Equipos</th>
        <th bgcolor="#EEEEEE" style="text-align: center">Internet</th>
    </tr>
    <?php foreach ($senescyt as $row)  { ?>
        <tr>
            <th style="text-align: center"><?= $row->cedula_pasaporte ?></th>
            <th style="text-align: center"><?= $row->nombres ?></th>
            <th style="text-align: center"><?= $row->carrera ?></th>
            <th style="text-align: center"><?= $row->semestre ?></th>
            <th style="text-align: center"><?= $row->equipos ?></th>
            <th style="text-align: center"><?= $row->internet ?></th>
        </tr>
    <?php } ?>
</table>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Estudiante (SIAD)</b>
</div>
<table width=100% border="1" style="font-size: 9pt; border-collapse:collapse">
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
            <th style="text-align: center"><?= $row->CIInfPer ?></th>
            <th style="text-align: center"><?= $row->ApellInfPer ?></th>
            <th style="text-align: center"><?= $row->ApellMatInfPer ?></th>
            <th style="text-align: center"><?= $row->NombInfPer ?></th>
            <th style="text-align: center"><?= $row->NacionalidadPer ?></th>
            <th style="text-align: center"><?= $row->CiudadPer ?></th>
        </tr>
    <?php } ?>
</table>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Matrícula (SIAD)</b>
</div>
<table width=100% border="1" style="font-size: 9pt; border-collapse:collapse">
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
<div style="font-size: 9pt; text-align: left;">
    <b>Ficha de Estratificación</b>
</div>
<table width=100% border="1" style="font-size: 9pt; border-collapse:collapse">
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

<div style="page-break-after: always;"></div>

<br>
<h4>
    <div align="center">
        <strong>DIRECCIÓN DE ENTREGA DEL ESTUDIANTE BENEFICIARIO</strong>
    </div>
</h4>
<div align="center">
    <barcode code = "<?php echo $url . $formulario->doc_contrato ?>" type="QR" class="barcode" size="1.0" error="M" />
</div>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Datos Personales</b>
</div>
<table width=100% border="1" style="font-size: 9pt; border-collapse:collapse">
    <tr>
        <th width=30% bgcolor="#EEEEEE" style="text-align: left">Cédula / Pasaporte</th>
        <th style="text-align: left"><?= $formulario->cedula ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Nombres</th>
        <th style="text-align: left"><?= $formulario->nombres ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Apellidos</th>
        <th style="text-align: left"><?= $formulario->apellidos ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Correo Institucional</th>
        <th style="text-align: left"><?= $formulario->email ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Celular Contacto</th>
        <th style="text-align: left"><?= $formulario->cel_contacto ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Teléfono Contacto</th>
        <th style="text-align: left"><?= $formulario->tel_contacto ?></th>
    </tr>
</table>
<br>
<div style="font-size: 9pt; text-align: left;">
    <b>Dirección</b>
</div>
<table width=100% border="1" style="font-size: 9pt; border-collapse:collapse">
    <tr>
        <th width=30% bgcolor="#EEEEEE" style="text-align: left">Código Postal</th>
        <th style="text-align: left"><?= $formulario->codigo_postal ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Provincia</th>
        <th style="text-align: left"><?= $formulario->provincia ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Cantón</th>
        <th style="text-align: left"><?= $formulario->canton ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Parroquia</th>
        <th style="text-align: left"><?= $formulario->parroquia ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Calle principal</th>
        <th style="text-align: left"><?= $formulario->calle_principal ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Calle secundaria</th>
        <th style="text-align: left"><?= $formulario->calle_secundaria ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Referencia Vivienda</th>
        <th style="text-align: left"><?= $formulario->referencia_texto ?></th>
    </tr>
    <tr>
        <th bgcolor="#EEEEEE" style="text-align: left">Foto Vivienda</th>
        <th style="text-align: left">
            <?= Html::img('uploads/tabintformulario/referencia_foto/' . $formulario->referencia_foto,
                ['style' => 'width:480px;height: 360px']); ?>
        </th>
    </tr>
</table>
