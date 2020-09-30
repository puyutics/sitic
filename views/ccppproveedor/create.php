<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcppProveedor */

$this->title = 'Agregar Proveedor';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['ccppproveedor/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccpp-proveedor-create">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
