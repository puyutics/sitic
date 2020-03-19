<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

?>


<div class="local">

    <div class="row">
        <div class="col-lg-3">
            <h2 align="center">Usuarios</h2>

            <div align="center">
                <a href="index.php?r=user/index"><?= Html::img('images/user_search.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=user/index"> Usuarios &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Roles de Usuarios</h2>

            <div align="center">
                <a href="index.php?r=authassignment/index"><?= Html::img('images/itprocesses.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=authassignment/index"> Roles usuarios &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Usuario/Dep.</h2>

            <div align="center">
                <a href="index.php?r=userdepartment/index"><?= Html::img('images/itprojects.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=userdepartment/index"> Usuario/Dep. &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <h2 align="center">Departamentos</h2>

            <div align="center">
                <a href="index.php?r=department/index"><?= Html::img('images/users.png');?></a>
            </div>

            <p align="center"><a class="btn btn-success" href="index.php?r=department/index"> Departamentos &raquo;</a></p>
        </div>
    </div>

</div>


