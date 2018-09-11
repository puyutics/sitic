<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Editar: {nameAttribute}', [
    'nameAttribute' => Yii::$app->user->identity->username,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Perfil'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');

if (isset(Yii::$app->user->identity->username)
    and (Yii::$app->session->get('authtype') == 'adldap')) {
    $user = Yii::$app->ad->getProvider('default')->search()->findBy(
        'sAMAccountname', Yii::$app->user->identity->username);
    $today = strtotime(date('Y-m-d H:i:s'));
    $lastSetPassword = strtotime($user->getPasswordLastSetDate());
    $diff = round(($today - $lastSetPassword)/86400);
}

?>
<div class="user-edit">

    <div class="edit-form">

        <div class="row">

            <div class="col-md-1 col-md-offset-1 col-sm-6 col-sm-offset-3">
                <p align="center"><a class="btn btn-primary" href="index.php?r=adldap/edit">Mi perfil &raquo;</a></p>
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/password">Cambiar contraseña &raquo;</a></p>
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetuser">Olvidaste tu usuario &raquo;</a></p>
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetpass">Olvidaste tu contraseña &raquo;</a></p>
            </div>

            <div class="col-md-5 col-md-offset-2 col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Editar datos del usuario</h3>
                    </div>
                    <div class="panel-body">

                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'dni')->textInput(['readOnly'=>true]) ?>

                                <div class="row">
                                    <div class="col-md-6">

                                        <?= $form->field($model, 'firstname')->textInput(['readOnly'=>true]) ?>

                                    </div>
                                    <div class="col-md-6">

                                        <?= $form->field($model, 'lastname')->textInput(['readOnly'=>true]) ?>

                                    </div>
                                </div>

                        <?= $form->field($model, 'commonname')->textInput(['readOnly'=>true]) ?>

                        <?= $form->field($model, 'displayname')->textInput(['readOnly'=>true]) ?>

                        <?= $form->field($model, 'mail')->textInput(['readOnly'=>true]) ?>

                        <div class="row">
                            <div class="col-md-6">

                                <?= $form->field($model, 'personalmail')->textInput(['maxlength' => true]) ?>

                            </div>
                            <div class="col-md-6">

                                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

                            </div>
                        </div>

                        <div align="center">
                            <p><b>Último cambio de contraseña: </b>
                                <?php
                                    echo $diff . ' días (' . $user->getPasswordLastSetDate() . ')';
                                ?>
                            </p>
                        </div>

                        <div align="center" class="form-group">

                            <?= Html::submitButton(Yii::t('app','Guardar'),['class' => 'btn btn-success']) ?>

                            <a class="btn btn-sg btn-primary" href="./index.php?r=adldap/index">Regresar</a>

                        </div>

                        <?php ActiveForm::end(); ?>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
