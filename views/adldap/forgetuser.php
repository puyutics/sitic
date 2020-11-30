<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AdldapForgetUserForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Olvidaste tu cuenta institucional';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Identidad'), 'url' => ['site/identity']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-forgetuser">


    <?php if (Yii::$app->session->hasFlash('successSearch')): ?>

        <?php if (isset($users)) { ?>
            <div align="center">
                <?= Html::a(Yii::t('app', 'Reiniciar Búsqueda'),
                    Url::toRoute(['adldap/forgetuser']), ['class' => 'btn btn-warning']) ?>
            </div>
            <div style="font-size: 9pt; text-align: left;">
                <b>Total de resultados: <?= count($users) ?></b>
            </div>
            <br>
            <table width=100% border="1" style="font-size: 9pt;border-collapse:collapse">
                <tr>
                    <th bgcolor="#EEEEEE" style="text-align: center">#</th>
                    <th bgcolor="#EEEEEE" style="text-align: center">Céd/Pasaporte/Cód</th>
                    <th bgcolor="#EEEEEE" style="text-align: center">Usuario</th>
                    <th bgcolor="#EEEEEE" style="text-align: center">Nombre Completo</th>
                    <th bgcolor="#EEEEEE" style="text-align: center">Email institucional</th>
                </tr>
                <?php $i=0 ?>
                <?php foreach ($users as $single_user)  { ?>
                    <?php $i=$i+1 ?>
                    <tr>
                        <th style="text-align: center"><?= $i ?></th>
                        <th style="text-align: center"><?= $single_user->getAttribute(Yii::$app->params['dni'],0) ?></th>
                        <th style="text-align: center"><?= $single_user->getAttribute('samaccountname',0) ?></th>
                        <th style="text-align: center"><?= $single_user->getAttribute('cn',0) ?></th>
                        <th style="text-align: center"><?= $single_user->getEmail() ?></th>
                    </tr>
                <?php } ?>
            </table>
            <br>
        <?php } ?>

    <?php else: ?>

    <?php $model = new AdldapForgetuserForm() ?>

    <div class="row">

        <!--<div class="col-md-1 col-md-offset-1 col-sm-6 col-sm-offset-3">
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/editprofile">Editar perfil &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/password">Cambiar contraseña &raquo;</a></p>
            <p align="center"><a class="btn btn-primary" href="index.php?r=adldap/forgetuser">Olvidaste tu usuario &raquo;</a></p>
            <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetpass">Olvidaste tu contraseña &raquo;</a></p>
        </div>-->

        <div class="col-sm-offset-3 col-sm-5">
            <div class="panel panel-default">
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
                    <br>
                    <div class="form-group">
                        <div class="col-md-1 col-md-offset-4">
                            <?= Html::submitButton('Buscar usuario', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>

                    <?php ActiveForm::end() ?>

                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

</div>
