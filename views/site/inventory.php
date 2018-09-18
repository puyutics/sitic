<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'SITIC - Sistema Integrado para la Gestión de Tecnologías de la Información y Comunicación.';
?>
<div class="site-index">

    <div class="bo d-content">

        <div class="row">
            <div class="col-lg-4">
                <h2 align="center">Aplicaciones</h2>

                <div align="center">
                    <a href="index.php?r=itapps/index"><?= Html::img('images/itapps.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=itapps/index"> Aplicaciones &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">Sistema Impresiones</h2>

                <div align="center">
                    <a href="index.php?r=printers/index"><?= Html::img('images/printers.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=printers/index"> Impresoras &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2 align="center">Telefonía (VoIP)</h2>

                <div align="center">
                    <a href="index.php?r=phonesextensions/index"><?= Html::img('images/phones.png');?></a>
                </div>

                <p align="center"><a class="btn btn-success" href="index.php?r=phonesextensions/index"> Telefonía &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
