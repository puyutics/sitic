<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\onlycontrol\TipoPermiso */

$this->title = 'Update Tipo Permiso: ' . $model->TIPO_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TIPO_ID, 'url' => ['view', 'TIPO_ID' => $model->TIPO_ID, 'TIPO_NOM' => $model->TIPO_NOM]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipo-permiso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
