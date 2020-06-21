<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'SITIC - Sistema Integrado para la Gestión de Tecnologías de la Información y Comunicación.';
?>
<div class="site-index">

    <div align="center">
        <?= Html::img('images/uea_banner.png');?>
    </div>

    <br>
    <br>
    <br>

    <div class="bo d-content">

        <div class="row">

            <div class="col-lg-3">

                <div align="center">
                    <a href="index.php?r=adldap/forgetpass"><?= Html::img('images/user_active.png');?></a>
                </div>

                <p align="center"><a class="btn btn-lg btn-primary" href="index.php?r=adldap/forgetpass"> Activar Cuenta &raquo;</a></p>
            </div>

            <div class="col-lg-3">

                <div align="center">
                    <a href="index.php?r=adldap/forgetuser"><?= Html::img('images/user_search.png');?></a>
                </div>

                <p align="center"><a class="btn btn-lg btn-primary" href="index.php?r=adldap/forgetuser"> Recuperar usuario &raquo;</a></p>
            </div>

            <div class="col-lg-3">

                <div align="center">
                    <a href="index.php?r=adldap/forgetpass"><?= Html::img('images/user_password.png');?></a>
                </div>

                <p align="center"><a class="btn btn-lg btn-danger" href="index.php?r=adldap/forgetpass"> Cambiar Contraseña &raquo;</a></p>
            </div>

            <div class="col-lg-3">

                <div align="center">
                    <a href="https://www.uea.edu.ec/ayuda" target="_blank"><?= Html::img('images/user_email.png');?></a>
                </div>

                <p align="center"><a class="btn btn-lg btn-primary" href="https://www.uea.edu.ec/soporte" target="_blank"> Cambiar Correo Personal &raquo;</a></p>
                <!-- <p align="center"><a class="btn btn-info" href="https://telegram.me/ueaeduec" target="_blank"> Usar TELEGRAM </a></p> -->
            </div>

        </div>

    </div>
</div>
