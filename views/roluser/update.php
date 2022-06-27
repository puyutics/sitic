<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RolUser */

$this->title = 'Update Rol User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rol Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rol-user-update">

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php } ?>

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
