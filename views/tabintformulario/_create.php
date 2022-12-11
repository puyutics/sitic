<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\TabIntFormulario */
/* @var $form yii\widgets\ActiveForm */

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);
    $system_status = true;
} else {
    $sAMAccountname = Yii::$app->user->identity->username;
    $user = Yii::$app->ad->getProvider('default')->search()
        ->findBy('sAMAccountname', $sAMAccountname);
    $dni = $user->getAttribute(Yii::$app->params['dni'],0);
    $system_status = true;
}

$this->title = Yii::t('app', 'Beneficiario: {nameAttribute}', [
    'nameAttribute' => $dni,
]);
$this->params['breadcrumbs'][] = Yii::t('app', 'Beneficiario: ' . $dni);

$userprofile = \app\models\UserProfile::find()
    ->where(["dni" => $dni])
    ->all();

$tabintformulario = \app\models\TabIntFormulario::find()
    ->where(["cedula" => $dni])
    ->all();

$estudiante = \app\models\siad_pregrado\Estudiantes::find()
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

if (count($userprofile)>0) {
    $check_userprofile = true;
} else {
    $check_userprofile = false;
}

if (count($tabintformulario)>0) {
    $tabintformularioid = $tabintformulario[0]->id;
    Yii::$app->response->redirect(['tabintformulario/view', 'id' => $tabintformularioid]);
}

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

?>

<?php if ($check_userprofile == true) { ?>
    <?php if ($system_status == true) { ?>
        <?php if ($cumple_beneficio == 'SI') { ?>

            <div class="alert alert-info" align="center">
                <h3 align="center"><?= Html::encode($this->title) ?></h3>
            </div>

            <div class="tab-int-formulario-form">

                <div class="alert alert-info" align="center">
                    <h3>CONTRATO DE PRÉSTAMO Y ENTREGA DE RECURSOS ACADÉMICOS</h3>
                </div>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'labelOptions' => ['class' => 'col-lg-4 control-label'],
                    ],
                ]); ?>

                <?= $form->field($model, 'cedula')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $dni]) ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $user->getAttribute('samaccountname',0)]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $user->getEmail()]) ?>

                <?= $form->field($model, 'nombres')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $nombres]) ?>

                <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $apellidos]) ?>

                <div class="alert alert-info" align="center">
                    <h3>REQUISITOS Y BENEFICIOS</h3>
                </div>

                <?= $form->field($model, 'siad_matriculado')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $matriculado]) ?>

                <?= $form->field($model, 'siad_carrera')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $nom_carrera]) ?>

                <?= $form->field($model, 'siad_semestre')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $semestre]) ?>

                <?= $form->field($model, 'ficha_escasos_recursos')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $estratificacion]) ?>

                <?= $form->field($model, 'encuesta_beneficiario')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $beneficio]) ?>

                <div class="alert alert-danger" align="center">
                    <h4><b>NOTA: La información ingresada en este formulario es responsabilidad exclusiva del Beneficiario, no puede ser delegada a terceras personas.</b></h4>
                </div>

                <div class="alert alert-warning" align="center">
                    <h4><?= Html::encode('Verifique si existe cobertura 3G o 4G de telefonía móvil para acceder al servicio.') ?></h4>
                    <h5>Ingrese en: <a href="http://www.claro.com.ec/personas/servicios/servicios-moviles/cobertura/" target="_blank">http://www.claro.com.ec/personas/servicios/servicios-moviles/cobertura/</a></h5>
                    <?= $form->field($model, 'cobertura')->checkBox([
                        'checked' => false,
                        'required' => true,
                        'label' => 'Acepto haber verificado que cuento con cobertura 3G o 4G para acceder al beneficio otorgado.'
                    ]) ?>
                </div>

                <?php if ($beneficio == 'Internet Educativo Ilimitado') { ?>
                    <div class="alert alert-warning" align="center">
                        <h4><?= Html::encode('¿Cuenta con un Dispositivo Móvil o Teléfono Inteligente (Smartphone), para utilizar la Tarjeta SIM con Internet Educativo Ilimitado?') ?></h4>
                        <?= $form->field($model, 'smartphone')->checkBox([
                            'checked' => false,
                            'required' => true,
                            'label' => 'Dispongo del dispositivo móvil requerido.'
                        ]) ?>
                    </div>
                <?php } ?>

                <div class="alert alert-warning" align="center">
                    <h4><?= Html::encode('Responsabilidad de Uso de Medios y Servicios Electrónicos (Documento solo para lectura, NO debe imprimir el documento)') ?></h4>
                    <h5>Clic aquí: <a href="https://www.uea.edu.ec/sitic/uploads/tabintformulario/contrato/declaracion_modelo.pdf" target="_blank">Leer Declaración de Responsabilidad de Uso (Modelo)</a></h5>
                    <?= $form->field($model, 'responsabilidad_uso')->checkBox([
                        'checked' => false,
                        'required' => true,
                        'label' => 'Acepto haber leído en su totalidad y a entera satisfacción la Declaración de Responsabilidad para el uso de medios y servicios electrónicos que la Universidad Estatal Amazónica provee a través de su portal web.'
                    ]) ?>
                </div>

                <?php if ($beneficio == 'TABLET e Internet Educativo Ilimitado') { ?>
                    <div class="alert alert-warning" align="center">
                        <h4><?= Html::encode('CONTRATO DE PRÉSTAMO DE TABLET (Documento solo para lectura, NO debe imprimir el documento)') ?></h4>
                        <h5>Clic aquí: <a href="https://www.uea.edu.ec/sitic/uploads/tabintformulario/contrato/contrato_modelo.pdf" target="_blank">Leer Contrato de Préstamo de Tablet (Modelo)</a></h5>
                        <?= $form->field($model, 'condiciones')->checkBox([
                            'checked' => false,
                            'required' => true,
                            'label' => 'Acepto haber leído en su totalidad y a entera satisfacción todos los términos y condiciones de la Universidad Estatal Amazónica. La información ingresada en este formulario es verdadera. Me responsabilizo de los recursos académicos a ser entregados. Acepto someterme a las leyes civiles, judiciales o penales, en caso de no cumplir con los términos y condiciones del contrato.'
                        ]) ?>
                    </div>
                <?php } ?>

                <div class="alert alert-info" align="center">
                    <h4>ADJUNTAR DOCUMENTOS OBLIGATORIOS</h4>
                    <h5>Es importante subir una copia de su Cédula o Pasaporte Vigente, y un documento legible del servicio básico de su domicilio.</h5>
                    <!-- <h5>Convertir PDF en JPG: <a href="https://smallpdf.com/pdf-to-jpg" target="_blank">https://smallpdf.com/pdf-to-jpg</a></h5> -->
                </div>

                <?php echo $form->field($model, 'upload_cedula_pasaporte')->widget(FileInput::classname(), [
                    'options'=>[
                        'accept' => 'image/*',
                        'multiple'=>false
                    ],
                    'pluginOptions' => [
                        'browseLabel' =>  'SUBIR',
                        'dropZoneEnabled' => false,
                        'showUpload' => false,
                        'showPreview' => true,
                        'showCaption' => true,
                        'showRemove' => true,
                    ]
                ]); ?>

                <?php echo $form->field($model, 'upload_servicio_basico')->widget(FileInput::classname(), [
                    'options'=>[
                        'accept' => 'image/*',
                        'multiple'=>false
                    ],
                    'pluginOptions' => [
                        'browseLabel' =>  'SUBIR',
                        'dropZoneEnabled' => false,
                        'showUpload' => false,
                        'showPreview' => true,
                        'showCaption' => true,
                        'showRemove' => true,
                    ]
                ]); ?>

                <div class="alert alert-info" align="center">
                    <h4>DATOS PARA LA ENTREGA</h4>
                    <h5>Proporcione la dirección exacta donde se entregarán los recursos académicos.
                        La recepción será de carácter personal e intransferible. Si la dirección no es exacta
                        o usted no está presente el día de la entrega perderá el acceso a los recursos académicos.
                    </h5>
                </div>

                <div class="alert alert-danger" align="center">
                    <h4>OBLIGATORIO: Utilice el siguiente enlace para determinar su código postal y dirección exacta</code></h4>
                    <h4><a href="http://www.codigopostal.gob.ec" target="_blank">http://www.codigopostal.gob.ec</a></h4>
                </div>

                <?= $form->field($model, 'codigo_postal')->textInput(['maxlength' => true]) ?>

                <?php echo $form->field($model, 'provincia')->dropDownList([
                    ''=>'Seleccionar provincia',
                    'AZUAY'=>'AZUAY',
                    'BOLIVAR'=>'BOLIVAR',
                    'CAÑAR'=>'CAÑAR',
                    'CARCHI'=>'CARCHI',
                    'COTOPAXI'=>'COTOPAXI',
                    'CHIMBORAZO'=>'CHIMBORAZO',
                    'EL ORO'=>'EL ORO',
                    'ESMERALDAS'=>'ESMERALDAS',
                    'GALAPAGOS'=>'GALAPAGOS',
                    'GUAYAS'=>'GUAYAS',
                    'IMBABURA'=>'IMBABURA',
                    'LOJA'=>'LOJA',
                    'LOS RIOS'=>'LOS RIOS',
                    'MANABI'=>'MANABI',
                    'MORONA SANTIAGO'=>'MORONA SANTIAGO',
                    'NAPO'=>'NAPO',
                    'ORELLANA'=>'ORELLANA',
                    'PASTAZA'=>'PASTAZA',
                    'PICHINCHA'=>'PICHINCHA',
                    'SANTO DOMINGO'=>'SANTO DOMINGO',
                    'SANTA ELENA'=>'SANTA ELENA',
                    'SUCUMBIOS'=>'SUCUMBIOS',
                    'TUNGURAHUA'=>'TUNGURAHUA',
                    'ZAMORA CHINCHIPE'=>'ZAMORA CHINCHIPE',
                ])
                ?>

                <?= $form->field($model, 'canton')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'parroquia')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'calle_principal')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'calle_secundaria')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'referencia_texto')->textInput(['maxlength' => true]) ?>

                <?php echo $form->field($model, 'upload_referencia_foto')->widget(FileInput::classname(), [
                    'options'=>[
                        'accept' => 'image/*',
                        'multiple'=>false
                    ],
                    'pluginOptions' => [
                        'browseLabel' =>  'SUBIR FOTO',
                        'dropZoneEnabled' => false,
                        'showUpload' => false,
                        'showPreview' => true,
                        'showCaption' => true,
                        'showRemove' => true,
                    ]
                ]); ?>

                <?= $form->field($model, 'cel_contacto')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tel_contacto')->textInput(['maxlength' => true]) ?>

                <div class="alert alert-warning" align="center">
                    <h4 align="center"><?= Html::encode('Acepto que toda la información contenida en el presente formulario es verdadera y autorizo a la Universidad Estatal Amazónica a verificarla, en caso de requerirlo.') ?></h4>
                </div>

                <div class="form-group" align="center">
                    <?= Html::submitButton(Yii::t('app', 'Firmar Contrato Digital'), ['class' => 'btn btn-lg btn-danger']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

        <?php } else { ?>
            <div class="alert alert-danger" align="center">
                <h3 align="center"><code><?= Html::encode('No cumple con los requerisitos para este beneficio') ?></code></h3>
            </div>
        <?php } ?>
    <?php } else { ?>
        <div class="alert alert-info" align="center">
            <h3 align="center"><?= Html::encode('Manténgase informado por nuestros canales oficiales, donde se informará la fecha para poder acceder a su beneficio.') ?></h3>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode('El usuario no ha iniciado sesión en el sistema.') ?></h3>
    </div>
<?php } ?>




