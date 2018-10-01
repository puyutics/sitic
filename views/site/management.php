<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'SITIC - Sistema Integrado para la Gestión de Tecnologías de la Información y Comunicación.';
?>
<div class="site-index">

    <div class="bo d-content">

        <div class="row">
            <div class="col-lg-4">
                <h2 align="center">Gestión de Usuarios</h2>

                <div align="center">
                    <a href="index.php?r=adldap/edituser"><?= Html::img('images/users.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=adldap/edituser"> Usuarios Active Directory / LDAP, BD local &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">Gestión de Bienes</h2>

                <div align="center">
                    <a href="index.php?r=invpurchaseitem/index"><?= Html::img('images/invpurchasesitems.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=invpurchaseitem/index"> Bienes, Asignaciones, Fabricantes y Modelos &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">Gestión de Compras</h2>

                <div align="center">
                    <a href="index.php?r=invpurchase/index"><?= Html::img('images/invpurchases.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=invpurchase/index"> Compras, Asignaciones &raquo;</a></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <h2 align="center">Gestión de Procesos</h2>

                <div align="center">
                    <a href="index.php?r=itprocesses/index"><?= Html::img('images/itprocesses.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=itprocesses/index"> Procesos TI &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">Gestión de Proyectos</h2>

                <div align="center">
                    <a href="index.php?r=itprojects/index"><?= Html::img('images/itprojects.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=itprojects/index"> Proyectos TI &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">Gestión de Servicios</h2>

                <div align="center">
                    <a href="index.php?r=itservices/index"><?= Html::img('images/itservices.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=itservices/index"> Servicios TI &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
