<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>


<div class="local">

    <div class="row">

        <div class="col-lg-3">

        </div>
        <div class="col-lg-3">
            <h2 align="center">Usuarios</h2>

            <div align="center">
                <a href="index.php?r=userinfo/index"><?= Html::img('images/user_search.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=userinfo/index"> Reportes &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Biométricos</h2>

            <div align="center">
                <a href="index.php?r=machines/index"><?= Html::img('images/itprocesses.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=machines/index"> Equipos &raquo;</a></p>
        </div>
        <div class="col-lg-3">

        </div>
    </div>

</div>


