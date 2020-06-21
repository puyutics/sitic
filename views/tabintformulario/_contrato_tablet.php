<?php
use yii\helpers\Html;

$formulario = \app\models\TabIntFormulario::find()
    ->where(["id" => $id])
    ->one();

$estudiante = \app\models\Estudiantes::find()
    ->where(["cedula_pasaporte" => $dni])
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
    ->orderBy(["ID" => SORT_ASC])
    ->all();

$matricula = \app\models\Matricula::find()
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
        $beneficio = 'TABLET e Internet Educativo Ilimitado';
    } elseif ($encuesta[0]->Beneficio == 'INTERNET') {
        $beneficio = 'Internet Educativo Ilimitado';
    } else {
        $beneficio = '-';
    }
} else {
    $beneficio = '-';
}

if ($beneficio == '-') {
    if (count($senescyt)>0) {
        if ($senescyt[0]->equipos == 'NO') {
            if (count($contratosTablets) < 480) {
                $beneficio = 'TABLET e Internet Educativo Ilimitado';
            } else {
                $beneficio = 'Internet Educativo Ilimitado';
            }
        } else {
            if ($senescyt[0]->internet == 'No') {
                $beneficio = 'Internet Educativo Ilimitado';
            }
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

///////////////// TABLET ASIGNADA ///////////////////
$invpurchaseitem = \app\models\InvPurchaseItem::find()
    ->where(["id" => $invpurchaseitemid])
    ->one();

$fecha = $formulario->fec_registro;

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
        <strong>CONTRATO DE PRÉSTAMO DE RECURSOS ACADÉMICOS</strong>
    </div>
</h4>
<br>
<div style="font-size: 9.5pt; text-align: justify;">
    Comparecen a la celebración del presente contrato, por una parte, la Universidad Estatal Amazónica,
    debidamente Representada por la Dra. <b>RUTH IRENE ARIAS GUTIERREZ</b>, con cédula de ciudadanía No. 0601656697,
    en calidad de Rectora y Representante legal de la Universidad Estatal Amazónica, según acción de personal
    No. 226-DTH-UEA-2019, Número de Ruc 1660012180001 en calidad de comodante, ubicada en el paso lateral vía Napo km 2/1;
    que para efectos del presente instrumento se denominara <b>“UEA”</b> y, por otra parte <b><?= $formulario->nombres . ' ' . $formulario-> apellidos; ?></b>,
    cédula de ciudadanía No. <?= $formulario->cedula; ?> el mismo que cursa  el <?= $semestre; ?> semestre,
    en calidad de Comodatario que para efectos del presente instrumento se denominará <b>“ESTUDIANTE BENEFICIARIO”</b>,
    quienes convienen en celebrar el presente Contrato de Comodato o Préstamo, al tenor de las siguientes cláusulas.
    <br>
    <br>
    <b>Cláusula Primera. - ANTECEDENTES:</b>
    <br>
    <br>
    <b>1.01.- </b>El artículo 355 de la Carta Suprema, entre otros principios, establece que el Estado reconocerá a las
    universidades y escuelas politécnicas autonomía académica, administrativa, financiera y orgánica, acorde con los
    objetivos del régimen de desarrollo y los principios establecidos en la Constitución;
    <br>
    <br>
    <b>1.02.- </b>El artículo 5 de la Ley Orgánica de Educación Superior (LOES), determina: " Son derechos de las y los
    estudiantes los siguientes: (...) b) Acceder a una educación superior de calidad y pertinente, que permita iniciar
    una carrera académica y/o profesional en igualdad de oportunidades; y, c) Contar y acceder a los medios y recursos
    adecuados para su formación superior; garantizados por la Constitución;
    <br>
    <br>
    <b>1.03.- </b>El principio de igualdad de oportunidades establecido en el artículo 71 de la Ley Orgánica de Educación
    Superior consiste en garantizar a todos los actores del Sistema de Educación Superior las mismas posibilidades en el
    acceso, permanencia, movilidad y egreso del sistema, sin discriminación de género, credo, orientación sexual, etnia,
    cultura, preferencia política, condición socioeconómica, de movilidad o discapacidad”;
    <br>
    <br>
    <b>1.04.- </b>El artículo 3 de la Ley Orgánica de la Contraloría General del Estado señala que se entenderán por recursos
    públicos, todos los bienes, fondos, títulos, acciones, participaciones, activos, rentas, utilidades, excedentes,
    subvenciones y todos los derechos que pertenecen al Estado y a sus instituciones, sea cual fuere la fuente de la que
    procedan, inclusive los provenientes de préstamos, donaciones y entregas que, a cualquier otro título realicen a favor
    del Estado o de sus instituciones, personas naturales o jurídicas u organismos nacionales o internacionales”;
    <br>
    <br>
    <b>1.05.- </b>El artículo 2077 del Código Civil vigente establece que: “Comodato o préstamo de uso es un contrato en
    que una de las partes entrega a la otra gratuitamente una especie, mueble o raíz, para que haga uso de ella, con cargo
    de restituir la misma especie después de terminado el uso.”;
    <br>
    <br>
    <b>1.06.- </b>Mediante Resolución N° RPC-SE-03-No.046-2020, del 25 de marzo de 2020, el Consejo de Educación Superior
    expidió la “Normativa transitoria para el desarrollo de actividades académicas en las Instituciones de Educación Superior,
    debido al estado de excepción decretado por la emergencia sanitaria ocasionada por la pandemia de COVID-19”, que tiene
    como objeto “(…) garantizar el derecho a la educación de los estudiantes de las instituciones de educación superior (IES),
    debido al estado de excepción que rige en el territorio nacional.”;
    <br>
    <br>
    <b>1.07.- </b>El artículo 5 de la Resolución ibídem, determina que: “Las IES, en los planes de estudio aprobados por el CES,
    podrán adecuar las actividades de aprendizaje para que puedan ser desarrolladas e impartidas mediante el uso de tecnologías
    interactivas multimedia y entornos virtuales de aprendizaje, a través de plataformas digitales. Del mismo modo, las IES
    deberán garantizar que estos recursos de aprendizaje estén disponibles para todos los estudiantes y personal académico. (…)”;
    <br>
    <br>
    <b>1.08.- </b>Con fecha 24 de abril de 2020 los miembros del Honorable Consejo Universitario, mediante RESOLUCIÓN Nro.
    099-UEA-2020 resuelven: “Art. 1.- Declarar el Estado de Emergencia Institucional en las contrataciones de carácter
    académico que permitan la conectividad y el inicio de clases en línea en la Universidad Estatal Amazónica por la inminente
    posibilidad del efecto provocado por la pandemia de la enfermedad COVID-19, y su afectación en la continuidad del derecho
    a la educación de los estudiantes”;
    <br>
    <br>
    <b>1.09.- </b>Con fecha 11 de mayo de 2020, la UEA suscribió con CONECEL S.A. dos contratos, el primero con el objeto de
    adquirir EQUIPOS INFORMÁTICOS PARA ESTUDIANTES DE ESCASOS RECURSOS ECONÓMICOS DE LA UNIVERSIDAD ESTATAL AMAZÓNICA, QUE
    GARANTICEN EL ACCESO A LA EDUCACIÓN VIRTUAL con un plazo de quince días para la entrega; y un segundo, con el objeto de
    que se provea el SERVICIO DE INTERNET EDUCATIVO ILIMITADO Y ADMINISTRACIÓN DE DISPOSITIVOS PARA ESTUDIANTES DE ESCASOS
    RECURSOS ECONÓMICOS DE LA UNIVERSIDAD ESTATAL AMAZÓNICA, QUE GARANTICEN EL ACCESO A LA EDUCACIÓN VIRTUAL.;
    <br>
    <br>
    <b>1.10.- </b>Con fecha 26 de mayo de 2020 los miembros del Honorable Consejo Universitario, mediante RESOLUCIÓN Nro.
    HCU-UEA-129-2020 resuelven: “Art. 1.- Aprobar el INSTRUCTIVO QUE REGULE LA ENTREGA DE EQUIPOS INFORMÁTICOS (TABLETS)
    Y LA DOTACIÓN DEL  SERVICIO DE INTERNET A LOS ESTUDIANTES DE ESCASOS RECURSOS ECONÓMICOS DE LA UNIVERSIDAD ESTATAL
    AMAZÓNICA”;.
    <br>
    <br>
    <b>1.11.- </b>Los artículos 2 y 52 de la Ley de Comercio Electrónico, Firmas Electrónicas y Mensajes de Datos, reconocen
    la validez jurídica de los certificados, documentos y demás mensajes de datos otorgados, autorizados o expedidos; y,
    firmados electrónicamente, que hayan sido emitidos de conformidad con las disposiciones de dicha ley, confiriéndoles
    igual valor que el que ostentan los documentos escritos.
    <br>
    <br>
    <b>Cláusula Segunda. - DOCUMENTOS HABILITANTES:</b>
    <br>
    <br>
    <b>2.1.- </b>Forman parte del presente Contrato los siguientes documentos:
    <br>
    <br>
    a) Copias de cedula del estudiante beneficiario que suscribe el presente Contrato.
    <br>
    b)	Papeleta de servicio básico del domicilio del estudiante beneficiario
    <br>
    c)	Declaración de responsabilidad para el uso de medios y servicios electrónicos
    que la Universidad Estatal Amazónica
    provee a través de su portal web
    <br>
    d)	Acción de personal del representante de la Institución.
    <br>
    e)	Copia del INSTRUCTIVO QUE REGULE LA ENTREGA DE EQUIPOS INFORMÁTICOS (TABLETS )
    Y LA DOTACIÓN DEL  SERVICIO DE INTERNET A LOS ESTUDIANTES DE ESCASOS RECURSOS ECONÓMICOS
    DE LA UNIVERSIDAD ESTATAL AMAZÓNICA.
    <br>
    f)	Copia del Registro Único de Contribuyentes (RUC) de la entidad comodataria
    <br>
    <br>
    <b>Cláusula Tercera. - OBJETO:</b>
    <br>
    <br>
    <b>3.1.- </b>La UEA entrega en comodato o préstamo de uso al ESTUDIANTE BENEFICIARIO,
    para uso y acceso exclusivo de sus clases virtuales:
    <br>
    <br>
    - Un equipo con las siguientes características: Tablet con pantalla de 8 pulgadas,
    sistema operativo Android, Procesador: Quad Core 2GHz, Memoria Ram de 2GB, Almacenamiento
    Interno de 32GB expansible hasta 512GB con memoria MicroSD, GPS, Wifi, Bluetooth,
    modem 4G LTE, cámara y micrófono integrados. Batería de 5100 mAh.
    <br>
    <b>Descripción:</b> <?= $invpurchaseitem->description ?>
    <br>
    <b>No. Serie del Equipo:</b> <?= $invpurchaseitem->serial_number ?>
    <br>
    <b>Código de control:</b> <?= $invpurchaseitem->control_code ?>
    <br>
    <br>
    - El servicio de internet educativo ilimitado con filtro de contenido a sitios de violencia,
    pornografía, armas, drogas, crimen, ocio; y el Servicio de Administración de dispositivos,
    centralizados en una nube, basados en hardware, con gestión de permisos para aplicaciones y
    datos, monitorización y rastreo del dispositivo en tiempo real, con licencias de uso mientras
    se encuentre activo el servicio de internet.
    <br>
    <br>
    <b>Cláusula Cuarta. – Obligaciones de las partes:</b>
    <br>
    <br>
    <b>4.1.- </b>Es obligación del ESTUDIANTE BENEFICIARIO cumplir con las siguientes políticas de uso:
    <br>
    <br>
    - Dado que el equipo se encuentra cubierto con un soporte técnico inmediato, si se detecta falla,
    avería o un evento que haga necesaria la aplicación de la garantía por defectos de fábrica de los
    equipos, el estudiante debe reportar directamente, máximo dentro de las 48 horas, según lo establecido
    en el contrato EMERG-UEA-01-2020, claúsula cuarta, numeral 4.06 que dice en la parte pertinente:
    que se atenderá mediante asesores de atención al cliente de CONECEL S.A. (Claro) en oficinas a nivel nacional,
    Call Center, o cuando el caso lo amerite visita técnica presencial, en un plazo máximo de 48 horas, donde se puedan
    solucionar problemas tanto por navegación el Servicio de Internet Educativo Ilimitado, como por los
    dispositivos, por defectos del bien. El ESTUDIANTE BENEFICIARIO debe poner este caso también en
    conocimiento de la Unidad de Tecnologías de la Información y Comunicación de la Universidad Estatal
    Amazónica, a través de la página web institucional www.uea.edu.ec/soporte, o por los canales que se indiquen
    por medios oficiales.
    <br>
    <br>
    - El equipo cuenta con una garantía del proveedor CONECEL S.A. de 1 año a partir de su entrega recepción,
    y puede ser ejecutada por el ESTUDIANTE BENEFICIARIO en los centros de atención a clientes del proveedor,
    con un tiempo máximo de respuesta de quince (15) días laborables.
    <br>
    <br>
    - El equipo se encuentra asegurado con recursos públicos de la UEA, que protegen bajo ciertas circunstancias
    incluidas en el contrato la reposición del equipo, cuyo deducible será cubierto por el ESTUDIANTE BENEFICIARIO,
    observando las condiciones particulares del hecho en cada cobertura.
    <br>
    <br>
    - El equipo debe ser devuelto a la UEA, una vez concluido cada Período Académico Ordinario-PAO o cuando se retorne
    a la presencialidad, y de continuar siendo necesario nuevamente el préstamo, previo a la disposición de las
    autoridades, se continuará con el préstamo del equipo. Se renovará el contrato de préstamo, junto con el acta de
    recepción del equipo.
    <br>
    <br>
    - De identificarse que el equipo se encuentra siendo utilizado para fines ajenos al académico, se retirará el mismo,
    sin perjuicio de las sanciones disciplinarias respectivas.
    <br>
    <br>
    - En caso de daño o mal funcionamiento del equipo por causas imputables al El ESTUDIANTE BENEFICIARIO y que no haya
    sido resuelto por sus técnicos; y una vez que estos sean revisados Unidad de Tecnologías de la Información y Comunicación
    de la Universidad Estatal Amazónica y de comprobarse la omisión o descuido por el ESTUDIANTE BENEFICIARIO, se procederá con la
    terminación del contrato de préstamo y la suscripción del acta entrega recepción definitiva, previo al pago
    correspondiente de los equipos.
    <br>
    <br>
    <b>4.2.- </b>Es obligación de la UEA:
    <br>
    <br>
    - Dar solución a las peticiones y problemas que se presentaren en la ejecución del contrato, en un plazo 10 días
    contados a partir de la petición escrita formulada por la contratista.
    <br>
    <br>
    <b>Cláusula Quinta. - PLAZO:</b>
    <br>
    <br>
    <b>5.1.- </b>El plazo de vigencia del presente contrato de préstamo es de un semestre académico a partir de la
    suscripción del acta de Entrega – Recepción del equipo descrito en la cláusula tercera de este contrato.
    <br>
    <br>
    <b>5.2.- </b>El plazo previsto en el que podrá ser renovado, previa solicitud por escrito presentada ante la
    máxima autoridad, a través de la página web institucional www.uea.edu.ec/recepcion , o por los canales que se
    indiquen por medios oficiales.
    <br>
    <br>
    <b>Cláusula Sexta. - ACEPTACIÓN:</b>
    <br>
    <br>
    <b>6.1.- </b>El ESTUDIANTE BENEFICIARIO declara que acepta el presente contrato de préstamo por ser de su beneficio,
    aclarando que la Universidad Estatal Amazónica se reserva la facultad de darlo por terminado en cualquier tiempo,
    de así estimarlo pertinente.
    <br>
    <br>
    <b>Cláusula Séptima. - ACTA DE ENTREGA - RECEPCIÓN:</b>
    <br>
    <br>
    <b>7.1.- </b>Una vez suscrito el contrato por los medios electrónicos válidos para su eficacia, se desplegará la
    respectiva acta de entrega recepción, misma que será impresa y suscrita por El ESTUDIANTE BENEFICIARIO, y entregada
    de manera física al funcionario de la empresa de logística que entrega el equipo materia del presente contrato.
    <br>
    <br>
    <b>Cláusula Octava. - MANTENIMIENTO Y REPARACIÓN:</b>
    <br>
    <br>
    Corresponde al ESTUDIANTE BENEFICIARIO efectuar todos los gastos que demanden la conservación, mantenimiento
    y reparación, del bien entregado en préstamo de uso, durante el plazo de vigencia del presente contrato, que se encuentren
    fuera de la política de uso estipulada en la cláusula cuarta.
    <br>
    Para dicho efecto, El ESTUDIANTE BENEFICIARIO se compromete a realizar el uso adecuado y cuidado recomendado
    por la Universidad Estatal Amazónica.
    <br>
    <br>
    <b>Cláusula Novena. - RESTITUCIÓN:</b>
    <br>
    <br>
    El ESTUDIANTE BENEFICIARIO declara que recibe el bien materia del presente contrato en buen estado físico y de
    funcionamiento, y se obliga a restituirlo a la terminación del plazo del presente instrumento en condiciones
    aceptables, conforme su uso normal, de este hecho se dejará constancia en la respectiva Acta de Entrega – Recepción.
    <br>
    <br>
    <b>Cláusula Décima. - TERMINACIÓN DEL CONTRATO:</b>
    <br>
    <br>
    Además de los casos previstos en la Codificación del Código Civil, en el caso de que el ESTUDIANTE BENEFICIARIO
    incumpliere una o varias de las obligaciones que contrae en virtud de este contrato, la UEA queda facultado para
    darlo por terminado por su sola voluntad y sin necesidad de trámite o requisito previo, debiendo a su vez el
    ESTUDIANTE BENEFICIARIO proceder de forma inmediata a la restitución del bien objeto del presente contrato o su
    equivalente al precio de mercado, para lo cual notificará de su decisión con al menos 10 días de anticipación,
    en el correo y usuario registrado.
    <br>
    <br>
    De conformidad con lo prescrito en el Código Orgánico Administrativo y la Ley de Comercio Electrónico, Firmas
    Electrónicas y Mensajes de Datos, en atención a sus características propias, la notificación efectuada a través
    de medios electrónicos es válida y produce todos sus efectos, siempre que en el procedimiento exista la pertinente
    constancia de su envío, así como de la fecha y hora en la que fue practicada, el contenido íntegro de la respuesta
    y los documentos anexos; y, la plena identificación del remitente y destinatario, por lo que, toda notificación
    electrónica se entenderá realizada en la fecha y hora en la que la respuesta de la UEA  haya sido enviada a la
    dirección de correo electrónico registrado del  ESTUDIANTE BENEFICIARIO, sin perjuicio de que el mensaje de datos
    haya sido o no revisado por su destinatario.
    <br>
    <br>
    <b>Cláusula Décimo Primera. - DISPOSICIONES APLICABLES:</b>
    <br>
    <br>
    <b>11.1.- </b>Las partes se someten a las disposiciones que sobre la materia establece el Título XVIII, Libro IV
    de la Codificación al Código Civil, y a la Jurisdicción Coactiva determinada en el Art. 44 de la LEY ORGÁNICA DE
    EDUCACION SUPERIOR, LOES en armonía con el Art. 211 del estatuto vigente de la Universidad Estatal Amazónica.
    <br>
    <br>
    <b>Cláusula Décimo Segunda. - CONTROVERSIAS:</b>
    <br>
    <br>
    Si se suscitaren divergencias o controversias en la interpretación o ejecución del presente Contrato, las partes
    tratarán de llegar a un acuerdo que solucione el problema. De no mediar acuerdo alguno sobre el asunto controvertido
    las partes se someterán a los jueces competentes señalando como su único domicilio para el efecto el cantón Pastaza.
    <br>
    <br>
    <b>Cláusula Décima Tercera. - COMUNICACIONES ENTRE LAS PARTES.</b>
    <br>
    <br>
    Todas las comunicaciones, sin excepción entre las partes, relativas al contrato, serán formuladas por escrito o por
    medios electrónicos y en idioma español, a través de la página web institucional www.uea.edu.ec/recepcion
    <br>
    <br>
    <b>Cláusula Décimo Cuarta. - ACEPTACIÓN DE LAS PARTES:</b>
    <br>
    <br>
    <b>14.1.- </b>Libre y voluntariamente, previo el cumplimiento de todos y cada uno de los requisitos exigidos por las
    leyes de la materia, las partes declaran expresamente su aceptación a todo lo convenido en el presente Contrato, a
    cuyas estipulaciones se someten.
    <br>
    <br>
    Para constancia de su aceptación, las partes suscriben el presente instrumento en dos ejemplares de igual tenor y
    efecto, en la ciudad de Puyo.
    <br>
    <br>
    <b>Puyo, <?= $formulario->fec_registro; ?></b>
    <br>
    <br>
    <br>
    <br>
    _______________________________________________
    <br>
    <b>Dra. RUTH IRENE ARIAS GUTIERREZ, PhD.</b>
    <br>
    <b>RECTORA DE LA UNIVERSIDAD ESTATAL AMAZÓNICA</b>
    <br>
    <br>
    <br>
    <br>
    Contrato aceptado digitalmente por:
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

    Para constancia de lo expresado, suscribo el presente documento, en la ciudad de Puyo, Provincia de Pastaza el <?= $formulario->fec_registro ?>.
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
