<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:51
 */

use kartik\form\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\password\PasswordInput;
use kartik\icons\Icon;
Icon::map($this);

/* @var $model */

$this->title = Yii::t('app', 'Crear estudiante');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = $this->title;

$fecha_inicio = Yii::$app->params['senecyt_apertura'];
$fecha_fin = Yii::$app->params['senecyt_cierre'];

if (strtotime(date("Y-m-d H:i:s",time())) > strtotime($fecha_inicio)
    AND strtotime(date("Y-m-d H:i:s",time())) < strtotime($fecha_fin)
    ) {
    $system_status = true;
} else {
    $system_status = false;
}

if (isset($_GET['test'])) {
    if ($_GET['test'] == 'true') {
        $system_status = true;
    }
}
?>

<?php if ($system_status == true) { ?>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div align="center">
        <?= Html::img('images/uea_createstudent.png',['height'=>60, 'width'=>700]);?>
    </div>
    <br>
    <?php if ($model->step == 0) { ?>
        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 1: Validar datos del usuario</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger" align="center">
                            <h3>Usted ya tiene una cuenta institucional creada anteriormente</h3>
                        </div>
                        <br>
                        <div align="center">
                            <div class="alert btn-info" align="center">
                                <h3>Notificar su caso <a href="mailto:admision@uea.edu.ec?cc=soporte@uea.edu.ec&subject=SITIC | Eliminar cuenta anterior">aquí</a> o al correo <a href="mailto:admision@uea.edu.ec?cc=soporte@uea.edu.ec&subject=SITIC | Eliminar cuenta anterior">admision@uea.edu.ec</a></h3>
                                <h4><code>RECUERDE incluir su No. Cédula para validar su información</code></h4>
                            </div>
                        </div>

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'fec_nacimiento')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'dni')->textInput(['readOnly' => true]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'lastname')->textInput(['readOnly' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'firstname')->textInput(['readOnly' => true]) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'commonname')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'displayname')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'samaccountname')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'mail')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'personalmail')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'mobile')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'title')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'department')->textInput(['readOnly' => true]) ?>

                        <?php
                        $user = Yii::$app->ad->getProvider('default')->search()
                            ->whereEquals('samaccountname', $model->samaccountname)
                            ->first();

                        $today = strtotime(date('Y-m-d H:i:s'));
                        $lastSetPassword = strtotime($user->getPasswordLastSetDate());
                        $diff = round(($today - $lastSetPassword)/86400);
                        ?>

                        <div align="left">
                            <p><b>Último cambio de contraseña: </b>
                                <?php
                                echo $diff . ' días (' . $user->getPasswordLastSetDate() . ')';
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } elseif ($model->step == 1) { ?>
        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 1: Validar datos del usuario</h3>
                    </div>
                    <div class="panel-body">

                        <?php if (Yii::$app->session->hasFlash('errorNoBd')) { ?>
                            <div class="alert alert-danger" align="center">
                                <?= Yii::$app->session->getFlash('errorNoBd') ?>
                            </div>
                        <?php } ?>

                        <div class="alert alert-success" align="center">
                            <h4>Bienvenido a la Universidad Estatal Amazónica. En 6 pasos vamos a crear su nueva cuenta institucional. Es necesario que ingrese los siguientes datos:</h4>
                        </div>

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'dni')->textInput() ?>

                        <div align="center">
                            <?= $form->field($model, 'fec_nacimiento')->widget(DatePicker::className(), [
                                'options' => ['placeholder' => 'Seleccionar fecha'],
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'todayHighlight' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]) ?>
                        </div>

                        <h5><b>Política de Protección de Datos Personales</b> (<a href="https://bit.ly/3C0V5XZ" target="_blank">https://bit.ly/3C0V5XZ</a>)</h5>
                        <div class="alert alert-info" align="center">
                            La Universidad Estatal Amazónica, comprometida con el respeto de los derechos de los titulares en el Tratamiento de Datos Personales, adopta la presente política con el fin de dar cumplimiento a la regulación vigente y definir el marco de tratamiento de los datos de carácter personal que recoja, almacene, use y circule de conformidad con lo dispuesto en la Ley Orgánica de Protección de Datos Personales (LOPD)
                        </div>
                        <div>
                            <?php echo $form->field($model, 'status')->checkBox([
                                'checked' => false,
                                'required' => true,
                                'label' => '<b>Acepto la Política de Protección de Datos Personales de la UEA</b>'
                            ]) ?>
                        </div>

                        <div class="form-group" align="center">
                            <?= Html::submitButton('Validar Datos', ['class' => 'btn btn-success']) ?>
                        </div>

                        <div align="center">
                            <a href="https://www.facebook.com/ueaeduec/videos/801062734487607" target="_blank">Video con instrucciones</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } elseif ($model->step == 2) { ?>
        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 2: Validar datos de contacto</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'fec_nacimiento')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'dni')->textInput(['readOnly' => true]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'lastname')->textInput(['readOnly' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'firstname')->textInput(['readOnly' => true]) ?>
                            </div>
                        </div>

                        <div class="alert alert-danger" align="center">
                            <h4>CONFIRMAR DATOS DE CONTACTO</h4>
                            <h4>Por favor verifique que su email personal y celular sean los correctos</h4>
                        </div>

                        <?php if (Yii::$app->session->hasFlash('errorDominio')) { ?>
                            <div class="alert alert-warning" align="center">
                                <h4><?= Yii::$app->session->getFlash('errorDominio') ?></h4>
                            </div>
                        <?php } ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'personalmail')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>

                        <div class="form-group" align="center">
                            <?= Html::submitButton('Enviar Correo', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } elseif ($model->step == 3) { ?>

        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 3: Validar TOKEN</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'fec_nacimiento')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'dni')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'mobile')->hiddenInput()->label(false) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'lastname')->textInput(['readOnly' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'firstname')->textInput(['readOnly' => true]) ?>
                            </div>
                        </div>

                        <div class="alert alert-danger" align="center">
                            <h4>CONFIRMAR TOKEN</h4>
                            <h4>Se ha enviado un email con un TOKEN para validar su correo personal</h4>
                        </div>

                        <?= $form->field($model, 'personalmail')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'token')->textInput() ?>


                        <div class="form-group" align="center">
                            <?= Html::submitButton('Validar TOKEN', ['class' => 'btn btn-success']) ?>
                            <?= Html::a('<span class="btn btn-outline-secondary">Reiniciar Proceso</span>',
                                Url::to(['/adldap/createstudent']),
                                ['title' => Yii::t('yii', 'Reiniciar Proceso')]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } elseif ($model->step == 4) { ?>

        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 4: Crear usuario</h3>
                    </div>
                    <div class="panel-body">

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'fec_nacimiento')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'dni')->textInput(['readOnly' => true]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'lastname')->textInput(['readOnly' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'firstname')->textInput(['readOnly' => true]) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'commonname')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'displayname')->textInput(['readOnly' => true]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'personalmail')->textInput(['readOnly' => true, 'maxlength' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'mobile')->textInput(['readOnly' => true, 'maxlength' => true]) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'title')->textInput(['readOnly' => true])->label('Tipo de Usuario') ?>

                        <?= $form->field($model, 'department')->textInput(['readOnly' => true])->label('Carrera') ?>

                        <div class="alert alert-warning" align="center">
                            <h4>Verifique que todos sus datos sean correctos antes de crear el usuario institucional</h4>
                        </div>

                        <div align="center">
                            <?= Html::submitButton('CREAR USUARIO',['class' => 'btn btn-danger',
                                'onClick'=>'alert("Se procederá a crear su nueva cuenta de usuario institucional")'])
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <?php } elseif ($model->step == 5) { ?>

        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 5: Configurar Contraseña</h3>
                    </div>
                    <div class="panel-body">

                        <div class="alert alert-success" align="center">
                            <h4>Cuenta creada correctamente, por favor configure una contraseña</h4>
                        </div>

                        <?= $form->field($model, 'dni')->textInput(['readOnly' => true]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'lastname')->textInput(['readOnly' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'firstname')->textInput(['readOnly' => true]) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'mail')->textInput(['readOnly' => true]) ?>

                        <div class="alert alert-info" align="left">
                            <h4 align="center">
                                <code>Recomendaciones para su nueva contraseña</code>
                            </h4>
                            <hr>
                            <h5> - No puede incluir su número de cédula / pasaporte</h5>
                            <h5> - No puede incluir sus nombres / apellidos</h5>
                            <h5> - Mínimo 8 caracteres</h5>
                            <h5> - Mínimo 1 MAYÚSCULA</h5>
                            <h5> - Mínimo 1 minúscula</h5>
                            <h5> - Mínimo 1 número</h5>
                        </div>

                        <?php if (Yii::$app->session->hasFlash('errorReset')) { ?>
                            <div class="alert alert-danger">
                                <?= Yii::$app->session->getFlash('errorReset') ?>
                            </div>
                        <?php } ?>

                        <?= $form->field($model, 'newPassword')->widget(PasswordInput::classname(), [
                            'pluginOptions' => [
                                'showMeter' => true,
                                'toggleMask' => true
                            ]])
                        ?>

                        <?= $form->field($model, 'verifyNewPassword')->widget(PasswordInput::classname(), [
                            'pluginOptions' => [
                                'showMeter' => true,
                                'toggleMask' => true
                            ]])
                        ?>

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'fec_nacimiento')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'commonname')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'displayname')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'samaccountname')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'personalmail')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'mobile')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'title')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'department')->hiddenInput()->label(false) ?>

                        <div align="center">
                            <?= Html::submitButton('Guardar contraseña',['class' => 'btn btn-danger',
                                'onClick'=>'alert("Se guardará su nueva contraseña")'])
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <?php } elseif ($model->step == 6) { ?>

        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 6: Datos de su nueva cuenta institucional</h3>
                    </div>
                    <div class="panel-body">

                        <div class="alert alert-success" align="center">
                            <h4>Etapa 1: Cuenta creada correctamente</h4>
                        </div>

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'fec_nacimiento')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'dni')->textInput(['readOnly' => true]) ?>

                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'lastname')->textInput(['readOnly' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'firstname')->textInput(['readOnly' => true]) ?>
                            </div>
                        </div>

                        <?= $form->field($model, 'commonname')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'displayname')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'samaccountname')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'mail')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'personalmail')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'mobile')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'title')->textInput(['readOnly' => true]) ?>

                        <?= $form->field($model, 'department')->textInput(['readOnly' => true]) ?>

                        <?php
                        $user = Yii::$app->ad->getProvider('default')->search()
                            ->whereEquals('samaccountname', $model->samaccountname)
                            ->first();

                        $today = strtotime(date('Y-m-d H:i:s'));
                        $lastSetPassword = strtotime($user->getPasswordLastSetDate());
                        $diff = round(($today - $lastSetPassword)/86400);
                        ?>

                        <div align="left">
                            <p><b>Último cambio de contraseña: </b>
                                <?php
                                echo $diff . ' días (' . $user->getPasswordLastSetDate() . ')';
                                ?>
                            </p>
                        </div>

                        <br>

                        <div align="center">
                            <?php if ($diff > 179) { ?>
                                <?php echo Html::a('Contraseña caducada. Cambiar contraseña', 'https://password.uea.edu.ec', [
                                    'class'=>'btn btn-danger',
                                    'target'=>'_blank',
                                    'data-toggle'=>'tooltip',
                                    'title'=>'Contraseña caducada. Cambiar contraseña'
                                ]); ?>
                            <?php } ?>

                            <div class="alert alert-success" align="center">
                                <h4>Etapa 2: Actualización de Datos Académicos</h4>
                                <h5>Ingrese al Sistema Académico SIAD Pregrado y actualice su ficha de datos personales. La Secretaria Académica de la UEA, procederá a realizar su matrícula de forma manual.</h5>
                                <?php echo Html::a('SIAD Pregrado', 'https://www.uea.edu.ec/siad2', [
                                    'class'=>'btn btn-primary',
                                    'target'=>'_blank',
                                    'data-toggle'=>'tooltip',
                                    'title'=>'Matricúlate - SIAD Pregrado'
                                ]); ?>
                            </div>

                            <!--<div class="alert alert-success" align="center">
                                <h4>Etapa 3: Accede a los Cursos de Inducción</h4>
                                <?php /*echo Html::a('EVA Nivelación', 'https://eva.uea.edu.ec/evanv2020/web', [
                                    'class'=>'btn btn-primary',
                                    'target'=>'_blank',
                                    'data-toggle'=>'tooltip',
                                    'title'=>'Capacítate - EVA Nivelación'
                                ]); */?>
                            </div>-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

<?php } else { ?>
    <div class="alert alert-info" align="center">
        <h3 align="center">
            <code>EL SISTEMA NO ESTÁ HABILITADO</code>
            <br>
            <br>
            Manténgase informado por nuestro canales oficiales donde se informará de manera oportuna el inicio del proceso de aceptación de cupos y creación de cuenta institucional.
            <br>
            <br>
            <br>
            <code>Canales Oficiales de la Universidad Estatal Amazónica</code>
            <br>
            <br>
            <a href="https://www.uea.edu.ec" target="_blank"><?= Icon::show('globe')?> Sitio web</a> | <a href="https://www.facebook.com/ueaeduec" target="_blank">Facebook</a> | <a href="https://www.twitter.com/ueaeduec" target="_blank">Twitter</a> | <a href="https://www.instagram.com/uea.edu.ec" target="_blank">Instagram</a>
        </h3>
    </div>
<?php } ?>