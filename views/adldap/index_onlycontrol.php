<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>


<div class="local">

    <div class="row">
        <div class="col-lg-3">
            <h2 align="center">Usuarios</h2>
            <div align="center">
                <a href="index.php?r=onlycontrol/nomina/index"><?= Html::img('images/users.png');?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/nomina/index"> Buscar &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Puertas</h2>
            <div align="center">
                <a href="index.php?r=onlycontrol/puerta/index"><?= Html::img('images/access_control.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/puerta/index"> Equipos &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center"> Access Control</h2>
            <div align="center">
                <a href="index.php?r=onlycontrol/nompuerta/index"><?= Html::img('images/access_control.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/nompuerta/index"> Permisos &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center"> Accesos</h2>
            <div align="center">
                <a href="index.php?r=onlycontrol/asistnow/index"><?= Html::img('images/fingerprint.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/asistnow/index"> Registros &raquo;</a></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h2 align="center"> Activos</h2>
            <div align="center">
                <a href="index.php?r=onlycontrol/nompuerta/index"><?= Html::img('images/logs.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/nompuerta/index"> Puertas &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center"> Eliminadas</h2>
            <div align="center">
                <a href="index.php?r=onlycontrol/nompuertadel/index"><?= Html::img('images/logs.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/nompuertadel/index"> Puertas &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center"> Auditoría</h2>
            <div align="center">
                <a href="index.php?r=onlycontrol/nompuertalog/index"><?= Html::img('images/logs.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/nompuertalog/index"> Puertas &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Servidor</h2>
            <div align="center">
                <a href="index.php?r=onlycontrol/puertasta/index"><?= Html::img('images/logs.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=onlycontrol/puertasta/index"> Registros &raquo;</a></p>
        </div>
    </div>

</div>


