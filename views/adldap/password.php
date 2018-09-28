<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AdldapPasswordForm;
use kartik\password\PasswordInput;

if (isset(Yii::$app->user->identity->username)
    and (Yii::$app->session->get('authtype') == 'adldap')) {
    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', Yii::$app->user->identity->username);
}

$this->title = 'Cambiar tu contraseña';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identidad'), 'url' => ['site/identity']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-password">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <?php if (Yii::$app->session->hasFlash('successPassword')): ?>
                &nbsp;
                <div class="alert alert-success">
                    Su contraseña ha sido restablecida satisfactoriamente. Por favor espera HASTA 30 MINUTOS que la misma
                    se refleje en todos los sistemas informáticos de <?= Yii::$app->params['company']?>.
                </div>

            <?php else: ?>

        </div>
    </div>


    <?php $model = new AdldapPasswordForm() ?>

    <div class="row">

        <div class="col-md-1 col-md-offset-1 col-sm-6 col-sm-offset-3">
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/editprofile">Editar perfil &raquo;</a></p>
            <p align="center"><a class="btn btn-primary" href="index.php?r=adldap/password">Cambiar contraseña &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetuser">Olvidaste tu usuario &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetpass">Olvidaste tu contraseña &raquo;</a></p>
        </div>

        <div class="col-md-5 col-md-offset-2 col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Ingrese los siguientes datos:</h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'password-form', 'options' => ['class' => 'form']]) ?>

                    <?php if (isset(Yii::$app->user->identity->username)
                                and (Yii::$app->session->get('authtype') == 'adldap')) { ?>
                        <?= $form->field($model, 'mail')
                            ->textInput(['autofocus' => true,'readOnly'=>true,
                                'value'=> $user->getAttribute('mail', 0)])
                        ?>
                    <?php } else { ?>
                        <?= $form->field($model, 'mail')
                            ->textInput(['autofocus' => true])
                        ?>
                    <?php } ?>

                    <?= $form->field($model, 'oldPassword')->passwordInput()
                        ->label('Contraseña Actual') ?>

                    <div class="alert alert-danger">
                        <?= Yii::$app->session->getFlash('recommendation') ?>
                    </div>

                    <?= $form->field($model, 'newPassword')->widget(PasswordInput::classname(), [
                        'pluginOptions' => [
                            'showMeter' => true,
                            'toggleMask' => true
                        ]])
                    ?>

                    <?= $form->field($model, 'verifyNewPassword')->widget(PasswordInput::classname(), [
                        'pluginOptions' => [
                            'showMeter' => false,
                            'toggleMask' => true
                        ]])
                    ?>

                    <div class="form-group">
                        <div class="col-md-1 col-md-offset-3">
                            <?= Html::submitButton('Cambiar Contraseña', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end() ?>

                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>
