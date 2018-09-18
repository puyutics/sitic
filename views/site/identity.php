<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'SITIC - Sistema Integrado para la Gestión de Tecnologías de la Información y Comunicación.';
?>
<div class="site-index">

    <div class="bo d-content">

        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-4">
                <h2 align="center">Active Directory - LDAP</h2>

                <div align="center">
                    <a href="index.php?r=adldap/edit"><?= Html::img('images/userprofile.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=adldap/edit"> Editar perfil &raquo;</a></p>
            </div>
            <div class="col-lg-4">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <h2 align="center">Cambiar contraseña</h2>

                <div align="center">
                    <a href="index.php?r=adldap/password"><?= Html::img('images/changepass.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=adldap/password"> Cambiar Contraseña &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">¿Olvidaste tu usuario?</h2>

                <div align="center">
                    <a href="index.php?r=adldap/forgetuser"><?= Html::img('images/forgetuser.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=adldap/forgetuser"> Recuperar tu usuario &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">¿Olvid. tu contraseña?</h2>

                <div align="center">
                    <a href="index.php?r=adldap/forgetpass"><?= Html::img('images/forgetpass.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=adldap/forgetpass"> Recuperar tu contraseña &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
