<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AdldapResetForm;
use kartik\password\PasswordInput;

$this->title = 'Restaurar tu contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-forget">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <?php if (Yii::$app->session->hasFlash('successReset')): ?>
                &nbsp;
                <div class="alert alert-success">
                    Su contraseña ha sido restablecida satisfactoriamente. Por favor espera HASTA 30 MINUTOS que la misma
                    se refleje en todos los sistemas informáticos de <?= Yii::$app->params['company']?>.
                </div>

            <?php else: ?>
        </div>
    </div>

    <?php $model = new AdldapResetForm() ?>

    <div class="row">

        <div class="col-md-1 col-md-offset-1 col-sm-6 col-sm-offset-3">
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetuser">Olvidaste tu usuario &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetpass">Olvidaste tu contraseña &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/password">Cambiar contraseña &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=site/login">Verificar mi perfil &raquo;</a></p>

        </div>

        <div class="col-md-5 col-md-offset-2 col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Restaurar tu contraseña:</h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'reset-form', 'options' => ['class' => 'form']]) ?>

                    <?php if (isset($_GET['mail'])) { ?>
                        <?= $form->field($model, 'mail')->textInput
                        (['readOnly'=>true,'value' => $_GET['mail']]) ?>
                    <?php } else { ?>
                        <?= $form->field($model, 'mail')
                            ->textInput(['autofocus' => true])
                        ?>
                    <?php } ?>

                    <?php if (isset($_GET['resetToken'])) { ?>
                        <?= $form->field($model, 'resetToken')->textInput
                        (['readOnly'=>true,'value' => $_GET['resetToken']]) ?>
                    <?php } else { ?>
                        <?= $form->field($model, 'resetToken')
                            ->textInput()
                        ?>
                    <?php } ?>

                    <p align="center"> >>>> LEER ESTAS INDICACIONES <<<< </p>
                    <p>Su nueva contraseña debe contener al menos 8 dígitos entre mayúsculas, minúsculas y números.
                        <code>NO UTILICE SUS NOMBRES y/o APELLIDOS</code></p>

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
                            <?= Html::submitButton('Restaurar Contraseña', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end() ?>

                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>
