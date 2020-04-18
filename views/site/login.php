<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar Sesión';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3" align="center">
            <p><h1><b>Sistema Integrado</b> | Tecnologías Información y Comunicación</h1></p>
        </div>
    </div>

    &nbsp

    <div class="row">

        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3" align="center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= 'Ingrese sus credenciales' ?></h3>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n<div class=\"col-lg-7\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                            'labelOptions' => ['class' => 'col-lg-4 control-label'],
                        ],
                    ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'authtype')->dropDownList(
                            [
                                'adldap' => 'Active Directory / LDAP',
                                'local' => 'Base de datos interna de SITIC',
                            ]); ?>

                    <h5><a href="https://www.uea.edu.ec/ayuda">¿ Olvidaste tu usuario y contraseña ?</a></h5>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-lg-offset-2 col-lg-8\">{input} {label}</div>\n
                                        <div class=\"col-lg-8\">{error}</div>",
                    ]) ?>

                        <div class="col-lg-offset-1 col-lg-10">
                            <?= Html::submitButton('Iniciar Sesión', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-offset-1" style="color:#999;" align="center">
        Puedes seleccionar la base de datos disponible para iniciar sesión: .<br>
        <code><strong>Active Directory / LDAP</strong> o <strong>Base de datos interna</strong></code>.
    </div>
</div>