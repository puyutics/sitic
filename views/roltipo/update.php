<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RolTipo */

$this->title = 'Update Rol Tipo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rol Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rol-tipo-update">

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php } ?>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
