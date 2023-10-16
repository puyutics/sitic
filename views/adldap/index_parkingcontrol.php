<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>


<div class="local">

    <div class="row">
        <div class="col-lg-3">
            <h2 align="center">Vehículos</h2>
            <div align="center">
                <a href="index.php?r=parkingcontrol/nomina/index"><?= Html::img('images/cars.png', ['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=parkingcontrol/nomina/index"> Buscar &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Barreras</h2>
            <div align="center">
                <a href="index.php?r=parkingcontrol/puerta/index"><?= Html::img('images/barrier.png', ['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=parkingcontrol/puerta/index"> Equipos &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center"> Access Control</h2>
            <div align="center">
                <a href="index.php?r=parkingcontrol/nompuerta/index"><?= Html::img('images/access_control.png', ['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=parkingcontrol/nompuerta/index"> Permisos &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center"> Accesos</h2>
            <div align="center">
                <a href="index.php?r=parkingcontrol/asistnow/index"><?= Html::img('images/fingerprint.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=parkingcontrol/asistnow/index"> Registros &raquo;</a></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h2 align="center"> Activos</h2>
            <div align="center">
                <a href="index.php?r=parkingcontrol/nompuerta/index"><?= Html::img('images/logs.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=parkingcontrol/nompuerta/index"> Puertas &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center"> Eliminadas</h2>
            <div align="center">
                <a href="index.php?r=parkingcontrol/nompuertadel/index"><?= Html::img('images/logs.png',['height' => '200px']);?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=parkingcontrol/nompuertadel/index"> Puertas &raquo;</a></p>
        </div>
        <!--<div class="col-lg-3">
            <h2 align="center"> Auditoría</h2>
            <div align="center">
                <a href="index.php?r=parkingcontrol/nompuertalog/index"><?php /*= Html::img('images/logs.png',['height' => '200px']);*/?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=parkingcontrol/nompuertalog/index"> Puertas &raquo;</a></p>
        </div>-->
        <!--<div class="col-lg-3">
            <h2 align="center">Servidor</h2>
            <div align="center">
                <a href="index.php?r=parkingcontrol/puertasta/index"><?php /*= Html::img('images/logs.png',['height' => '200px']);*/?></a>
            </div>
            <p align="center"><a class="btn btn-success" href="index.php?r=parkingcontrol/puertasta/index"> Registros &raquo;</a></p>
        </div>-->
    </div>

</div>


