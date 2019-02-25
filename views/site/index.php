<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'SITIC - Sistema Integrado para la Gestión de Tecnologías de la Información y Comunicación.';
?>
<div class="site-index">

    <div class="bo d-content">

        <div class="row">
            <div align="center">
                <h1>SITIC</h1>
                <h5>Sistema Integrado para la Gestión de Tecnologías de la Información y Comunicación.</h5>
            </div>

            <div align="center">
                <?= Html::img('images/sitic.png');?>
            </div>
        </div>

        <div class="row" align="center">
            --------------------------------------------------------------------
        </div>

        <div class="row">
            <div class="col-lg-4">
                <h2 align="center">Gestión de Identidad</h2>

                <p align="center">Autoservicio y manejo de información de identidad de los usuarios.</p>

                <p align="center"><a class="btn btn-success" href="index.php?r=site/identity">Olvidaste tu usuario o contraseña &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">Gestión de TI - ITSM</h2>

                <p align="center">Utilizando fundamentos de la ISO/IEC 38500 y el marco de trabajo COBIT 5 (EN DESARROLLO).</p>

                <p align="center"><a class="btn btn-success" href="index.php?r=site/management">Proyectos, Procesos, Servicios &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">Inventario de TI</h2>

                <p align="center">Basado en FusionInventory, mediante la integración con GLPI Network ITSM (EN DESARROLLO).</p>

                <p align="center"><a class="btn btn-success" href="index.php?r=site/inventory">Aplicaciones, Impresoras, Telefonía &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
