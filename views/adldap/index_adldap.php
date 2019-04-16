<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>


<div class="adldap">

    <div class="row">
        <div class="col-lg-4">
            <h2 align="center">Crear usuario</h2>

            <div align="center">
                <a href="index.php?r=adldap/create"><?= Html::img('images/user_add.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=adldap/create"> Crear usuario &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2 align="center">Editar usuarios</h2>

            <div align="center">
                <a href="index.php?r=adldap/edituser"><?= Html::img('images/user_search.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=adldap/edituser"> Editar usuario &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2 align="center">Ver usuarios</h2>

            <div align="center">
                <a href="index.php?r=adldap/viewuser"><?= Html::img('images/user_info.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=adldap/viewuser"> Ver usuario &raquo;</a></p>
        </div>
    </div>

</div>


