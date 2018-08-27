<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AdldapForgetUserForm;
use yii\captcha\Captcha;

$this->title = 'Olvidaste tu correo institucional';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-forgetuser">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <?php if (Yii::$app->session->hasFlash('successMail')): ?>
                &nbsp;
                <div class="alert alert-success">
                    Su cuenta de usuario o correo institucional es: <code><?= Yii::$app->session->getFlash('successMail') ?></code>.
                </div>
            <?php else: ?>
        </div>
    </div>

    <?php $model = new AdldapForgetuserForm() ?>

    <div class="row">

        <div class="col-md-1 col-md-offset-1 col-sm-6 col-sm-offset-3">
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetuser">Olvidaste tu usuario &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetpass">Olvidaste tu contraseña &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/password">Cambiar contraseña &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=site/login">Verificar mi perfil &raquo;</a></p>

        </div>

        <div class="col-md-5 col-md-offset-2 col-sm-6 col-sm-offset-3">            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'forgetuser-form', 'options' => ['class' => 'form']]) ?>

                    <?= $form->field($model, 'dni')
                        ->textInput(['autofocus' => true])
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

                    &nbsp;

                    <div class="form-group">
                        <div class="col-md-1 col-md-offset-4">
                            <?= Html::submitButton('Buscar usuario o correo', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end() ?>

                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>
