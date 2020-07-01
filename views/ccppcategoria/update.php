<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CcppCategoria */

$this->title = 'Update Ccpp Categoria: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ccpp Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ccpp-categoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
