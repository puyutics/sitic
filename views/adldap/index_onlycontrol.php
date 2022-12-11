<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>


<div class="local">

    <div class="row">
        <div class="col-lg-3">
            <h2 align="center">Usuarios</h2>

            <div align="center">
                <a href="index.php?r=onlycontrol/nomina/index"><?= Html::img('images/user_search.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/nomina/index"> Buscar &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Equipos</h2>

            <div align="center">
                <a href="index.php?r=onlycontrol/puerta/index"><?= Html::img('images/access_control.png',['height' => '200px']);?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/puerta/index"> Puertas &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Accesos</h2>

            <div align="center">
                <a href="index.php?r=onlycontrol/asistnow/index"><?= Html::img('images/logs.png',['height' => '200px']);?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/asistnow/index"> Registros &raquo;</a></p>
        </div>
    </div>

</div>


