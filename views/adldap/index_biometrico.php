<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>


<div class="local">

    <div class="row">

        <div class="col-lg-3">
            <h2 align="center">Usuarios</h2>

            <div align="center">
                <a href="index.php?r=biometrico/userinfo/index"><?= Html::img('images/user_search.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=biometrico/userinfo/index"> Reportes &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Equipos</h2>

            <div align="center">
                <a href="index.php?r=biometrico/machines/index"><?= Html::img('images/access_control.png',['height' => '200px']);?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=biometrico/machines/index"> Biométricos &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Accesos</h2>

            <div align="center">
                <a href="index.php?r=biometrico/checkinout/index"><?= Html::img('images/logs.png',['height' => '200px']);?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=biometrico/checkinout/index"> Registros &raquo;</a></p>
        </div>
    </div>

</div>


