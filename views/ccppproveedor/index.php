<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcppProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccpp-proveedor-index">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div align="center">
                <a href="index.php?r=ccppproveedor/proveedores"><?= Html::img('images/user_add.png');?></a>
            </div>
            <p align="center"><a class="btn btn-lg btn-primary" href="index.php?r=ccppproveedor/proveedores"> Lista Proveedores &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <div align="center">
                <a href="index.php?r=ccppproveedor/categorias"><?= Html::img('images/user_search.png');?></a>
            </div>
            <p align="center"><a class="btn btn-lg btn-primary" href="index.php?r=ccppproveedor/categorias"> Categorías &raquo;</a></p>
        </div>
        <div class="col-lg-3">
            <div align="center">
                <a href="index.php?r=sysemail/index"><?= Html::img('images/user_email.png');?></a>
            </div>
            <p align="center"><a class="btn btn-lg btn-primary" href="index.php?r=sysemail/index"> Enviar Email &raquo;</a></p>
        </div>
    </div>

</div>
