<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AdldapForgetPassForm;
use yii\captcha\Captcha;

$this->title = 'Olvidaste tu contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adldap-forgetpass">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <?php if (Yii::$app->session->hasFlash('successMail')): ?>
                &nbsp;
                <div class="alert alert-success">
                    Se ha enviado un correo a <code><?= Yii::$app->session->getFlash('successMail') ?></code> con un enlace (RESET TOKEN) para restablecer su contraseña.
                </div>

                <div class="alert alert-warning">
                    Si su correo personal es INCORRECTO o NO TIENE ACCESO, por favor comuníquese con <?php echo Yii::$app->params['contact']?>
                </div>
            <?php else: ?>
        </div>
    </div>

    <?php $model = new AdldapForgetpassForm() ?>

    <div class="row">

        <div class="col-md-1 col-md-offset-1 col-sm-6 col-sm-offset-3">
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/edit">Mi perfil &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/password">Cambiar contraseña &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetuser">Olvidaste tu usuario &raquo;</a></p>
            <p align="center"><a class="btn btn-primary" href="index.php?r=adldap/forgetpass">Olvidaste tu contraseña &raquo;</a></p>
        </div>

        <div class="col-md-5 col-md-offset-2 col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
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
                            <?= Html::submitButton('Enviar TOKEN', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end() ?>

                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>
