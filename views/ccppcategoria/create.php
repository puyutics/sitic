<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcppCategoria */

$this->title = 'Agregar Categoría';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['ccppproveedor/index']];
$this->params['breadcrumbs'][] = ['label' => 'Categorías', 'url' => ['ccppproveedor/categorias']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ccpp-categoria-create">

    <div class="alert alert-info" align="center">
        <h3 align="center"><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
