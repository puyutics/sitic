<?php
/**
 * Created by PhpStorm.
 * User: gfernandez
 * Date: 26/9/18
 * Time: 08:53
 */

use yii\helpers\Html;
use kartik\form\ActiveForm;

$user = Yii::$app->ad->getProvider('default')->search()->findBy(
    'sAMAccountname', Yii::$app->user->identity->username);
$today = strtotime(date('Y-m-d H:i:s'));
$lastSetPassword = strtotime($user->getPasswordLastSetDate());
$diff = round(($today - $lastSetPassword)/86400);

?>

<div class="profile-edit">

    <div class="edit-form">

        <div class="row">

            <!--<div class="col-md-1 col-md-offset-1 col-sm-6 col-sm-offset-3">
                <p align="center"><a class="btn btn-primary" href="index.php?r=adldap/edit">Editar perfil &raquo;</a></p>
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/password">Cambiar contraseña &raquo;</a></p>
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetuser">Olvidaste tu usuario &raquo;</a></p>
                <p align="center"><a class="btn btn-default" href="index.php?r=adldap/forgetpass">Olvidaste tu contraseña &raquo;</a></p>
            </div>-->

            <div class="col-sm-offset-2 col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Editar datos del usuario</h3>
                    </div>
                    <div class="panel-body">

                        <?php $form = ActiveForm::begin([
                            'method' => 'post',
                        ]); ?>

                        <?= $form->field($model, 'dni')->textInput(['readOnly'=>true]) ?>

                                <div class="row">
                                    <div class="col-md-6">

                                        <?= $form->field($model, 'lastname')->textInput(['readOnly'=>true]) ?>

                                    </div>
                                    <div class="col-md-6">

                                        <?= $form->field($model, 'firstname')->textInput(['readOnly'=>true]) ?>

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

                        <?php echo "<p></p>";
                        echo "<p><b>Estado</b></p>";
                        //NORMAL_ACCOUNT	0x0200	512
                        if ($model->uac == 512) { ?><span class="label label-success">CUENTA ACTIVA</span><?php }
                        //Disabled Account	0x0202	514
                        if ($model->uac == 514) { ?><span class="label label-danger">CUENTA DESACTIVADA</span><?php }
                        //Enabled, Password Doesn’t Expire	0x10200	66048
                        if ($model->uac == 66048) { ?><span class="label label-success">CUENTA ACTIVA, CONTRASEÑA NUNCA EXPIRA</span><?php }
                        ?>

                        <?php echo "<p></p>";
                        echo "<p><b>Grupo(s)</b></p>";
                        foreach($model->groups as $group)
                        {
                            echo $group->getName().", ";
                        }
                        ?>

                        <?php echo "<p></p>";
                        echo "<p><b>Unidad Organizativa</b></p>";
                        echo $model->dn;
                        ?>

                        <div align="center">
                            <p></p>
                            <p><b>Último cambio de contraseña: </b>
                                <?php
                                echo $diff . ' días (' . $user->getPasswordLastSetDate() . ')';
                                ?>
                            </p>
                        </div>

                        <div align="center" class="form-group">

                            <?= Html::submitButton(Yii::t('app','Guardar'),['class' => 'btn btn-success']) ?>

                            <a class="btn btn-sg btn-primary" href="./index.php?r=adldap/password">Cambiar contraseña</a>

                        </div>

                        <?php ActiveForm::end(); ?>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>