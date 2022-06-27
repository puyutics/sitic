<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RolUser */

$this->title = 'Create Rol User';
$this->params['breadcrumbs'][] = ['label' => 'Rol Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-user-create">

    <?php if (!Yii::$app->request->isAjax) { ?>
        <div class="form-group">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    <?php } ?>

    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
