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

/* @var $model */

$this->title = Yii::t('app', 'Crear estudiante');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['adldap/index']];
$this->params['breadcrumbs'][] = $this->title;

//print_r($model);
?>

<?php $form = ActiveForm::begin([
    'method' => 'post',
]); ?>

    <div class="alert alert-info" align="center">
        <h3 align="center">Crear cuenta institucional</h3>
    </div>

    <?php if ($model->step == 1) { ?>
        <div class="edit-form">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">PASO 1: Validar datos del usuario</h3>
                    </div>
                    <div class="panel-body">

                        <div class="alert alert-success" align="center">
                            <h4>Bienvenid@ a la Universidad Estatal Amazónica. En 6 pasos vamos a crear su nueva cuenta institucional. Es necesario que ingrese los siguientes datos:</h4>
                        </div>

                        <?= $form->field($model, 'step')->hiddenInput()->label(false) ?>

                        <?= $form->field($model, 'dni')->textInput() ?>

                        <div align="center">
                            <?= $form->field($model, 'fec_nacimiento')->widget(DatePicker::className(), [
                                'type' => DatePicker::TYPE_INLINE,
                                'pluginOptions' => [
                                    'autoclose'=>true,
                                    'todayHighlight' => true,
                                    'format' => 'yyyy-mm-dd'
                                ]
                            ]) ?>
                        </div>

                        <div class="form-group" align="center">
                            <?= Html::submitButton('Validar Datos', ['class' => 'btn btn-success']) ?>
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

                            <?= $form->field($model, 'title')->textInput(['readOnly' => true]) ?>

                            <?= $form->field($model, 'department')->textInput(['readOnly' => true]) ?>

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

                            <?= $form->field($model, 'commonname')->hiddenInput()->label(false) ?>

                            <?= $form->field($model, 'displayname')->hiddenInput()->label(false) ?>

                            <div class="alert alert-success" align="center">
                                <h4>Cuenta creada correctamente, por favor configure una contraseña</h4>
                            </div>

                            <?= $form->field($model, 'samaccountname')->hiddenInput()->label(false) ?>

                            <?= $form->field($model, 'mail')->textInput(['readOnly' => true]) ?>

                            <?= $form->field($model, 'personalmail')->hiddenInput()->label(false) ?>

                            <?= $form->field($model, 'mobile')->hiddenInput()->label(false) ?>

                            <?= $form->field($model, 'title')->hiddenInput()->label(false) ?>

                            <?= $form->field($model, 'department')->hiddenInput()->label(false) ?>

                            <?php if (Yii::$app->session->hasFlash('errorReset')) { ?>
                                <div class="alert alert-danger">
                                    <?= Yii::$app->session->getFlash('errorReset') ?>
                                </div>
                            <?php } ?>

                            <?= $form->field($model, 'newPassword')->widget(PasswordInput::classname(), [
                                'pluginOptions' => [
                                    'showMeter' => false,
                                    'toggleMask' => true
                                ]])
                            ?>

                            <?= $form->field($model, 'verifyNewPassword')->widget(PasswordInput::classname(), [
                                'pluginOptions' => [
                                    'showMeter' => false,
                                    'toggleMask' => true
                                ]])
                            ?>

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

                            <div class="alert alert-warning" align="center">
                                <h4>Cuenta creada correctamente, por favor proceda a matricularse</h4>
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

                            <div align="center">
                                <?php echo Html::a('Matricularme', 'https://www.uea.edu.ec/siad2nv', [
                                    'class'=>'btn btn-success',
                                    'target'=>'_blank',
                                    'data-toggle'=>'tooltip',
                                    'title'=>'Matricularme SIAD Nivelación'
                                ]); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

<?php ActiveForm::end(); ?>