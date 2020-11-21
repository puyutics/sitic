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

$estudiante = \app\models\Estudiantes::find()
    ->where(["cedula_pasaporte" => $dni])
    ->all();

$contratos = \app\models\TabIntFormulario::find()
    ->Where(['cedula' => $dni])
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

if (count($userprofile)>0) {
    $check_userprofile = true;
} else {
    $check_userprofile = false;
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

//VERIFICAR SI EXISTEN BECAS DE CONECTIVIDAD
$becas = \app\models\BecasConectividad::find()
    ->where(["dni" => $dni])
    ->all();

if (count($becas) > 0 ) {
    Yii::$app->response->redirect(['becasconectividad/view', 'id' => $becas[0]->id]);
}

?>

<?php if ($check_userprofile == true) { ?>
    <?php if ($system_status == true) { ?>
        <?php if ($cumple_requisitos == 'SI') { ?>

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

                <?= $form->field($model, 'dni')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $dni]) ?>

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

                <div class="alert alert-info" align="center">
                    <h3>DATOS DE LA CUENTA BANCARIA</h3>
                    <p>Ingrese el Número de su Cuenta <strong>PERSONAL</strong>  e Institución Financiera a la que pertenece.</p>
                </div>

                <?= $form->field($model, 'cuenta_dni')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $dni]) ?>

                <?= $form->field($model, 'cuenta_numero')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'cuenta_titular')->textInput(['maxlength' => true,'readonly'=> true, 'value' => $nombres . ' ' . $apellidos]) ?>

                <?php echo $form->field($model, 'cuenta_tipo')->dropDownList([
                    ''=>'Seleccionar tipo cuenta',
                        'Ahorros'=>'Ahorros',
                        'Corriente'=>'Corriente',
                ])
                ?>

                <?php echo $form->field($model, 'cuenta_institucion')->dropDownList([
                    ''=>'Seleccionar institución financiera',
                    'Banco del Austro' => 'Banco del Austro',
                    'BanEcuador'=>'BanEcuador',
                    'Banco Guayaquil'=>'Banco Guayaquil',
                    'Banco Internacional'=>'Banco Internacional',
                    'Banco Pacífico'=>'Banco Pacífico',
                    'Banco Produbanco'=>'Banco Produbanco',
                    'Banco Pichincha'=>'Banco Pichincha',
                    'Banco Sudamericano'=>'Banco Sudamericano',
                    'CACPE Pastaza' => 'CACPE Pastaza',
                    'Coop. Acción Rural' => 'Coop. Acción Rural',
                    'Coop. Amazonas' => 'Banco Internacional',
                    'Coop. C. C. de Ambato' => 'Coop. C. C. de Ambato',
                    'Coop. Jardín Azuay' => 'Coop. Jardín Azuay',
                    'Coop. La Merced Cuenca' => 'Coop. La Merced Cuenca',
                    'Coop. Mushuc Yuyai' => 'Coop. Mushuc Yuyai',
                    'Coop. Mushuc Runa' => 'Coop. Mushuc Runa',
                    'Coop. San Francisco' => 'Coop. San Francisco',
                    'Coop. 29 de Octubre' => 'Coop. 29 de Octubre',
                    'Coop. JEP' => 'Coop. JEP',
                    'Coop. OSCUS' => 'Coop. OSCUS',
                ])
                ?>

                <div class="alert alert-info" align="center">
                    <h3 align="center"><code><?= Html::encode('') ?></code></h3>
                </div>

                <?php echo $form->field($model, 'upload_libreta')->widget(FileInput::classname(), [
                    'options'=>[
                        'accept' => 'image/*',
                        'multiple' => false
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

                <div class="alert alert-info" align="center">
                    <h3>DATOS DE CONTACTO</h3>
                </div>

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

                <?= $form->field($model, 'cel_contacto')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'tel_contacto')->textInput(['maxlength' => true]) ?>

                <div class="alert alert-danger" align="center">
                    <h4><b>NOTA: La información ingresada en este formulario es responsabilidad exclusiva del Beneficiario, no puede ser delegada a terceras personas.</b></h4>
                </div>

                <div class="alert alert-success" align="center">
                    <?= $form->field($model, 'status')->checkBox([
                        'checked' => false,
                        'required' => true,
                        'label' => 'Acepto que toda la información contenida en el presente formulario es verdadera y autorizo a la Universidad Estatal Amazónica a verificarla. Si se comprueba que la información no es correcta o que la cuenta bancaria no pertenece al estudiante, la BECA SERÁ CANCELADA'
                    ]) ?>
                </div>

                <div class="form-group" align="center">
                    <?= Html::submitButton(Yii::t('app', 'Subir Datos'), ['class' => 'btn btn-lg btn-danger']) ?>
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




