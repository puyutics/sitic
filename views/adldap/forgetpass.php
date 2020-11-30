<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Cambiar contraseña';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuenta institucional'), 'url' => ['site/identity']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adldap-forgetpass">

    <?php if (Yii::$app->session->hasFlash('successMail')): ?>
        <div class="row">
            <div>             &nbsp;
                <div class="alert alert-success">
                    Se ha enviado un correo a <code><?= Yii::$app->session->getFlash('successMail') ?></code> con un enlace (RESET TOKEN) para restablecer su contraseña.
                </div>

                <div class="alert alert-warning">
                    Si su correo personal es INCORRECTO o NO TIENE ACCESO, por favor comuníquese con <?php echo Yii::$app->params['contact']?>
                </div>


                <p align="center">
                    <a class="btn btn-primary" href="https://www.uea.edu.ec/soporte" target="_blank"> Cambiar Correo Personal </a>
                    <a class="btn btn-danger" href="index.php?r=site/identity"> Regresar &raquo;</a>
                </p>

            </div>
        </div>

    <?php else: ?>

        <div class="row">

            <!--<div class="col-md-1 col-md-offset-1 col-sm-6 col-sm-offset-3">
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/editprofile">Editar perfil &raquo;</a></p>
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/password">Cambiar contraseña &raquo;</a></p>
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetuser">Olvidaste tu usuario &raquo;</a></p>
                <p align="center"><a class="btn btn-primary" href="index.php?r=adldap/forgetpass">Olvidaste tu contraseña &raquo;</a></p>
            </div>-->

            <div class="col-sm-offset-3 col-sm-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                    </div>
                    <div class="panel-body">

                        <?php if (Yii::$app->session->hasFlash('personalmail')): ?>

                            <?php $form = ActiveForm::begin([
                                'id' => 'forgetpass-form', 'options' => ['class' => 'form']]) ?>

                            <?= $form->field($model, 'dni')
                                ->hiddenInput(['readOnly' => true, 'autofocus' => true])->label(false)
                            ?>

                            <?= $form->field($model, 'mail')
                                ->hiddenInput(['readOnly' => true])->label(false)
                            ?>

                            <p><div align="center">
                                <?php echo '¿Es correcto su correo personal?' ?>
                                <code><?php echo Yii::$app->session->getFlash('personalmail'); ?></code>
                            </div></p>

                            <?php $model->verifyCode = ''; ?>

                            <?= $form->field($model, 'verifyCode')
                            ->widget(Captcha::className(),
                                [
                                    'template' =>
                                        '<div class="row">
                                            <div class="col-lg-4">{image}</div>
                                            <div class="col-lg-4">{input}</div>
                                            </div>',
                                    'value'=> ''
                                ])->label(false)
                            ?>

                            <p><div class="form-group" align="center">
                                <?= Html::submitButton('Sí, Enviar TOKEN',['class' => 'btn btn-danger',
                                    'value'=>'sendToken', 'name'=>'sendToken',
                                    //'onClick'=>'buttonClicked'])
                                    'onClick'=>'alert("Se enviará un enlace (Reset TOKEN) a su correo personal.")'])
                                ?>
                            </div></p>

                            <?php ActiveForm::end() ?>

                            <div class="alert alert-warning">
                                Si su correo personal es INCORRECTO o NO TIENE ACCESO, por favor comuníquese con <?php echo Yii::$app->params['contact']?> O utilice la Mesa de Ayuda:
                            </div>

                            <p align="center">
                                <a class="btn btn-primary" href="https://www.uea.edu.ec/soporte" target="_blank"> No, Cambiar Correo Personal </a>
                            </p>

                        <?php else: ?>

                            <?php $form = ActiveForm::begin([
                                'id' => 'forgetpass-form', 'options' => ['class' => 'form']]) ?>

                            <?= $form->field($model, 'dni')
                                ->textInput(['autofocus' => true])
                            ?>

                            <?= $form->field($model, 'mail')
                                ->textInput()
                            ?>

                            <?= $form->field($model, 'verifyCode')
                                ->widget(Captcha::className(),
                                    [
                                        'template' =>
                                            '<div class="row">
                                       <div class="col-lg-4">{image}</div>
                                       <div class="col-lg-4">{input}</div>
                                    </div>',
                                    ])
                            ?>

                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-4">
                                    <?= Html::submitButton('Comprobar datos', ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>

                            <?php ActiveForm::end() ?>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

</div>
