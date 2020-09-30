<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcppProveedorCategoria */

$this->title = 'Agregar Categoría';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['ccppproveedor/index']];
$this->params['breadcrumbs'][] = ['label' => $model->ccppProveedor->razon_social, 'url' => ['ccppproveedor/admin', 'id' => base64_encode($model->ccpp_proveedor_id)]];
$this->params['breadcrumbs'][] = $this->title;

$CcppProveedor = \app\models\CcppProveedorSearch::find()
    ->where('id = ' . $model->ccpp_proveedor_id)
    ->one();
?>
<div class="ccpp-proveedor-categoria-create">

    <div class="alert alert-info" align="center">
        <h3><?= Html::encode('Proveedor: ' . $CcppProveedor->razon_social) ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
